<?php

namespace app\Http\Controllers\Promotion;


use App\Http\Controllers\Controller;
use App\Repositories\Promotion\PromotionStatisticsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionStatisticsController extends Controller
{

	public function __construct(PromotionStatisticsRepository $repository, Request $request)
	{
		parent::__construct($repository, $request);
	}

	public function index() {
	    $total = $this->repository->getTotal();
		return view('promotion.statistics.index', [
		    'total' => $total
        ]);
	}

	public function getList() {
		$rules = [
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

		return $this->repository->getList(
			$query,
			$this->params['datatable']['pagination']['perpage'],
			$this->params['datatable']['pagination']['page']
		);
	}

	public function getListTotal() {
		$rules = [
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

		return $this->repository->getListTotal(
			$query,
			$this->params['datatable']['pagination']['perpage'],
			$this->params['datatable']['pagination']['page']
		);
	}
	
}