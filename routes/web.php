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

$router->get('/api/usuarios', 'UsuariosController@getAll');
$router->get('/api/usuarios/busca/{str}', 'UsuariosController@busca');

$router->group(['prefix' => '/api/usuario'], function() use ($router){
    $router->get('/{id}', 'UsuariosController@getId');
    $router->post('/', 'UsuariosController@store');
    $router->put('/{id}', 'UsuariosController@update');
    $router->delete('/{id}', 'UsuariosController@destroy');
});

