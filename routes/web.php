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
    $router->put('/sppks/{id_sppk}/approve', 'SPPKController@approved');
    $router->put('/sppks/{id_sppk}/reject', 'SPPKController@rejected');
 
 });

 $router->group(['prefix'=>'api/sewa/kontraksewas'], function() use($router){

    $router->get('/', 'KontrakSewaController@index');
    $router->post('/', 'KontrakSewaController@create');
    $router->get('/{id_kontraksewa}', 'KontrakSewaController@show');
    $router->put('/{id_kontraksewa}/approve', 'KontrakSewaController@approved');
    $router->put('/{id_kontraksewa}/reject', 'KontrakSewaController@rejected');
 
 });

$router->group(['prefix'=>'api/sewa/stwahanatocabangs'], function() use($router){

    $router->get('/', 'STWahanatoCabangController@index');
    $router->post('/', 'STWahanatoCabangController@create');
    $router->get('/{id_stwahanatocabang}', 'STWahanatoCabangController@show');
    $router->put('/{id_stwahanatocabang}', 'STWahanatoCabangController@update');
    $router->put('/{id_stwahanatocabang}/approve', 'STWahanatoCabangController@approved');
    $router->put('/{id_stwahanatocabang}/reject', 'STWahanatoCabangController@rejected');
});

$router->group(['prefix'=>'api/sewa/pengembalians'], function() use($router){

    $router->get('/', 'PengembalianController@index');
    $router->post('/', 'PengembalianController@create');
    $router->get('/{id_pengembalian}', 'PengembalianController@show');
    $router->put('/{id_pengembalian}', 'PengembalianController@update');
    $router->put('/{id_pengembalian}/approve', 'PengembalianController@approved');
    $router->put('/{id_pengembalian}/reject', 'PengembalianController@rejected');
});

$router->group(['prefix'=>'api/sewa/penggantianpermanens'], function() use($router){

    $router->get('/', 'PenggantianPermanenController@index');
    $router->post('/', 'PenggantianPermanenController@create');
    $router->get('/{id_penggantianpermanen}', 'PenggantianPermanenController@show');
    $router->put('/{id_penggantianpermanen}', 'PenggantianPermanenController@update');
    $router->put('/{id_penggantianpermanen}/approve', 'PenggantianPermanenController@approved');
    $router->put('/{id_penggantianpermanen}/reject', 'PenggantianPermanenController@rejected');
});