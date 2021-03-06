<?php

use Illuminate\Http\Request;
use App\SecondType;
use App\ThirdType;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/thirdtype',function(){
    $types = ThirdType::where('id','>',0)->get(['id','name']);
    foreach ($types as $k=>$v){
       $data[] = array(
           'id' => $v['id'],
           'text' => $v['name']
       );
    }
    return($data);
});

Route::get('/secondtype',function(){
    $types = SecondType::where('id','>',0)->get(['id','name']);
    foreach ($types as $k=>$v){
       $data[] = array(
           'id' => $v['id'],
           'text' => $v['name']
       );
    }
    return($data);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
],function ($router){
    Route::post('login','AuthController@login');
    Route::post('logout','AuthController@logout');
    Route::post('refresh','AuthController@refresh');
    Route::post('me','AuthController@me');
});