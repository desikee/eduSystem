<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AbstractRepository;
use App\Repositories\Contracts\CommonRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class CustomController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;

	/**
	 * 依赖的数据库操作仓库实例
	 * @var AbstractRepository
	 */
	public $repository;

	/**
	 * repository 类名称
	 * @var string
	 */
	public $repositoryClass = CommonRepository::class;

	/**
	 * 输入参数列表
	 * @var array
	 */
	public $params;

	/**
	 * 请求实例
	 * @var Request
	 */
	public $request;

	/**
	 * 参数验证实例
	 * @var
	 */
	public $validator;

	/**
	 * 参数校验规则表
	 * @var array
	 */
	public $rules;

	/**
	 * 参数校验自定义属性名
	 * @var array
	 */
	public $customAttributes;

	/**
	 * 参数校验返回信息
	 * @var array
	 */
	public $messages;

	public function __construct(Request $request)
	{
		$this->repository = new $this->repositoryClass;
		$this->request = $request;
		$this->params = $this->request->all();
	}

	/**
	 * 根据相应的规则校验输入
	 * @param array $rules
	 * @param array $messages
	 * @param array $customAttributes
	 * @return array
	 */
	public function validate(array $rules = [],
	                         array $messages = [], array $customAttributes = [])
	{
		$rules && $rules = $this->rules;
		$messages && $messages = $this->messages;
		$customAttributes && $customAttributes = $this->customAttributes;
		if (empty($this->validator)) {
			$this->validator = $this->getValidationFactory()
				->make($this->params, $rules, $messages, $customAttributes);
		} else {
			$this->validator->setRules($rules);
			$this->validator->setCustomMessages($messages);
		}
		$this->validator->validate();
		return $this->extractInputFromRules();
	}

	/**
	 * 根据规则过滤输入参数
	 * @param bool $filter_param  是否过滤参数
	 * @return array
	 */
	public function extractInputFromRules($filter_param = false)
	{
		$extract_input = [];
		foreach ($this->rules as $rule) {
			$rule = Str::contains($rule, '.') ? explode('.', $rule)[0] : $rule;
			$extract_input[$rule] = $this->params[$rule];
		}
		$filter_param && $this->params = $extract_input;
		return $extract_input;
	}

	/**
	 * 获取 validation 工厂实例
	 *
	 * @return \Illuminate\Contracts\Validation\Factory
	 */
	protected function getValidationFactory()
	{
		return app(Factory::class);
	}

	public function add()
	{
		$this->validate();
	}

	public function addRules()
	{
		return $this->rules;
	}
}
