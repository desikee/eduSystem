<?php

namespace app\Http\Controllers\Promotion;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Repositories\Promotion\PromotionCompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * 客服账号管理相关
 * Class PromotionSupportController
 * @package app\Http\Controllers\Promotion
 */
class PromotionSupportController extends CustomController
{
	public $repositoryClass = PromotionCompanyRepository::class;

	public function index()
	{
		return view('promotion.user.support');
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
		$queryColumn = ['usernameSearch', 'channel_id', 'company'];
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
			'username' => 'required|string|max:255|unique:user',
            'game_id' => 'required|numeric',
			'email' => 'required|string|email|max:255|unique:user',
//			'company' => 'required|string',
//			'phone' => 'required|string',
			'game_name' => '',
		];
		$messages = [
			'phone.required' => '请填入手机号',
			'username.min' => '用户名至少为8个字符'
		];
		var_dump($this->validate($this->request, $rules, $messages));

		try {
			$this->validate($this->request, $rules, $messages);
		}catch (ValidationException $exception) {
			var_dump($exception->errors());
		}

		$validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
	        var_dump($validator->errors());
			return $this->responseWithJsonFail($validator->errors()->messages());
		}
		if ($this->repository->findByOption(['username' => $this->params['username']])) {
			return $this->responseWithJsonFail('用户名已经被使用');
		}
		return $this->responseWithJsonSuccess();
		if ($this->repository->add($this->params, $rules)) {
			return $this->responseWithJsonSuccess();
		}
		return $this->responseWithJsonFail($this->repository->getErrorMessage());
	}

    public function edit()
    {
        $rules = [
            'id' => 'required|numeric',
            'channel_id' => 'required|string',
            'game_id' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:user',
            'company' => 'required|string'
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
            $this->responseWithJsonFail($validator->errors()->messages());
        }
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