<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Route;

Route::post('competition/sign-up', 'Competition@register');

Route::get('competition/sign-up', function () {
    return view('index');
});


Route::get('competition/export', 'Competition@export');

Route::group(['prefix' => 'api', 'namespace' => 'customer'], function () {

    /*Route::group(['prefix' => 'feedback', 'middleware' => 'Auth'], function () {
        Route::get('feedback/get', 'Feedback@scan');
        Route::post('feedback/submit', 'Feedback@handIn');
    });*/

    Route::group(['prefix' => 'activity'], function () {
        Route::get('active', 'Activity@tmpDataActive');
        Route::get('collect', 'Activity@tmpCollection');
    });

    /*Route::group(['prefix' => 'user'], function () {
        Route::get('getUserInfo', [
            'middleware' => 'Auth',
            'uses' => 'UserInfo@common'
        ]);
        Route::get('avantar', [
            'middleware' => 'Auth',
            'uses' => 'UserInfo@getAvantar'
        ]);
        Route::get('authorize', 'Authorize@login');
        Route::get('authorizeSuccess', 'Authorize@authorizeSuccess');
    });
    Route::get('user/getUserInfo', 'UserInfo@common');

    Route::get('user/avantar', 'UserInfo@getAvantar');

    Route::get('user/authorize', 'Authorize@login');

    Route::get('user/authorizeSuccess', 'Authorize@authorizeSuccess');

    Route::get('test', 'Authorize@test');

    Route::get('response/verify-identity-fail', 'ResponseRedirect@verifyIdentityFail');

    Route::get('response/lack-authority', 'ResponseRedirect@lackAuthority');

    Route::get('response/fail', 'ResponseRedirect@fail');*/

    Route::group(['prefix' => 'article'], function () {
        Route::post('uploadHtml', [
            'middleware' => ['Admin', 'uploadHtml'],
            'uses' => 'Article@uploadHtml'
        ]);
        Route::post('uploadSurfacePlot', [
            'middleware' => ['Admin', 'uploadSurfacePlot'],
            'uses' => 'Article@uploadSurfacePlot'
        ]);
        Route::post('updateHtml', [
            'middleware' => ['Admin', 'updateHtml'],
            'uses' => 'Article@uploadSurfacePlot'
        ]);
        Route::get('getHtml', 'Article@getHtml');
        Route::get('preview', 'Article@preview');
        Route::get('comment', 'Article@comment');
        Route::post('comment/submit', [
            'middleware' => 'Auth',
            'uses' => 'Article@submitComment'
        ]);
        Route::post('comment/thumbUp', [
            'middleware' => 'Auth',
            'uses' => 'Article@thumbUpComment'
        ]);
    });
    /**
     * 关于无协部分的请求路由
     * 请求示例：webroot/api/about
     * $page取值：association/director/department/technical
     */
    Route::group(['prefix' => 'about'], function () {
        Route::get('/association', 'About@association');
        Route::get('/director', 'About@director');
        Route::get('/department', 'About@department');
        Route::get('/technical', 'About@technical');
    });
    /**
     * 首页请求路由
     * 请求示例：webroot/api/caro
     */
    Route::group(['prefix' => 'home'], function(){
        Route::get('caro', 'Home@tmpCaro');
        Route::get('dynamic', 'Home@tmpDynamic');
        //Route::get('tecshare', 'home@tecShare');//未建表，未完成模块，暂留
    });

});

Route::group(['namespace' => 'common'], function () {
    Route::post('common/upload', 'UploadFile@uploadImg');
});

//！！！等待加入中间件！！！
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
    Route::get('/login', function () {
        return view('admin/index');
    });

    Route::group(['prefix' => 'xhgk'], function () {
        Route::get('{page}', 'Xhgk@show');
        Route::post('{page}/up', 'Xhgk@update');
        Route::post('{page}/del', 'Xhgk@del');
    });

    Route::group(['prefix' => 'sybj'], function () {
        Route::get('{page}', 'Sybj@show');
        Route::post('{page}/up', 'Sybj@update');
    });

    Route::group(['prefix' => 'xhdt'], function () {
        Route::get('actlist', 'Xhdt@actList');
        Route::get('changeActStatus', 'Xhdt@changeActStatus');
        Route::get('activity/{id}', 'Xhdt@actDetail');
        Route::post('activity/up', 'Xhdt@actUpdate');
    });
    //Route::any('/ueditor','UeditorCtl@index');
});


Route::get('/', function () {
    return view('admin/xhdt/allJqhd');
});

