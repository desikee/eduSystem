<?php

namespace app\Http\Controllers\Promotion;

use App\Facades\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Promotion\PromotionCompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 推广人员管理控制器
 * Class PromotionPersonController
 * @package app\Http\Controllers\Promotion
 */
class PromotionPersonController extends Controller
{

	public function __construct(PromotionCompanyRepository $repository, Request $request)
	{
		parent::__construct($repository, $request);
	}

	public function index()
	{
		return view('promotion.user.person', [
            'search_select' => $this->repository->getSearchSelect()
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
		$queryColumn = ['usernameSearch', 'company'];
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

	public function getChannel()
	{
		return $this->repository->getChannel();
	}

	public function add()
	{
		$rules = [
			'username' => 'required|string|max:255|unique:user',
            'game_id' => 'required|numeric',
			'email' => 'required|string|email|max:255|unique:user',
			'company' => 'required|string'
		];
		$validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
			return $this->responseWithJsonFail($validator->errors()->messages());
		}
		if ($this->repository->findByOption(['username' => $this->params['username']])) {
			return $this->responseWithJsonFail('用户名已经被使用');
		}
		$this->params['channel_id'] = Admin::getChannelIdByGame($this->params['game_id']);
		if ($this->repository->add($this->params, $rules)) {
			return $this->responseWithJsonSuccess();
		}
		return $this->responseWithJsonFail($this->repository->getErrorMessage());
	}

    public function edit()
    {
        $rules = [
            'id' => 'required|numeric',
            'game_id' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:user',
            'company' => 'required|string'
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
            $this->responseWithJsonFail($validator->errors()->messages());
        }
	    $this->params['channel_id'] = Admin::getChannelIdByGame($this->params['game_id']);
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