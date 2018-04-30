<?php
namespace App\Repositories\Train;

use App\Facades\Admin;
use App\Model\Admin\LinkBackend;
use App\Model\Admin\User;
use App\Model\Admin\UserGame;
use App\Model\MagicInstall\Config;
use App\Model\MagicInstall\Link;
use App\Model\Train\Task;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends AbstractRepository{
	
	protected $model;
	
	public function __construct(Task $model = null)
	{
		$model || $model = new Task();
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
	    $query['status'] = Task::STATUS_DETAIL['complete'];
		$results = $this->model->where($query)->orderBy('id', 'desc')->get();
		return $this->paginate(
            $results,
			$perpage, $page
		);
	}

    /**
     * 获取结项学员列表
     * @param array $query
     * @param $perpage
     * @param $page
     * @return mixed
     */
	public function getCompleteStudent($query = [], $perpage, $page)
    {
        $query['status'] = Task::STATUS_DETAIL['complete'];
        $query['teacher_id'] = Admin::user()->id;
        return $this->getList($query, $perpage, $page);
    }

    public function getProgressStudent()
    {
        $student_ids = $this->model->where(['teacher_id' => Admin::user()->id])
            ->get()->pluck('student_id');
        return User::whereIn('id', $student_ids)->get();
    }

	public function add($params, $rules = [])
	{

	}
}