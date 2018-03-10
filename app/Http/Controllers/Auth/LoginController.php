<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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
        $this->middleware('guest')->except('logout');
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

    public function ajaxLogin() {
        if (Auth::attempt([
            'username' => Request::input('username'),
            'password' => Request::input('password'),
        ], Request::input('remember'))) {
            return $this->responseWithJsonSuccess(['redirectTo' => '/admin/home']);
        }
        return $this->responseWithJsonFail(1001, 'fail');
    }

    public function redirectTo (){
        if (Request::ajax()) {
            return $this->responseWithJsonSuccess(['redirectTo' => '/admin/home']);
        }
        else {
            return '/admin/home';
        }
    }
}
