<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => ['web']], function () {

    Route::get('/', [ 'uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('/home', [ 'uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('/index', [ 'uses' => 'HomeController@index', 'as' => 'home']);
});

Route::group(['middleware' => 'web', 'prefix' => 'admin'], function () {

    /* Rotas */
    Route::auth();

    // vamos redirecionara a rota criada (register) para a view de boas vindas
    Route::get('register', function () {
        return view('welcome');
    });

    Route::get('', [ 'uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'admin.dashboard']);
    Route::get('/home', [ 'uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'admin.dashboard']);
    Route::get('/index', [ 'uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'admin.dashboard']);
    Route::get('/dashboard', [ 'uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'admin.dashboard']);

    /* Rotas organizadas para usuários */
    Route::group(['prefix' => 'usuarios', 'where' => ['id' => '[0-9]+']], function () {

        Route::get('', [ 'uses' => 'NanoCMS\CMSUserController@index', 'as' => 'admin.usuario.index']);
        Route::get('index', [ 'uses' => 'NanoCMS\CMSUserController@index', 'as' => 'admin.usuarios.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSUserController@create', 'as' => 'admin.usuario.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSUserController@store', 'as' => 'admin.usuario.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSUserController@edit', 'as' => 'admin.usuario.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSUserController@update', 'as' => 'admin.usuario.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSUserController@lixeira', 'as' => 'admin.usuario.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSUserController@ativar', 'as' => 'admin.usuario.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSUserController@delete', 'as' => 'admin.usuario.delete']);
    });
});
