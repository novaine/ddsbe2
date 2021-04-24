<?php
/** @var \Laravel\Lumen\Routing\Router $router */
/*
|---------------------------------------------------------------------
-----
| Application Routes
|---------------------------------------------------------------------
-----
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// unsecure routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users',['uses' => 'UserController@getUsers']);
});

$router->get('/users','UserController@index'); //get all user records
$router->post('/users', 'UserController@add'); //create new user record
$router->get('/users/{id}', 'UserController@show'); //get all users by id
$router->put('/users/{id}', 'UserController@update'); //update all fields in a user record
$router->patch('/users/{id}', 'UserController@update'); //update specific fields in user record
$router->delete('/users/{id}', 'Usercontroller@delete'); //delete user record by selecting an id