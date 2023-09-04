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

$router->group(['prefix'=>'api/sewa/sppks'], function() use($router){

    $router->get('/', 'SPPKController@index');
    $router->post('/', 'SPPKController@create');
    $router->get('/antriansppks', 'SPPKController@antrian_sppk');
    $router->get('/{id_sppk}', 'SPPKController@show');
    $router->put('/{id_sppk}', 'SPPKController@update');
    $router->delete('/{id_sppk}', 'SPPKController@destroy');
    $router->put('/{id_sppk}/approve', 'SPPKController@approved');
    $router->put('/{id_sppk}/reject', 'SPPKController@rejected');
    
 
 });

 $router->group(['prefix'=>'api/sewa/kontraksewas'], function() use($router){

    $router->get('/', 'KontrakSewaController@index');
    $router->post('/', 'KontrakSewaController@create');
    $router->get('/proseskontraksewa', 'KontrakSewaController@proses_kontraksewa');
    $router->get('/sewaberjalan', 'KontrakSewaController@sewa_berjalan');
    $router->get('/antriankontraksewas', 'KontrakSewaController@antrian_kontraksewa');
    $router->get('/{id_kontraksewa}', 'KontrakSewaController@show');
    $router->put('/{id_kontraksewa}/approve', 'KontrakSewaController@approved');
    $router->put('/{id_kontraksewa}/reject', 'KontrakSewaController@rejected');
    
 
 });

$router->group(['prefix'=>'api/sewa/stwahanatocabangs'], function() use($router){

    $router->get('/', 'STWahanatoCabangController@index');
    $router->post('/', 'STWahanatoCabangController@create');
    $router->get('/prosesserahterima', 'STWahanatoCabangController@proses_serahterima');
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

$router->group(['prefix'=>'api/sewa/penggantians'], function() use($router){

    $router->get('/', 'PenggantianController@index');
    $router->post('/', 'PenggantianController@create');
    $router->get('/{id_penggantian}', 'PenggantianController@show');
    $router->put('/{id_penggantian}', 'PenggantianController@update');
    $router->put('/{id_penggantian}/approve', 'PenggantianController@approved');
    $router->put('/{id_penggantian}/reject', 'PenggantianController@rejected');
});

$router->group(['prefix'=>'api/sewa/penyewas'], function() use($router){
    $router->get('/', 'PenyewasController@index');
    $router->get('/{id_penyewa}', 'PenyewaController@show');
});
$router->group(['prefix'=>'api/sewa/pemakais'], function() use($router){
    $router->get('/', 'PemakaiController@index');
    $router->get('/{id_pemakai}', 'PemakaiController@show');
});