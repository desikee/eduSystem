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

	public function getProgressStudentList($query = [], $perpage, $page)
	{
	    $query['status'] = Task::STATUS_DETAIL['default'];
	    $query['teacher_id'] = Admin::user()->id;
		$results = $this->model->where($query)->orderBy('id', 'desc')->get();
		return $this->paginate(
            $results,
			$perpage, $page
		);
	}


    public function getProgressStudent()
    {
        $student_ids = $this->model->where(['teacher_id' => Admin::user()->id,'status'=> Task::STATUS_DETAIL['create']])
            ->get()->pluck('student_id');
        return User::whereIn('id', $student_ids)->get();
    }


    public function addTask($params, $rules = []){
	    $params['teacher_id'] = Admin::user()->id;


	    $rules = [];
	    return parent::add($params, $rules);
    }

    public function getStudentTaskList($query = [], $perpage, $page){
        $query['status'] = Task::STATUS_DETAIL['default'];
        $query['student_id'] = Admin::user()->id;
        $results = $this->model->where($query)->orderBy('id', 'desc')->get();
        return $this->paginate(
            $results,
            $perpage, $page
        );
    }

    public function updateStatus($teacher_id, $student_id, $status){
	    $tasks = $this->model->where(['teacher_id'=>$teacher_id, 'student_id'=>$student_id])->get();
	    foreach ($tasks as $task){
	        $task->status = $status;
	        $task->save();
        }
    }

}