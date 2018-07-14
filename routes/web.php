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
        Route::get('background', 'ProfileController@background');
        Route::get('password', 'ProfileController@password');
        Route::post('modify_password', 'ProfileController@modify_password');
        Route::post('update_profile', 'ProfileController@update_profile');
        Route::post('update_background', 'ProfileController@update_background');
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

        // 项目管理相关路由
        Route::group(['prefix' => 'subject', 'as' => 'subject.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'SubjectController@index']);
            Route::get('update', ['as' => 'update', 'uses' => 'SubjectController@update']);
            Route::post('update_course', ['as' => 'update_course', 'uses' => 'SubjectController@update_course']);
            Route::match(['get', 'post'], 'getList', ['as'=>'getList', 'uses'=>'SubjectController@getList']);
            Route::post('addSubject', ['as' => 'addSubject', 'uses' => 'SubjectController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'SubjectController@edit']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'SubjectController@delete']);
        });

        // 渠道管理相关路由
        Route::group(['prefix' => 'support', 'as' => 'support.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'SupportController@index']);
            Route::post('add', ['as' => 'add', 'uses' => 'SupportController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'SupportController@edit']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'SupportController@delete']);
        });
    });

    // 学员管理相关路由
    Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Student'], function() {
        Route::group(['prefix' => 'progress', 'as' => 'progress.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'StudentProgressController@index']);
            Route::match(['get', 'post'], 'getProgressList', ['as' => 'getProgressList', 'uses' => 'StudentProgressController@getProgressList']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'StudentProgressController@edit']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'StudentProgressController@delete']);
            Route::post('add', ['as' => 'add', 'uses' => 'StudentProgressController@add']);
        });

        Route::group(['prefix' => 'complete', 'as' => 'complete.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'StudentCompleteController@index']);
            Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'StudentCompleteController@getList']);
            Route::post('add', ['as' => 'add', 'uses' => 'StudentCompleteController@add']);
            Route::post('edit', ['as' => 'edit', 'uses' => 'StudentCompleteController@edit']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'StudentCompleteController@delete']);
        });
    });

    //课题管理路由
    Route::group(['prefix'=>'course', 'as'=>'course', 'namespace'=>'Course'], function (){
       Route::get('index', ['as'=>'index', 'uses'=> 'CourseController@index']);
       Route::match(['get', 'post'], 'getList', ['as' => 'getList', 'uses' => 'CourseController@getList']);
    });

});

Route::get('/home', 'HomeController@index')->name('home');