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
    return redirect()->intended('/login');
});

Auth::routes('admin');

//用户登陆路由群组
Route::group(['middleware' => 'log', 'prefix' => 'admin', 'as' => 'admin', 'namespace' => 'Auth'], function()
{
    Route::get('home', 'HomeController@index');
    Route::get('login', 'LoginController@login');//用户登陆界面
    Route::post('login', 'LoginController@login');//用户登陆
    Route::get('logout', 'LoginController@logout');//用户登陆界面

});

Route::group(['middleware' => ['auth', 'log'], 'prefix' => 'admin', 'as' => 'admin.'], function() {

    Route::group(['prefix' => 'profile', 'as' => 'profile', 'namespace' => 'Auth'], function() {
        Route::get('index', 'ProfileController@index');
        Route::get('password', 'ProfileController@password');
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
		    Route::get('getChannel', ['as' => 'getChannel', 'uses' => 'PromotionCompanyController@getChannel']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionCompanyController@getList']);
		    Route::post('add', ['as' => 'add', 'uses' => 'PromotionCompanyController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'PromotionCompanyController@edit']);
            Route::post('reset', ['as' => 'reset', 'uses' => 'PromotionCompanyController@reset']);
		    Route::post('delete', ['as' => 'delete', 'uses' => 'PromotionCompanyController@delete']);
	    });

	    Route::group(['prefix' => 'agent', 'as' => 'agent.'], function() {
		    Route::get('index', ['as' => 'index', 'uses' => 'PromotionAgentController@index']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionAgentController@getList']);
		    Route::post('add', ['as' => 'add', 'uses' => 'PromotionAgentController@add']);
		    Route::post('edit', ['as' => 'edit', 'uses' => 'PromotionAgentController@edit']);
		    Route::post('reset', ['as' => 'reset', 'uses' => 'PromotionAgentController@reset']);
		    Route::post('delete', ['as' => 'delete', 'uses' => 'PromotionAgentController@delete']);
	    });

	    Route::group(['prefix' => 'person', 'as' => 'person.'], function() {
		    Route::get('index', ['as' => 'index', 'uses' => 'PromotionPersonController@index']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionPersonController@getList']);
		    Route::post('add', ['as' => 'add', 'uses' => 'PromotionPersonController@add']);
		    Route::post('edit', ['as' => 'edit', 'uses' => 'PromotionPersonController@edit']);
		    Route::post('reset', ['as' => 'reset', 'uses' => 'PromotionPersonController@reset']);
		    Route::post('delete', ['as' => 'delete', 'uses' => 'PromotionPersonController@delete']);
	    });

	    Route::group(['prefix' => 'support', 'as' => 'support.'], function() {
		    Route::get('index', ['as' => 'index', 'uses' => 'PromotionSupportController@index']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionSupportController@getList']);
		    Route::post('add', ['as' => 'add', 'uses' => 'PromotionSupportController@add']);
		    Route::post('edit', ['as' => 'edit', 'uses' => 'PromotionSupportController@edit']);
		    Route::post('reset', ['as' => 'reset', 'uses' => 'PromotionSupportController@reset']);
		    Route::post('delete', ['as' => 'delete', 'uses' => 'PromotionSupportController@delete']);
	    });

	    Route::group(['prefix' => 'statistics', 'as' => 'statistics.'], function() {
		    Route::get('index', ['as' => 'index', 'uses' => 'PromotionStatisticsController@index']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionStatisticsController@getList']);
		    Route::match(['get', 'post'], 'getListTotal', ['as' => 'getListTotal', 'uses' => 'PromotionStatisticsController@getListTotal']);
	    });

	    Route::group(['prefix' => 'reward', 'as' => 'reward.'], function() {
		    Route::get('index', ['as' => 'index', 'uses' => 'PromotionRewardController@index']);
		    Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'PromotionRewardController@getList']);
		    Route::post('add', ['as' => 'add', 'uses' => 'PromotionRewardController@add']);
		    Route::post('edit', ['as' => 'edit', 'uses' => 'PromotionRewardController@edit']);
		    Route::post('reset', ['as' => 'reset', 'uses' => 'PromotionRewardController@reset']);
		    Route::post('delete', ['as' => 'delete', 'uses' => 'PromotionRewardController@delete']);
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

    // 学员管理相关路由
    Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Student'], function() {
        Route::group(['prefix' => 'progress', 'as' => 'progress.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'StudentProgressController@index']);
            Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'StudentProgressController@getList']);
            Route::post('add', ['as' => 'add', 'uses' => 'StudentProgressController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'StudentProgressController@edit']);
            Route::post('delete', ['as' => 'add', 'uses' => 'StudentProgressController@delete']);
        });

        Route::group(['prefix' => 'complete', 'as' => 'complete.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'StudentCompleteController@index']);
            Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'StudentCompleteController@getList']);
            Route::post('add', ['as' => 'add', 'uses' => 'StudentCompleteController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'StudentCompleteController@edit']);
            Route::post('delete', ['as' => 'add', 'uses' => 'StudentCompleteController@delete']);
        });
    });

});

Route::get('/home', 'HomeController@index')->name('home');