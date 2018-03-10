<?php

namespace app\Http\Controllers\Game;


use App\Http\Controllers\Controller;
use App\Repositories\Game\GameConfigRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameConfigController extends Controller
{

	public function __construct(GameConfigRepository $repository, Request $request)
	{
		parent::__construct($repository, $request);
	}

	public function index() {
        return view('game.config');
    }

    public function getList() {
	    $rules = [
		    'datatable.pagination.page' => 'required|string',
		    'datatable.pagination.perpage' => 'required|string'
	    ];
	    $validator = Validator::make($this->params, $rules);
	    if ($validator->errors()) {
		    $this->responseWithJsonFail();
	    }

	    $query = $this->params['datatable']['query'] ?? [];
	    $queryColumn = [];
	    foreach ($query as $key => $value) {
		    // 过滤掉非允许查询字段以及空查询字段
		    if (!in_array($key, $queryColumn) || empty($value)){
			    unset($query[$key]);
		    }
	    }
	    $query['game_id'] = $this->params['datatable']['game_id'];

	    return $this->repository->getList(
		    $query,
		    $this->params['datatable']['pagination']['perpage'],
		    $this->params['datatable']['pagination']['page']
	    );
    }

    public function add() {
	    $rules = [
            'game_id' => 'required|numeric',
            'game_name' => 'required|string',
            'channel_id' => 'required|string',
            'channel_name' => 'required|string',
            'link_host' => 'required|string',
            'download_url' => 'required|string'
	    ];
	    $validator = Validator::make($this->params, $rules);
	    if ($validator->errors()) {
		    $this->responseWithJsonFail($validator->errors()->messages());
	    }
        $record = $this->repository->findByOption([
            'channel_id' => $this->params['channel_id'],
            'game_id' => $this->params['game_id']]);
	    if ($record) {
		    return $this->responseWithJsonFail('该渠道id已经被使用');
	    }
	    if ($this->repository->add($this->params, $rules)) {
		    return $this->responseWithJsonSuccess();
	    }
	    return $this->responseWithJsonFail($this->repository->getErrorMessage());
    }

    public function edit() {
	    $rules = [
		    'id' => 'required|numeric',
            'game_id' => 'required|numeric',
            'game_name' => 'required|string',
            'channel_id' => 'required|string',
		    'channel_name' => 'required|string',
		    'link_host' => 'required|string',
		    'download_url' => 'required|string'
	    ];
	    $validator = Validator::make($this->params, $rules);
	    if ($validator->fails()) {
		    $this->responseWithJsonFail($validator->errors()->messages());
	    }
	    $record = $this->repository->findByOption([
	        'channel_id' => $this->params['channel_id'],
            'game_id' => $this->params['game_id']]);
	    if ($record && $record->id != $this->params['id']) {
		    return $this->responseWithJsonFail('该渠道id已经被使用');
	    }
	    unset($rules['game_id'], $rules['game_name']);
	    if ($this->repository->edit($this->params, $rules)){
		    return $this->responseWithJsonSuccess();
	    }
	    return $this->responseWithJsonFail($this->repository->getErrorMessage());
    }

    public function delete() {
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