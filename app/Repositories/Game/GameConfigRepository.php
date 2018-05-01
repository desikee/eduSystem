<?php
namespace App\Repositories\Game;

use App\Facades\Admin;
use App\Model\Admin\LinkBackend;
use App\Model\Admin\Role;
use App\Model\Admin\RoleUser;
use App\Model\Admin\User;
use App\Model\Admin\UserGame;
use App\Model\MagicInstall\Config;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class GameConfigRepository extends AbstractRepository{
	
	protected $model;
	
	public function __construct(Config $model = null)
	{
		$model || $model = new Config();
		$this->model = $model;
	}

	/**
	 * 获取当前用户可查看的链接类型
	 * @return mixed
	 */
	public function getSearchSelect()
	{
		if (Admin::hasRole('admin')) {
			$configs = $this->model->all();
		} else {
			$configs = $this->model->where(['game_id' => 11828])->get();
		}

		$search_select = [
			'game' => $configs->unique('game_id'),
			'channel' => $configs->unique('channel_id')
		];
		return $search_select;
	}

	public function getList($query = [], $perpage, $page) {
		$result = $this->model->where($query)->orderBy('id', 'desc')->get();
		return $this->paginate(
			$result,
			$perpage, $page);
	}

    public function edit($params, $rules = [])
    {
        if (!isset($params['id']))
        {
            $this->error_message = '没有查到该记录';
            return false;
        }
        $up = $this->find($params['id']);
        $old_link_host = $up->link_host;
        $new_link_host = $params['link_host'];
        $column_list = $this->getColumnList();
        $rules = $rules ?? $column_list;
        foreach ($params as $key => $value)
        {
            if (array_key_exists($key, $rules) && in_array($key, $column_list))
            {
                $up->$key = $value;
            }
        }
        if (!$up->save()) {
            $this->error_message = '保存数据库失败，请重试';
            return false;
        }
        // 同步到后台表
        if ($old_link_host != $new_link_host) {
            $backend_links = LinkBackend::where(['game_id' => $up->game_id])->get();
            foreach ($backend_links as $backend_link) {
                $backend_link->source_url = str_replace($old_link_host, $new_link_host, $backend_link->source_url);
                $backend_link->save();
            }
        }
        return true;
    }
}