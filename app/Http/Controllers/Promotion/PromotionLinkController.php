<?php

namespace app\Http\Controllers\Promotion;

use App\Facades\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Promotion\PromotionLinkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionLinkController extends Controller
{

	public function __construct(PromotionLinkRepository $repository, Request $request)
	{
		parent::__construct($repository, $request);
	}

	public function index()
	{
		$search_select = $this->repository->getSearchSelect();
		$role = Admin::getRole();

		switch($role->name) {
			case 'admin' : $view = 'promotion.link.index';break;
			case 'person' : $view = 'promotion.link.person';break;
			case 'agent' : $view = 'promotion.link.agent';break;
			default: $view = 'home';
		}

        return view($view,[
	        'down_users' => Admin::getDirectDownUsers(),
	        'search_select' => $search_select
        ]);
    }

    public function getList()
    {
	    $rules = [
		    'datatable.pagination.page' => 'required|string',
		    'datatable.pagination.perpage' => 'required|string'
	    ];
	    $validator = Validator::make($this->params, $rules);
	    if ($validator->fails()) {
		    $this->responseWithJsonFail();
	    }

	    $query = $this->params['datatable']['query'] ?? [];
	    $queryColumn = ['create_id', 'user_id', 'action_name'];
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

    public function add()
    {
	    $rules = [
		    'game_id' => 'required|numeric',
		    'link_name' => 'required|string',
		    'action_name' => 'required|string',
		    'user_id' => 'required|numeric',
		    'transport' => '',
	    ];
	    $validator = Validator::make($this->params, $rules);
	    if ($validator->fails()) {
		    $this->responseWithJsonFail($validator->errors()->messages());
	    }
	    if ($this->repository->findByOption(['link_name' => $this->params['link_name']])) {
		    return $this->responseWithJsonFail('连接名称已经被使用');
	    }
	    if ($this->repository->add($this->params, $rules)) {
		    return $this->responseWithJsonSuccess();
	    }
	    return $this->responseWithJsonFail($this->repository->getErrorMessage());
    }

    public function edit()
    {
	    $rules = [
		    'id' => 'required|numeric',
		    'link_name' => 'required|string',
//		    'user_id' => 'required|numeric', // 链接拥有人不能修改
		    'action_name' => 'required|string',
		    'transport' => '',
	    ];
	    // 非管理员关闭链接编辑
	    if (!Admin::hasRole('admin')) {
		    return $this->responseWithJsonFail('链接编辑已被禁用');
	    }
	    $validator = Validator::make($this->params, $rules);
	    if ($validator->fails()) {
		    $this->responseWithJsonFail($validator->errors()->messages());
	    }
	    $record = $this->repository->findByOption(['link_name' => $this->params['link_name']]);
	    if ($record && $record->id != $this->params['id']) {
		    return $this->responseWithJsonFail('链接名称已经被使用');

	    }
	    if ($this->repository->edit($this->params, $rules)){
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
		    $this->responseWithJsonFail();
	    }
	    if ($this->repository->delete($this->params['id'])){
		    return $this->responseWithJsonSuccess();
	    }
	    return $this->responseWithJsonFail($this->repository->getErrorMessage());
    }
}