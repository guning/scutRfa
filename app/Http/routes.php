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

Route::get('feedback/get', 'Feedback@scan');

Route::post('feedback/submit', 'Feedback@handIn');

Route::get('activity/preview', 'Activity@preview');

Route::get('user/getUserInfo', 'UserInfo@common');

Route::get('user/avantar', 'UserInfo@getAvantar');

Route::get('user/authorize', 'Authorize@login');

Route::get('user/authorizeSuccess', 'Authorize@authorizeSuccess');

Route::get('test', 'Authorize@test');

Route::get('response/verify-identity-fail', 'ResponseRedirect@verifyIdentityFail');


Route::get('response/lack-authority', 'ResponseRedirect@lackAuthority');

Route::get('response/fail', 'ResponseRedirect@fail');

Route::group(['prefix' => 'article'],function(){
    Route::post('uploadHtml',[
        'middleware'    =>'uploadHtml',
        'uses'          =>'Article@uploadHtml'
    ]);
    Route::post('uploadSurfacePlot',[
        'middleware'    =>'uploadSurfacePlot',
        'uses'          =>'Article@uploadSurfacePlot'
    ]);
    Route::get('getHtml','Article@getHtml');
});

Route::any('',function(){
    return view('admin/test');
});