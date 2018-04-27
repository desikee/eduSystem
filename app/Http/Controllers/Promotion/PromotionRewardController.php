<?php

namespace app\Http\Controllers\Promotion;

use App\Facades\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Promotion\PromotionStatisticsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 推广酬金相关控制器
 * Class PromotionStatisticsController
 * @package app\Http\Controllers\Promotion
 */
class PromotionRewardController extends Controller
{

	public function __construct(PromotionStatisticsRepository $repository, Request $request)
	{
		parent::__construct($repository, $request);
	}

	public function index() {
		$view = 'promotion.reward.' . Admin::getRole()->name;
		// 如果没有自定义角色地图，使用默认
		if (!view()->exists($view)) {
			$view = 'promotion.reward.person';
		}
		return view($view);
	}

	public function getList() {
		$rules = [
			'datatable.game_id' => 'required|numeric',
			'datatable.pagination.page' => 'required',
			'datatable.pagination.perpage' => 'required',
		];
		$validator = Validator::make($this->params, $rules);
		if ($validator->fails()) {
			$this->responseWithJsonFail($validator->errors()->messages());
		}

		$query = $this->params['datatable']['query'] ?? [];
		$queryColumn = [];
		foreach ($query as $key => $value) {
			// 过滤掉非允许查询字段以及空查询字段
			if (!in_array($key, $queryColumn) || empty($value)){
				unset($query[$key]);
			}
		}
		// 游戏id参数
		$query['game_id'] = $this->params['datatable']['game_id'];

		switch(Admin::getRole()->name) {
			case 'admin': $method = 'getListByAdmin';break;
			case 'person' : $method = 'getListByPerson';break;
			case 'agent' : $method = 'getListByAgent';break;
			case 'company' : $method = 'getListByCompany';break;
			case 'company_admin'; $method = 'getListByCompanyAdmin';break;
			default: $method = 'getListByPerson';
		}
		return $this->repository->$method(
			$query,
			$this->params['datatable']['pagination']['perpage'],
			$this->params['datatable']['pagination']['page']
		);
	}
	
}