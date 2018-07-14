<?php

namespace app\Http\Controllers\System;
use App\Http\Controllers\Controller;
use App\Model\Admin\Role;
use App\Repositories\Admin\UserRepository;
use App\Repositories\Train\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Train\CourseRepository;
use App\Model\Admin\User;

class SubjectController extends Controller
{
    protected $repository;

    public function __construct(CourseRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function index() {
        return view('system.subject.index');
    }

    public function update(){
        $students = $this->repository->getStudent();
        $teachers = $this->repository->getTeacher();
        return view('system.subject.update', ['students'=>$students, 'teachers'=>$teachers]);
    }

    public function update_course(){

    }
	public function getList() {
        $rules = [
            'datatable.pagination.page' => 'required',
            'datatable.pagination.perpage' => 'required',
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->errors()) {
            $this->responseWithJsonFail($validator->errors()->messages());
        }

        $query = $this->params['datatable']['query'] ?? [];
        $queryColumn = ['teacher_id', 'student_id'];
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

    public function add() {
        $rules =[
            'teacher_name'=>'required|numeric',
            'student_name'=>'required|numeric',
            'course_name'=>'required|string'
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
            return $this->responseWithJsonFail($validator->errors()->messages());
        }

     //   $teacher_id = User::where(['username'=> $this->params['teacher_name']])->first()->id;
    //    $student_id = User::where(['username'=> $this->params['student_name']])->first()->id;


    //    $teacher_id = $user_repository->getUserIDByUsername($this->params['teacher_name']);
     //   $student_id = $user_repository->getUserIDByUsername($this->params['student_name']);
        $teacher_id = $this->repository->getIDByUsername($this->params['teacher_name']);
        $student_id = $this->repository->getIDByUsername($this->params['student_name']);
        $this->params['teacher_id'] = $teacher_id;
        $this->params['student_id'] = $student_id;
        $task_params['teacher_id'] = $teacher_id;
       $task_params['student_id'] = $student_id;
        $task_params['status'] = 0;
        $task_params['teacher_task'] = '导师已开启新的指导项目，请为学员新增任务！';
        $task_repository = new TaskRepository();
        $task_repository->add($task_params, []);

        $new_rules = [
            'teacher_id'=>'required',
            'student_id'=>'required',
            'course_name'=>'required'
        ];

        if($this->repository->add($this->params, $new_rules)){
            return $this->responseWithJsonSuccess();
        }
        return $this->responseWithJsonFail($validator->errors()->messages());
    }


    public function edit() {
        $rules = [
            'id' => 'required|numeric',
            'teacher_instrument'=>'required|string',
            'teacher_duration'=>'required|string',
            'student_work'=>'required|string',
            'course_name'=>'required|string',
            'start_time'=>'required',
            'complete_time'=>'required',
            'status'=>'required|numeric'
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
            return $this->responseWithJsonFail($validator->errors()->messages());
        }
        $status = $this->params['status'];
        $id = $this->params['id'];
        $task_repository = new TaskRepository();
        $teacher_id = $this->repository->getCourse($id)->teacher_id;
        $student_id = $this->repository->getCourse($id)->student_id;
        $task_repository->updateStatus($teacher_id, $student_id, $status);
        if($this->repository->edit($this->params, $rules)){
            return $this->responseWithJsonSuccess();
        }


        return $this->responseWithJsonFail($validator->errors()->messages());
    }

    public function delete() {
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