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

Route::get('competition/sign-up', function() {
    return view('index');
});

Route::get('competition/export', 'Competition@export');

Route::group(['prefix'=>'feedback', 'middleware'=>'Auth'], function(){
    Route::get('feedback/get', 'Feedback@scan');
    Route::post('feedback/submit', 'Feedback@handIn');
});
/*
*/
Route::get('activity/preview', 'Activity@preview');

Route::group(['prefix'=>'user'],function(){
    Route::get('getUserInfo',[
        'middleware'    =>'Auth',
        'uses'          =>'UserInfo@common'
    ]);
    Route::get('avantar',[
        'middleware'    =>'Auth',
        'uses'          =>'UserInfo@getAvantar'
    ]);
    Route::get('authorize', 'Authorize@login');
    Route::get('authorizeSuccess', 'Authorize@authorizeSuccess');
});
/*
Route::get('user/getUserInfo', 'UserInfo@common');

Route::get('user/avantar', 'UserInfo@getAvantar');

Route::get('user/authorize', 'Authorize@login');

Route::get('user/authorizeSuccess', 'Authorize@authorizeSuccess');
*/
Route::get('test', 'Authorize@test');

Route::get('response/verify-identity-fail', 'ResponseRedirect@verifyIdentityFail');

Route::get('response/lack-authority', 'ResponseRedirect@lackAuthority');

Route::get('response/fail', 'ResponseRedirect@fail');

Route::group(['prefix' => 'article'],function(){
    Route::post('uploadHtml',[
        'middleware'    =>['Admin','uploadHtml'],
        'uses'          =>'Article@uploadHtml'
    ]);
    Route::post('uploadSurfacePlot',[
        'middleware'    =>['Admin','uploadSurfacePlot'],
        'uses'          =>'Article@uploadSurfacePlot'
    ]);
    Route::post('uploadPoster',[
        'middleware'    =>['Admin','uploadPoster'],
        'uses'          =>'Article@uploadPoster'
    ]);
    Route::post('updateHtml',[
        'middleware'    =>['Admin','updateHtml'],
        'uses'          =>'Article@uploadSurfacePlot'
    ]);
    Route::get('getHtml','Article@getHtml');
    Route::get('preview','Article@preview');
    Route::get('comment','Article@comment');
    Route::post('comment/submit',[
        'middleware'    =>'Auth',
        'uses'          =>'Article@submitComment'
    ]);
    Route::post('comment/thumbUp',[
        'middleware'    =>'Auth',
        'uses'          =>'Article@thumbUpComment'
    ]);
});

Route::any('',function(){
    return view('admin/test');
});