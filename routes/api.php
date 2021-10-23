<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

$router->post('/user/register', 'Auth\RegisterController@register');
$router->post('/user/sign-in', 'Auth\LoginController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/user/companies', 'CompanyController@index');
    $router->post('/user/companies', 'CompanyController@store');
});
