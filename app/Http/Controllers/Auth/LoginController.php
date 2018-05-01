<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseWithCode;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }

    /**
     * 自定义用户名
     * @return string
     */
    public function username() {
        return 'username';
    }

    /**
     * 显示登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        $view_data = [
            'register' => false,
        ];
        return view('snippet.login', $view_data);
    }

	/**
	 * 用户已经认证成功之后的回调
	 * @param Request $request
	 * @param $user
	 * @return bool|\Illuminate\Http\JsonResponse
	 */
	protected function authenticated(Request $request, $user)
	{
		// 如果是ajax请求，返回json格式
		if ($request->expectsJson()) {
			return ResponseWithCode::success(['redirectTo' => $this->redirectTo()]);
		}
		return false;
	}

    public function redirectTo()
    {
	    $redirectUrl = '/admin/profile/index';
//        $redirectUrl = '/admin/home';
        return $redirectUrl;
    }
}
