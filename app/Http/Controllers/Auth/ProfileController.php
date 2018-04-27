<?php

namespace app\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Repositories\Admin\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function __construct(UserRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function index() {
        return view('auth.profile');
    }

	public function update_profile() {
        $rules = [
            'id' => 'required|numeric',
            'avatar' => 'required|string|url',
            'company' => 'required|string',
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

    public function modify_password() {
        $rules = [
            'id' => 'required|numeric',
            'old_password' => 'required|string|url',
            'new_password' => 'required|string',
            'confirm_password' => 'required|string',
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->fails()) {
            $this->responseWithJsonFail($validator->errors()->messages());
        }
        $user = $this->repository->find($this->params['id']);
        if (empty($user)) {
            return $this->responseWithJsonFail('没有找到该用户');
        }
        if ($this->params['confirm_password'] != $this->params['new_password']) {
            return $this->responseWithJsonFail('两次输入的密码不相同');
        }
        if ($this->params['old_password'] == $this->params['new_password']) {
            return $this->responseWithJsonFail('新密码和旧密码不能相同');
        }
        if (!Auth::attempt(['username' => $user->username,
            'password' => $this->params['old_password']])) {
            return $this->responseWithJsonFail('旧密码不正确');
        }
        $this->params['password'] = bcrypt($this->params['new_password']);
        if ($this->repository->edit($this->params, [])){
	        Auth::logout(); // 用户登出
            // 退出登录
            if (isset($this->params['clear']) && $this->params['clear'] == 1) {
	            return $this->responseWithJsonSuccess(['redirect' => '/login']);
            }
            return $this->responseWithJsonSuccess();
        }
        return $this->responseWithJsonFail($this->repository->getErrorMessage());
    }
}