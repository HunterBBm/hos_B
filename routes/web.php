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
$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/me', 'AuthController@me');
    $router->post('/test', 'TestController@handle');
    // Show data route (GET) for LoginController
    $router->get('/show', 'LoginController@show');
    // Edit data route (PUT) for LoginController
    $router->put('/edit', 'LoginController@edit');
    $router->put('/users/{id}', 'LoginController@edit');
    // Delete data route (DELETE) for LoginController
    $router->delete('/users/{id}', 'LoginController@delete');
});
