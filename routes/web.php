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
    return view('welcome');
});

//用户注册
Route::post('/register','UserController@register');

//用户登录
Route::post('/login','UserController@login');

//用户注销登录
Route::get('/logout','UserController@logout');

/**
 * 合作及技术咨询
 * 需要用户先进行登录
 */
Route::post('/coop','UserController@cooperate');
Route::post('/skill','UserController@skill');
Route::post('/connect','UserController@connect');

/**
 * 用户个人信息
 * 需要先登录
 */
Route::get('/me','UserController@show');

//新品推荐
Route::get('/newgood','InfoController@newGood');
//公告
Route::get('/notice','InfoController@notice');
//最新科技
Route::get('/tech','InfoController@tech');
//网络研讨会
Route::get('/web', 'InfoController@web');
//食药咨询
Route::get('/food','InfoController@food');
//最新应用
Route::get('/newapp','InfoController@newApp');

//按名称搜索
Route::get('/searchByName/{name}','SearchController@searchByName');
//普通搜索
Route::get('/search','SearchController@search');

//商品详情
Route::get('/detail','SearchController@detail');
//返回首页商品分类
Route::get('/type','SearchController@type');

//Route::get('/a','SearchController@a');