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
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('/index', ['uses' => 'HomeController@index', 'as' => 'home']);
});

Route::group(['middleware' => 'web', 'prefix' => 'erro'], function () {
    Route::get('/403', ['uses' => 'ErrorController@erro403', 'as' => '403']);
});

/* Rotas organizadas para niveis */
Route::group(['prefix' => 'nivel', 'where' => ['id' => '[0-9]+']], function () {
    Route::post('{id}/lixeira', ['uses' => 'NiveisController@lixeira', 'as' => 'nivel.lixeira']);
    Route::post('/inserir', ['uses' => 'NiveisController@store', 'as' => 'nivel.store']);
});

Route::group(['middleware' => 'web', 'prefix' => 'cms'], function () {
    Route::auth();

    Route::get('register', function () {
        return view('welcome');
    });

    Route::get('', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'cms.dashboard']);
    Route::get('/home', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'cms.dashboard']);
    Route::get('/index', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'cms.dashboard']);
    Route::get('/dashboard', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'cms.dashboard']);

    /* Rotas organizadas para usuários */
    Route::group(['prefix' => 'usuarios', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSUserController@index', 'as' => 'cms.usuarios.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSUserController@index', 'as' => 'cms.usuarios.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSUserController@create', 'as' => 'cms.usuarios.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSUserController@store', 'as' => 'cms.usuarios.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSUserController@edit', 'as' => 'cms.usuarios.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSUserController@update', 'as' => 'cms.usuarios.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSUserController@lixeira', 'as' => 'cms.usuarios.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSUserController@ativar', 'as' => 'cms.usuarios.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSUserController@delete', 'as' => 'cms.usuarios.delete']);
    });

    /* Rotas organizadas para páginas */
    Route::group(['prefix' => 'paginas', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSPaginasController@index', 'as' => 'cms.paginas.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSPaginasController@index', 'as' => 'cms.paginas.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSPaginasController@create', 'as' => 'cms.paginas.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSPaginasController@store', 'as' => 'cms.paginas.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSPaginasController@edit', 'as' => 'cms.paginas.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSPaginasController@update', 'as' => 'cms.paginas.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSPaginasController@lixeira', 'as' => 'cms.paginas.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSPaginasController@ativar', 'as' => 'cms.paginas.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSPaginasController@delete', 'as' => 'cms.paginas.delete']);
    });

    /* Rotas organizadas para configurações */
    Route::group(['prefix' => 'configs', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSConfigsController@index', 'as' => 'cms.configs.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSConfigsController@index', 'as' => 'cms.configs.index']);
        Route::get('/editar', ['uses' => 'NanoCMS\CMSConfigsController@edit', 'as' => 'cms.configs.edit']);
        Route::post('/editar', ['uses' => 'NanoCMS\CMSConfigsController@update', 'as' => 'cms.configs.update']);
    });
});
