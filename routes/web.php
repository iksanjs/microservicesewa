<?php

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

$router->group(['prefix'=>'api/sewa'], function() use($router){

    $router->get('/sppks', 'SPPKController@index');
    $router->post('/sppks', 'SPPKController@create');
    $router->get('/sppks/{id_sppk}', 'SPPKController@show');
    $router->put('/sppks/{id_sppk}', 'SPPKController@update');
    $router->delete('/sppks/{id_sppk}', 'SPPKController@destroy');
 
 });