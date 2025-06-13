<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/login1', 'AuthController@login');
$router->post('/register1', 'AuthController@register');

$router->options('/{any:.*}', function () {
    return response('OK', 200);
});

$router->post('/register', 'RegisterController@register');
$router->post('/login', 'LoginController@login');

// Routes ที่ต้อง login ก่อนถึงใช้ได้
$router->post('/salary', 'SalaryController@createSalary'); // วางไว้ก่อน group

$router->post('/job', 'JobController@createJob');

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/show', 'LoginController@show');
    $router->put('/edit', 'LoginController@edit');
    $router->put('/users/{id}', 'LoginController@edit');
    $router->delete('/users/{id}', 'LoginController@delete');
    $router->post('/logout', 'LoginController@logout');
    $router->get('/admin/data', 'DataController@index');

    $router->get('/salary', 'SalaryController@showSalary');

    $router->get('/job', 'JobController@showJobs');
});
