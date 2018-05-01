<?php
namespace App\Repositories\Promotion;

use App\Facades\Admin;
use App\Model\Admin\LinkBackend;
use App\Model\Admin\User;
use App\Model\Admin\UserGame;
use App\Model\MagicInstall\Config;
use App\Model\MagicInstall\Link;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class PromotionLinkRepository extends AbstractRepository{
	
	protected $model;
	
	public function __construct(LinkBackend $model = null)
	{
		$model || $model = new LinkBackend();
		$this->model = $model;
	}

	/**
	 * 获取当前用户可查看的链接类型
	 * @return mixed
	 */
	public function getSearchSelect()
	{
	    $down_users = Admin::getDirectDownUsers();
	    $can_links = $this->model->whereIn('create_id', collect($down_users)->pluck('id'))->get();
	    return [
	        'down_users' => $down_users,
            'action_name' =>$can_links->pluck('action_name')->unique(),
            'user' => User::whereIn('id', $can_links->pluck('user_id'))->get()
        ];
	}

	public function getList($query = [], $perpage, $page)
	{
		// 一般用户只能查看自己使用的链接
		if (Admin::hasRole('person')) {
			// 一般用户过滤掉查询条件
			$action = $query['action'] ?? '';
			$query = [];
			$query['user_id'] = Admin::user()->id;
			$action && $query['action'] = $action;
		} elseif(!Admin::hasRole('admin')) {  // 其他非管理员只能看到自己创建的链接
			$query['create_id'] = Admin::user()->id;
		}
		$links = $this->model->where($query)->orderBy('id', 'desc')->get();
		return $this->paginate(
			$links,
			$perpage, $page
		);
	}

	/**
	 * 创建一条链接
	 * @param $params
	 * @param array $rules
	 * @return bool
	 */
	public function add($params, $rules = [])
	{
		if (LinkBackend::where(['link_name' => $params['link_name']])->first()) {
			$this->error_message = '该链接名称已被使用';
			return false;
		}

		$user = Auth::getUser();
		$user_game = UserGame::where(['user_id' => $user->id, 'game_id' => $params['game_id']])->first();
		if (empty($user_game)) {
			$this->error_message = '没有可用的游戏';
			return false;
		}
		$config = Config::where(['game_id' => $params['game_id'], 'channel_id' => $user_game->channel_id])->first();
		if (empty($config)) {
			$this->error_message = '没有可用渠道配置，请找管理人员重新分配渠道号！';
			return false;
		}

		$link_info = [
			'player_id' => 1,  // 1 代表后台
			'channel_id' => $user_game->channel_id,
			'gameid' => $params['game_id'],
			'appid' => $user_game->appid,
			'action' => $params['action'] ?? 'open',
			'creator' => 'backend',
			'transport' => $params['transport'],
			'extend' => $params['extend'] ?? '',
			'times' => 1,
		];

		$link = new Link();
		foreach ($link_info as $key => $value) {
			$link->$key = $value;
		}

		if (!$link->save()) {
			$this->error_message = '链接保存数据库失败';
			return false;
		}

		if (strpos($config->link_host, '?') === false) {
			$link->source_url = $config->link_host . '?link_id=' . $link->id;
		} else {
			$link->source_url = $config->link_host . '&link_id=' . $link->id;
		}
		if (!$link->save()) {
			$this->error_message = '更新链接的落地页面失败';
			return false;
		}

		$link_backend_info = [
			'mi_link_id' => $link->id,
			'link_name' => $params['link_name'],
			'create_id' => $user->id,
			'game_id' => $params['game_id'],
			'channel_id' => $user_game->channel_id,
			'appid' => $user_game->appid,
			'action_name' => $params['action_name'] ?? '',
			'user_id' => $params['user_id'],
			'short_url' => $link->short_url,
			'source_url' => $link->source_url,
			'extend' => $link->extend,
			'transport' => $link->transport
		];

		foreach ($link_backend_info as $key => $value) {
			$this->model->$key = $value;
		}
		if (!$this->model->save()) {
			$this->error_message = '后台链接地址备份失败';
			return false;
		}
		return true;
	}
}