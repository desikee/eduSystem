<?php

namespace app\Http\Controllers\Game;

use App\Facades\Admin;
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
        return view('game.config', [
	        'search_select' => $this->repository->getSearchSelect()
        ]);
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
	    $queryColumn = ['game_id', 'channel_id'];
	    foreach ($query as $key => $value) {
		    // 过滤掉非允许查询字段以及空查询字段
		    if (!in_array($key, $queryColumn) || empty($value)){
			    unset($query[$key]);
		    }
	    }
	    // 非管理员只开放梦幻花园
	    if (!Admin::hasRole('admin')) {
		    $query['game_id'] = 11828;
	    }

	    return $this->repository->getList(
		    $query,
		    $this->params['datatable']['pagination']['perpage'],
		    $this->params['datatable']['pagination']['page']
	    );
    }

    public function add() {
	    $rules = [
		    'appid' => 'required|numeric',
            'game_id' => 'required|numeric',
            'game_name' => 'required|string',
            'channel_id' => 'required|string',
            'channel_name' => 'required|string',
            'link_host' => 'required|string',
            'download_url' => 'required|string',
            'platform' => 'required|string',
		    'id_default' => 'required|string',
		    'scheme' => '',
		    'scheme_host' => '',
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
	    if (!Admin::hasRole('admin')) {
		    if ($this->params['game_id'] != 11828) {
			    return $this->responseWithJsonFail('您当前只能新增梦幻花园的配置: 游戏id不正确，应为: 11828');
		    }
		    if ($this->params['game_name'] != '梦幻花园（Android）') {
			    return $this->responseWithJsonFail('您当前只能新增梦幻花园的配置: 游戏名称不正确，应为: 梦幻花园（Android）');
		    }
		    if ($this->params['appid'] != 203) {
			    return $this->responseWithJsonFail('您当前只能新增梦幻花园的配置：游戏appid不正确，应为：203');
		    }
	    }

	    // 梦幻花园添加默认scheme配置，不开放更改
	    if ($this->params['game_id'] == 11828) {
		    $this->params['platform'] = 'android';
		    $this->params['scheme'] = 'magicinstall';
		    $this->params['scheme_host'] = 'mhhy.idreamsky.com';
	    }

	    if ($this->repository->add($this->params, $rules)) {
		    return $this->responseWithJsonSuccess();
	    }
	    return $this->responseWithJsonFail($this->repository->getErrorMessage());
    }

    public function edit() {
	    $rules = [
		    'id' => 'required|numeric',
		    'appid' => 'required|numeric',
		    'game_id' => 'required|numeric',
            'game_name' => 'required|string',
            'channel_id' => 'required|string',
		    'channel_name' => 'required|string',
		    'link_host' => 'required|string',
		    'download_url' => 'required|string',
		    'platform' => 'required|string',
		    'id_default' => 'required|string',
	    ];
	    $validator = Validator::make($this->params, $rules);
	    if ($validator->fails()) {
		    $this->responseWithJsonFail($validator->errors()->messages());
	    }
	    if (!Admin::hasRole('admin')) {
		    if ($this->params['game_id'] != 11828) {
			    return $this->responseWithJsonFail('您当前只能新增梦幻花园的配置: 游戏id: 11828');
		    }
		    if ($this->params['game_name'] != '梦幻花园（Android）') {
			    return $this->responseWithJsonFail('您当前只能新增梦幻花园的配置: 游戏名称: 梦幻花园（Android）');
		    }
		    if ($this->params['appid'] != 203) {
			    return $this->responseWithJsonFail('请输入梦幻花园的appid：203');
		    }
	    }

	    $record = $this->repository->findByOption([
	        'channel_id' => $this->params['channel_id'],
            'game_id' => $this->params['game_id']]);
	    if ($record && $record->id != $this->params['id']) {
		    return $this->responseWithJsonFail('该渠道id已经被使用');
	    }

	    // 梦幻花园添加默认scheme配置，不开放更改
	    if ($this->params['game_id'] == 11828) {
		    $this->params['platform'] = 'android';
		    $this->params['scheme'] = 'magicinstall';
		    $this->params['scheme_host'] = 'mhhy.idreamsky.com';
	    }

	    if ($this->repository->edit($this->params, $rules)){
		    return $this->responseWithJsonSuccess();
	    }
	    return $this->responseWithJsonFail($this->repository->getErrorMessage());
    }

    public function delete() {
	    $rules = [
		    'id' => 'required|numeric',
	    ];
	    if (!Admin::hasRole('admin')) {
		    return $this->responseWithJsonFail('配置已经创建不能删除，如果误操作，请联系管理人员！');
	    }
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