<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
//    return redirect()->intended('/login');
});

Auth::routes('admin');

//用户登陆路由群组
Route::group(['prefix' => 'admin', 'as' => 'admin', 'namespace' => 'Auth'], function()
{
    Route::get('home', 'HomeController@index');
    Route::get('login', 'LoginController@login');//用户登陆界面
    Route::post('login', 'LoginController@ajaxLogin');//用户登陆
    Route::get('logout', 'LoginController@logout');//用户登陆界面

});

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function() {

    Route::group(['prefix' => 'profile', 'as' => 'profile', 'namespace' => 'Auth'], function() {
        Route::get('index', 'ProfileController@index');
        Route::post('modify_password', 'ProfileController@modify_password');
        Route::post('update_profile', 'ProfileController@update_profile');
    });

    Route::group(['prefix' => 'system', 'as' => 'system.', 'namespace' => 'System'], function() {
        // 用户管理相关路由
        Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'UserController@index']);
            Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'UserController@getList']);
            Route::post('add', ['as' => 'add', 'uses' => 'UserController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'UserController@delete']);
        });

        // 权限管理相关路由
        Route::group(['prefix' => 'permission', 'as' => 'permission.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'PermissionController@index']);
            Route::post('add', ['as' => 'add', 'uses' => 'PermissionController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'PermissionController@edit']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'PermissionController@delete']);
        });

        // 角色管理相关路由
        Route::group(['prefix' => 'role', 'as' => 'role.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'RoleController@index']);
            Route::post('add', ['as' => 'add', 'uses' => 'RoleController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'RoleController@edit']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'RoleController@delete']);
            Route::get('getPermissionTree', ['as' => 'getPermissionTree', 'uses' => 'RoleController@getPermissionTree']);
            Route::get('getCurrentRole', ['as' => 'getCurrentRole', 'uses' => 'RoleController@getCurrentRole']);
        });
    });


	// 地推管理相关路由
    Route::group(['prefix' => 'promotion', 'as' => 'promotion.', 'namespace' => 'Promotion'], function () {
	    Route::group(['prefix' => 'link', 'as' => 'link.'], function() {
		    Route::get('index', ['as' => 'index', 'uses' => 'PromotionLinkController@index']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionLinkController@getList']);
		    Route::post('add', ['as' => 'add', 'uses' => 'PromotionLinkController@add']);
		    Route::post('edit', ['as' => 'edit', 'uses' => 'PromotionLinkController@edit']);
		    Route::post('delete', ['as' => 'add', 'uses' => 'PromotionLinkController@delete']);
	    });

	    Route::group(['prefix' => 'company', 'as' => 'company.'], function() {
		    Route::get('index', ['as' => 'index', 'uses' => 'PromotionCompanyController@index']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionCompanyController@getList']);
		    Route::post('add', ['as' => 'add', 'uses' => 'PromotionCompanyController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'PromotionCompanyController@edit']);
            Route::post('reset', ['as' => 'reset', 'uses' => 'PromotionCompanyController@reset']);
		    Route::post('delete', ['as' => 'delete', 'uses' => 'PromotionCompanyController@delete']);
	    });

	    Route::group(['prefix' => 'statistics', 'as' => 'statistics.'], function() {
		    Route::get('index', ['as' => 'index', 'uses' => 'PromotionStatisticsController@index']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionStatisticsController@getList']);
		    Route::match(['get', 'post'], 'getListTotal', ['as' => 'getListTotal', 'uses' => 'PromotionStatisticsController@getListTotal']);
	    });
    });

    Route::group(['prefix' => 'game', 'as' => 'game.', 'namespace' => 'Game'], function() {
        Route::group(['prefix' => 'config', 'as' => 'config.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'GameConfigController@index']);
            Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'GameConfigController@getList']);
            Route::post('add', ['as' => 'add', 'uses' => 'GameConfigController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'GameConfigController@edit']);
            Route::post('delete', ['as' => 'add', 'uses' => 'GameConfigController@delete']);
        });
    });

});


Route::get('/vue', 'VueController@index');

Route::get('/home', 'HomeController@index')->name('home');
