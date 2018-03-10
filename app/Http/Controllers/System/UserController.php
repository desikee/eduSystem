<?php

namespace app\Http\Controllers\System;


use App\Http\Controllers\Controller;
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
	    $search_select = $this->repository->getSearchSelect();
        return view('system.user.index', [
	        'search_select' => $search_select
        ]);
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
        echo 'add';
        return;
    }

    public function edit() {
        echo 'edit';
    }

    public function delete() {

    }
}