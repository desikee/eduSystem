<?php

namespace app\Http\Controllers\Student;

use App\Facades\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Train\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 学员进度管理
 * Class StudentProgressController
 * @package app\Http\Controllers\Promotion
 */
class StudentProgressController extends Controller
{

	public function __construct(TaskRepository $repository, Request $request)
	{
		parent::__construct($repository, $request);
	}

	public function index()
	{
	    $students = $this->repository->getProgressStudent();
		return view('student.progress', [
		    'students' => $students
        ]);
	}

	public function getList()
	{
		$rules = [
			'datatable.pagination.page' => 'required',
			'datatable.pagination.perpage' => 'required',
		];
		$validator = Validator::make($this->params, $rules);
		if ($validator->errors()) {
			$this->responseWithJsonFail($validator->errors()->messages());
		}

		$query = $this->params['datatable']['query'] ?? [];
		$queryColumn = ['usernameSearch', 'student_id'];
		foreach ($query as $key => $value) {
			// 过滤掉非允许查询字段以及空查询字段
			if (!in_array($key, $queryColumn) || empty($value)){
				unset($query[$key]);
			}
		}

		return $this->repository->getList(
			$query,
			$this->params['datatable']['pagination']['perpage'],
			$this->params['datatable']['pagination']['page']
		);
	}


    public function getProgressList()
    {
        $rules = [
            'datatable.pagination.page' => 'required',
            'datatable.pagination.perpage' => 'required',
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->errors()) {
            $this->responseWithJsonFail($validator->errors()->messages());
        }

        $query = $this->params['datatable']['query'] ?? [];
        $queryColumn = ['usernameSearch', 'student_id'];
        foreach ($query as $key => $value) {
            // 过滤掉非允许查询字段以及空查询字段
            if (!in_array($key, $queryColumn) || empty($value)){
                unset($query[$key]);
            }
        }

        return $this->repository->getProgressStudentList(
            $query,
            $this->params['datatable']['pagination']['perpage'],
            $this->params['datatable']['pagination']['page']
        );
    }


	public function getChannel()
	{
		return $this->repository->getChannel();
	}

	public function add()
	{
//	    print_r($this->params);
//
		$rules = [
		    'student_id'=>'required|numeric',
            'teacher_task' => 'required|string',
            'student_task' => 'required|string',
            'take_time' => 'required|string',
            'start'=>'date',
            'deadline'=>'date'
		];
		$validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
			return $this->responseWithJsonFail($validator->errors()->messages());
		}


		if ($this->repository->addTask($this->params, $rules)) {
			return $this->responseWithJsonSuccess();
		}
		return $this->responseWithJsonFail($this->repository->getErrorMessage());
	}

    public function edit()
    {
        $rules = [
            'id' => 'required|numeric',
            'teacher_task' => 'required|string',
            'student_task' => 'required|string',
            'take_time' => 'required|string',
            'start'=>'date',
            'deadline'=>'date'
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
            $this->responseWithJsonFail($validator->errors()->messages());
        }
	 //   $this->params['channel_id'] = Admin::getChannelIdByGame($this->params['game_id']);
	    if ($this->repository->edit($this->params, $rules)){
            return $this->responseWithJsonSuccess();
        }
        return $this->responseWithJsonFail($this->repository->getErrorMessage());
    }

	public function reset()
	{
		$rules = [
			'id' => 'required|numeric',
		];
		$validator = Validator::make($this->params, $rules);
		if ($validator->fails()) {
			$this->responseWithJsonFail($validator->errors()->messages());
		}
		if ($this->repository->reset($this->params['id'])) {
			return $this->responseWithJsonSuccess();
		}
		return $this->responseWithJsonFail($this->repository->getErrorMessage());
	}

	public function delete()
	{
		$rules = [
			'id' => 'required|numeric',
		];
		$validator = Validator::make($this->params, $rules);
		if ($validator->fails()) {
			$this->responseWithJsonFail($validator->errors()->messages());
		}
		if ($this->repository->delete($this->params['id'])) {
			return $this->responseWithJsonSuccess();
		}
		return $this->responseWithJsonFail($this->repository->getErrorMessage());
	}
}