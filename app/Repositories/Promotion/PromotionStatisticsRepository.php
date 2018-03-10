<?php
namespace App\Repositories\Promotion;

use App\Facades\Admin;
use App\Model\Admin\LinkBackend;
use App\Model\Admin\Role;
use App\Model\Admin\RoleUser;
use App\Model\Admin\User;
use App\Model\Admin\UserGame;
use App\Model\MagicInstall\Browser;
use App\Model\MagicInstall\Config;
use App\Model\MagicInstall\Link;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class PromotionStatisticsRepository extends AbstractRepository{
	
	protected $model;

	private $total;
	private $records;
	
	public function __construct(LinkBackend $model = null)
	{
		$model || $model = new LinkBackend();
		$this->model = $model;
		$this->total = $total = [
			'visited' => 0,
			'used' => [
				'old' => 0,
				'new' => 0
			]

        ];
		$this->records = [];
	}

	public function getLinkCount(){
		if (Admin::hasRole('company_admin')) {
			$role = Role::where(['name' => 'company'])->first();
			if (empty($role)) {
				$this->error_message = '没有找到该角色';
				return false;
			}
			$users = RoleUser::where(['role_id' => $role->id])->get();
			// 需要游戏参数
			$channel_ids = UserGame::whereIn('user_id', $users->pluck('user_id'))->get()->pluck('channel_id')->toArray();
			$links = $this->model->whereIn('user_id', $users->pluck('user_id'))->get();

		} else {
			$user = Auth::getUser();
			$query['user_id'] = $user->id;
			// 查询该用户的所有链接
			$links = $this->model->where($query)->get();
			// 所有链接的 channel_id 列表
			$channel_ids = $links->pluck('channel_id')->toArray();
		}

		$link_visits = Browser::whereIn('link_id', $links->pluck('mi_link_id'))->get();
		$link_visits = $link_visits->groupBy('link_id');

		$links = $links->toArray();
		foreach ($links as $key => $link) {
			$links[$key]['visited'] = 0;  // 访问次数
			$links[$key]['used'] = 0;  // 激活次数
			if (isset($link_visits[$link['mi_link_id']])) {
				foreach ($link_visits[$link['mi_link_id']] as $visit) {
					// 访问量不区分新老玩家
					$links[$key]['visited'] += $visit['visited'];
					$this->total['visited'] += $visit['visited'];
					// 统计激活量
					if ($visit['used'] > 0) {
						// 统计新玩家
						if (in_array($visit['channel_id'], $channel_ids))
						{
							// 一个设备只算一次，使用过才计算
							// 统计同渠道号新增，激活
							$links[$key]['used'] += 1;
							$this->total['used']['new'] += 1;
						} else {
							// 统计老设备新增
							$this->total['used']['old'] += 1;
						}
					}
				}
			}
		}

        $this->records = $links;
        return $links;
    }

    public function getTotal(){
	    $this->getLinkCount();
	    $this->total['used']['total'] = $this->total['used']['new'] + $this->total['used']['old'];
	    $this->total['percent']['used_visited'] = $this->calPercent($this->total['used']['total'],
		    $this->total['visited']);
	    $this->total['percent']['new_all'] = $this->calPercent($this->total['used']['new'],
		    $this->total['used']['total']);
	    $this->total['percent']['new_visited'] = $this->calPercent($this->total['used']['new'],
		    $this->total['visited']);
	    return $this->total;
    }

	public function calPercent($part, $total) {
		return $total == 0 ? 0 : round($part / $total * 100, 2);
	}

	public function getList($query = [], $perpage, $page) {
		return $this->paginate(
            $this->getLinkCount(),
			$perpage, $page
		);
	}

	public function getListTotal($query = [], $perpage, $page) {
		$role = Role::where(['name' => 'company'])->first();
		if (empty($role)) {
			$this->error_message = '没有找到该角色';
			return false;
		}
		$users = RoleUser::where(['role_id' => $role->id])->get();
		// 需要游戏参数
		$game_users = UserGame::whereIn('user_id', $users->pluck('user_id'))->get();

		$game_users = $game_users->toArray();
		foreach ($game_users as $key => $game_user) {
			$user_info = User::find($game_user['user_id']);
			$game_users[$key]['username'] = $user_info->username;
			$game_users[$key]['company'] = $user_info->company;
			$game_users[$key]['visited'] = 0;
			$game_users[$key]['used'] = 0;

			// 查询该用户的所有链接
			$links = $this->model->where(['user_id' => $user_info->id])->get();
			// 所有链接下的channel_id
			$channel_ids = $links->pluck('channel_id')->toArray();
			// 所有该链接下的浏览记录
			$link_visits = Browser::whereIn('link_id', $links->pluck('mi_link_id'))->get();
			$link_visits = $link_visits->groupBy('link_id');

			foreach ($links as $link) {
				if (isset($link_visits[$link['mi_link_id']])) {
					foreach ($link_visits[$link['mi_link_id']] as $visit) {
						// 访问量不区分新老玩家
						$game_users[$key]['visited'] += $visit['visited'];
						// 统计激活量
						if ($visit['used'] > 0) {
							// 统计新玩家
							if (in_array($visit['channel_id'], $channel_ids))
							{
								// 一个设备只算一次，使用过才计算
								// 统计同渠道号新增，激活
								$game_users[$key]['used'] += 1;
							}
						}
					}
				}
			}
		}
		return $this->paginate(
			$game_users,
			$perpage, $page
		);
	}

}