<?php

namespace app\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Model\Admin\Role;
use App\Repositories\Admin\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $repository;

	public function __construct(UserRepository $repository, Request $request)
	{
		parent::__construct($repository, $request);
	}

    public function index() {

        return view('system.user.index');
    }


	public function getList() {
		$rules = [
			'datatable.pagination.page' => 'required|string',
			'datatable.pagination.perpage' => 'required|string'
		];
		$validator = Validator::make($this->params, $rules);
		if ($validator->fails()) {
			$this->responseWithJsonFail($validator->errors()->messages());
		}

		$query = $this->params['datatable']['query'] ?? [];
		$queryColumn = ['parent_id', 'company', 'role'];
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
        $rules = [
            'username' => 'required|numeric',
            'password' => 'required|numeric',
            'realname'=>'required|string',
            'status'=>'required|numeric'
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
            $this->responseWithJsonFail($validator->errors()->messages());
        }
        if($this->repository->hasUser($this->params['username'])){
            return $this->responseWithJsonFail('用户已存在');
        }
        $this->params['password'] = password_hash($this->params['password'], PASSWORD_DEFAULT);
        return $this->repository->add($this->params, $rules);

    }

    public function edit() {
        echo 'edit';
    }

    public function delete() {

    }
}