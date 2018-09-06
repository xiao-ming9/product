<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users',UserController::class);
    $router->resource('notice',NoticeController::class);
    $router->resource('tech',TechController::class);
    $router->resource('web',WebController::class);
    $router->resource('food',FoodController::class);
    $router->resource('newapp',newAppController::class);
    $router->resource('type',FirstTypeController::class);
    $router->resource('secondtype',SecondTypeController::class);
    $router->resource('thirdtype',ThirdTypeController::class);
    $router->resource('good',GoodController::class);
    $router->resource('table',TableController::class);
    $router->resource('apply',ApplyController::class);
    $router->resource('connect',ConnectController::class);
    $router->resource('skill',SkillController::class);
});
