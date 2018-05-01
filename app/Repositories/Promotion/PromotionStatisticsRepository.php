<?php
namespace App\Repositories\Promotion;

use App\Common\Requests;
use App\Facades\Admin;
use App\Model\Admin\LinkBackend;
use App\Model\Admin\PlayerPay;
use App\Model\MagicInstall\Browser;
use App\Model\MagicInstall\Relation;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class PromotionStatisticsRepository extends AbstractRepository{
	
	protected $model;

	private $total;
	private $ratio;
	private $down_ratio;
	private $records;
	
	public function __construct(LinkBackend $model = null)
	{
		$model || $model = new LinkBackend();
		$this->model = $model;
		$this->initTotal();
		$this->initRatio();
		$this->records = [];
	}

	public function initRatio()
	{
		$base_ratio = [];
		// 通道费
		$base_ratio['channel'] = 0.05;
		// 地推公司分成 0.45, 乐逗分成0.55
		$base_ratio['company_admin'] = 0.55;

		// 代理分成0.7，由地推公司设置
		$base_ratio['agent'] = 0.7;
		// 地推人员分成0.7，由代理设置
		$base_ratio['person'] = 0.7;

		$ratio = [];
		// 5%的通道费乐逗和淘实惠共通承担, 乐逗拉取流水剩下的55%
		$ratio['company_admin'] = (1 - $base_ratio['channel']) * $base_ratio['company_admin'];
		// 剩下的地推公司和代理门店分
		$rest = (1 - $base_ratio['channel']) * (1 - $base_ratio['company_admin']);
		// 淘实惠拿乐逗剩下的50%
		$ratio['company'] = $rest * (1 - $base_ratio['agent']);

		$ratio['agent'] = $rest * $base_ratio['agent'] * (1 - $base_ratio['person']);

		$ratio['person'] = $rest * $base_ratio['agent'] * $base_ratio['person'];
		return $ratio;
	}

	/**
	 * 访回格式化的total数据
	 * @return array
	 */
	public function formatTotal()
	{
		return [
			'visited' => 0,
			'visited_device' => 0,
			'used' => 0,
			'used_new' => 0,
			'used_old' => 0,
			'used_time_new' => 0,
			'used_time_old' => 0,
			'pay' => 0.0,
			'pay_down' => 0.0,
			'pay_yesterday' => 0.0
		];
	}

	/**
	 * 初始化总统计值
	 * @return array
	 */
	public function initTotal()
	{
		$this->total = $this->formatTotal();
		$total = $this->total;
		return $total;
	}

	/**
	 * 计算分数的方法
	 * @param $part
	 * @param $total
	 * @return float|int
	 */
	public function calPercent($part, $total)
	{
		return $total == 0 ? 0 : round($part / $total * 100, 2);
	}

	/**
	 * 获取某个用户某个游戏的所有链接统计数据
	 * @param $user
	 * @param $game_id
	 * @param bool $creator
	 * @return mixed
	 */
	private function getLinkByUser($user, $game_id, $creator = false)
	{
		// 用于查找是创建者的链接还是使用这的链接
		$creator ? $role = 'create_id' : $role = 'user_id';
		// 获取属于该用户的所有链接 或者该用户创建的链接
		$links = LinkBackend::where([$role => $user->id, 'game_id' => $game_id])->get();
		// 获取这些链接的渠道id
		$channel_ids = $links->pluck('channel_id')->unique()->toArray();

		// 所有该链接下的浏览记录
		$link_visits = Browser::whereIn('link_id', $links->pluck('mi_link_id'))
			->orderBy('id', 'asc')->get();

		// 查找设备去重，一个设备激活多个链接的情况下，只取用最想先激活的链接
		$device_ids = $link_visits->pluck('device_id')->unique(); // 所有关联设备id
		$link_device_visits = Browser::whereIn('device_id', $device_ids)->orderBy('id', 'asc')->get();
		// 过滤掉没有激活过的记录
		$link_device_visits = $link_device_visits->filter(function($value, $key) {
			return $value['used'] > 0;
		});
		// 只保留第一条设备记录
		$link_device_visits = $link_device_visits->unique('device_id');
		// 第一次被激活的记录的id
		$first_visit_ids = $link_device_visits->pluck('id')->toArray();
//		$first_devices = [];

		// 所有该链接下的支付信息，按照更新时间倒叙排序
		$today = strtotime(date("Y-m-d"),time());  // 当天00点的时间
		// 昨日凌晨到现在的更新数据，每个用户至少包含两条数据
		$link_pay = PlayerPay::where('updated_at', '>=', $today - 3600 * 24)
			->whereIn('link_id', $links->pluck('mi_link_id'))
			->orderBy('updated_at', 'desc')->get();
		// 每天保留一条玩家数据
		$link_pay = $link_pay->unique(function($item) {
			return $item['player_id'] . date('Y-m-d', strtotime($item['updated_at']));
		})->values();

		$paid_player = [];
		// 按照 link_id 分组
		$link_visits = $link_visits->groupBy('link_id');
		$link_pay = $link_pay->groupBy('link_id');
//		$links = $links->toArray(); // 转化为数组便于添加值
		foreach ($links as $link_key => $link_value) {
			// 初始化总值统计
			$total = $this->formatTotal();

			// 统计每一组 link_id 下面的数据
			if (isset($link_visits[$link_value['mi_link_id']])) {
				foreach ($link_visits[$link_value['mi_link_id']] as $visit) {
					// 访问量不区分新老玩家
					$total['visited'] += $visit['visited'];
					$total['visited_device'] += 1;

					$this->total['visited'] += $visit['visited'];
					$this->total['visited_device'] += 1;
					// 统计激活量
					if ($visit['used'] > 0) {
						// 统计新玩家，规则添加：查看是否为第一次激活该设备的记录
						if (in_array($visit['channel_id'], $channel_ids)
							&& in_array($visit['id'], $first_visit_ids)) {
							// 一个设备只算一次，使用过才计算
							// 统计同渠道号新增，激活
							$total['used_new'] += 1;
							$total['used_time_new'] += $visit['used'];
							$total['used'] += 1;

							$this->total['used_new'] += 1;
							$this->total['used'] += 1;
							$this->total['used_time_new'] += $visit['used'];
//							$first_devices[] = $visit['device_id'];  // 记录新增的设备
						} else {
							// 统计老设备新增
							$total['used_old'] += 1;
							$total['used_time_old'] += $visit['used'];

							$this->total['used_old'] += 1;
							$this->total['used_time_old'] += $visit['used'];
						}
					}
				}
			}

			if (isset($link_pay[$link_value['mi_link_id']])) {
				foreach ($link_pay[$link_value['mi_link_id']] as $pay) {
					// 一个玩家记录统计一次, 统计实际新增设备
					//|| !in_array($pay['device_id'], $first_devices) 暂时去掉设备强规则校验
					if (in_array($pay['player_id'], $paid_player)) {
						continue;
					}
					if (strtotime($pay['updated_at']) >= $today) { // 今日更新的数据
						$total['pay'] += floatval($pay['pay']) * $this->ratio;
						$this->total['pay'] += floatval($pay['pay']) * $this->ratio;

						$total['pay_down'] += floatval($pay['pay']) * $this->down_ratio;
						$this->total['pay_down'] += floatval($pay['pay']) * $this->down_ratio;
					} else {  // 昨日更新的数据
						$total['pay_yesterday'] += floatval($pay['pay']) * $this->ratio;
						$this->total['pay_yesterday'] += floatval($pay['pay']) * $this->ratio;
					}
				}
			}

//			$total['pay'] = floor($today['pay'] * 100) / 100;
//			$this->total['pay'] = floor($this->total['pay'] * 100) / 100;

			// 将所有的统计信息写入 link 模型中
			foreach ($total as $total_key => $total_value) {
				$links[$link_key][$total_key] = $total_value;
			}

		}
		return $links;
	}

	/**
	 * 获取某个用户的所有链接，并统计每个链接的访问量和激活量
	 * @param array $query
	 * @param $perpage
	 * @param $page
	 * @param null $user 可选的用户，默认为当前登陆用户
	 * @return mixed
	 * @internal param $user
	 */
	public function getListByPerson($query = [], $perpage, $page, $user = null)
	{
		$user ?: $user = Admin::user();

		if ($user->parent()->parent()->id == 3) {
			$this->ratio = $ratio = 0.38;
			$this->down_ratio = 0.38;
		} else {
			$this->ratio = $ratio = 0.209475;
			$this->down_ratio = 0.209475;
		}

		$page_data = $this->paginate(
			$this->getLinkByUser($user, $query['game_id']),
			$perpage, $page
		);

		// 酬金比例分成
		$total = $this->total;

		// 同时返回总体的数据，便展示
		$page_data['extend'] = $this->total;
		return $page_data;
	}

	/**
	 * 获取当前带来公司所创建链接的访问量和激活量
	 * @param array $query
	 * @param $perpage
	 * @param $page
	 * @param null $user 可选的用户，默认为当前登陆用户
	 * @return mixed
	 */
	public function getListByAgent($query = [], $perpage, $page, $user = null)
	{
		$user ?: $user = Admin::user();

		if ($user->parent()->id == 3) {
			$this->ratio = $ratio = 0.095;
			$this->down_ratio = 0.38;
		} else {
			$this->ratio = $ratio = 0.089775;
			$this->down_ratio = 0.209475;
		}

		$page_data = $this->paginate(
			$this->getLinkByUser($user, $query['game_id'], true),
			$perpage, $page
		);

		// 酬金比例分成
		$total = $this->total;

		// 同时返回总体的数据，便展示
		$page_data['extend'] = $total;
		return $page_data;
	}

	/**
	 * 获取当前地推公司的管辖的代理的访问量和激活量
	 * @param array $query
	 * @param $perpage
	 * @param $page
	 * @param null $user 可选的用户，默认为当前登陆用户
	 * @param bool $parent
	 * @return mixed
	 */
	public function getListByCompany($query = [], $perpage, $page, $user = null, $parent = false)
	{
		$user ?: $user = Admin::user();
		// 当前用户的所有直接下级 agent
		$down_users = $user->getDirectDownUsers();
		$total = $this->initTotal();

		// 酬金比例分成, 上级调用避免覆盖比例
		if (!$parent) {
			if ($user->id == 3) {
				$this->ratio = $ratio = 0;
				$this->down_ratio = 0.095;
			} else {
				$this->ratio = $ratio = 0.12825;
				$this->down_ratio = 0.089775;
			}
		}

		foreach ($down_users as $key => $down_user) {
			// 初始化总值统计
			$this->initTotal();
			// 统计每个用户创建连接的情况
			$this->getLinkByUser($down_user, $query['game_id'], true);
			// 记录该用户的总访问和激活数据, 保证数据一致性
			foreach ($this->total as $key_t => $value_t) {
				$down_users[$key][$key_t] = $value_t;
			}

			// 将所有统计数据写入 total 中累计统计
			foreach ($total as $filed => $value) {
				$total[$filed] += $this->total[$filed];
			}
		}

		$page_data = $this->paginate($down_users,
			$perpage, $page);
		$page_data['extend'] = $total;
		return $page_data;
	}

	/**
	 * 获取当前地推公司管理者的管理的地推公司的访问量和激活量
	 * @param array $query
	 * @param $perpage
	 * @param $page
	 * @return mixed
	 */
	public function getListByCompanyAdmin($query = [], $perpage, $page)
	{
		$down_users = Admin::getDirectDownUsers();
		$total = $this->initTotal();


		// 统计每个company
		foreach ($down_users as $key => $down_user) {

			// 长沙特殊处理
			if ($down_user->id == 3) {
				// 酬金比例分成
				$this->ratio = $ratio = 0.475;
				$this->down_ratio = 0;
			} else {
				// 酬金比例分成
				$this->ratio = $ratio = 0.5225;
				$this->down_ratio = 0.12825;
			}

			// 获取每个 company 的统计数据
			$down_user_statistics = $this->getListByCompany($query, 0, 0, $down_user, true);
			$company_total = $down_user_statistics['extend'];

			// 将每个公司的总统计数据写入该公司用户数据中
			foreach ($company_total as $key_c => $value_c) {
				$down_users[$key][$key_c] = $value_c;
			}

			// 统计总的结果
			foreach ($total as $filed => $value) {
				$total[$filed] += $company_total[$filed];
			}
		}

		$page_data = $this->paginate($down_users,
			$perpage, $page);
		$page_data['extend'] = $total;
		return $page_data;
	}

	/**
	 * 获取某个链接所带来的所有用户
	 * @param $link
	 */
	public function getPlayerByLink($link)
	{
		is_numeric($link) ? $link_id = $link : $link_id = $link->mi_link_id;
		// 所有该链接带来的用户之间关系
		$relations = Relation::where('link_id', '=', $link_id)->groupBy('invite_player_id')->get()->pluck('invite_player_id')->unique();
		return $relations;
	}

	/**
	 * 获取某一批玩家的指定游戏和指定渠道的充值数据
	 * @param array $player_ids  玩家id
	 * @param array $channel_ids  渠道id
	 * @param int $game_id 游戏id
	 * @return array|bool
	 */
	public function getPlayerPay($player_ids, $channel_ids, $game_id) {
//		$player_id = $relations->pluck('invite_player_id')->unique();
//		$game_id = $relations->pluck('game_id')->unique();
//		$channel_id = $relations->pluck('channel_id')->unique();

		$type = [];
		foreach ($channel_ids as $channel_id) {
			$type[] = $channel_id . '_' . $game_id;
		}

		$code = 'Jvzjx9UbTFdZztZT5#7yxRVjvlTDNvpH';
		$ver = 1;
		$params = [
			'id' => $player_ids,
			'type' => $type,
			'ver' => $ver,
			'token' => md5($player_ids[0] . $type[0] . $code . 'V' . $ver . $code . $type[0] . $player_ids[0])
		];

		// 去数据中心查询这一批用户的支付数据
		$response = Requests::post('http://edatars.idreamsky.com/usertag/game/batch', ['batch' => json_encode($params)]);
//		$response = '{"status":0,"success":true,"data":[{"id":"1238692311","tags":[{"paid":"48.0"}]},{"id":"1238692334","tags":[]},{"id":"1238692390","tags":[]}]}';

		// 如果返回值为空则返回失败
		if (empty($response)) {
			return false;
		}
		$response = json_decode($response, true);

		// status 状态为0则请求成功
		if (!isset($response['status']) || $response['status'] !== 0 || empty($response['data'])) {
			return false;
		}

		$player_pay = [];
		foreach ($response['data'] as $item) {
			// 过滤掉空值,没有查到该玩家数据
			if (empty($item) || empty($item['tags'])) {
				continue;
			}

			foreach ($item['tags'] as $tag_key => $tag_value) {
				// 没有查到该渠道数据
				if ($tag_value) {
					$type_info = explode('_', $tag_value['type']);
					$player_pay[] = [
						'player_id' => $item['id'],
						'channel_id' => $type_info[0],
						'game_id' => $type_info[1],
						'pay' => $tag_value['paid']
					];
				}
			}
		}

		return $player_pay;
	}

	/**
	 * 更新所有新增用户的金额信息
	 */
	public function updatePlayerPay()
	{
		// TODO 分页优化
		$game_id = 11828;
		// 查询所有数据
		$relations = Relation::where(['game_id' => $game_id])->orderBy('id', 'asc')->get();
		// 过滤掉空值
		$relations = $relations->filter();
		// 只记第一次确认关系的链接，只算第一次有效激活
		$relations = $relations->unique('invite_player_id');
		$channel_ids = $relations->pluck('channel_id')->unique();
		$player_pay = $this->getPlayerPay($relations->pluck('invite_player_id'), $channel_ids, $game_id);

		$relations = $relations->groupBy('invite_player_id');

		if (empty($player_pay)) {
			return false;
		}
		// 插入每个玩家的付费信息
		foreach ($player_pay as $pay_value) {
			if (isset($relations[$pay_value['player_id']])) {
				PlayerPay::create([
					'player_id' => $pay_value['player_id'],
					'game_id' => $pay_value['game_id'],
					'channel_id' => $pay_value['channel_id'],
					'link_id' => $relations[$pay_value['player_id']][0]['link_id'],
					'device_id' => $relations[$pay_value['player_id']][0]['device_id'],
					'pay' => $pay_value['pay']
				]);
			}
		}
	}
}