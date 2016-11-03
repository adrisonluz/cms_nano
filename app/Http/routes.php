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

Route::group(['middleware' => 'web', 'prefix' => 'cms'], function () {

    /* Rotas */
    Route::auth();

// vamos redirecionara a rota criada (register) para a view de boas vindas
    Route::get('register', function () {
        return view('welcome');
    });

    Route::get('', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'cms.dashboard']);
    Route::get('/home', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'cms.dashboard']);
    Route::get('/index', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'cms.dashboard']);
    Route::get('/dashboard', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'cms.dashboard']);

    /* Rotas organizadas para usuários */
    Route::group(['prefix' => 'usuarios', 'where' => ['id' => '[0-9]+']], function () {

        Route::get('', ['uses' => 'NanoCMS\CMSUserController@index', 'as' => 'cms.usuario.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSUserController@index', 'as' => 'cms.usuario.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSUserController@create', 'as' => 'cms.usuario.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSUserController@store', 'as' => 'cms.usuario.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSUserController@edit', 'as' => 'cms.usuario.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSUserController@update', 'as' => 'cms.usuario.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSUserController@lixeira', 'as' => 'cms.usuario.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSUserController@ativar', 'as' => 'cms.usuario.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSUserController@delete', 'as' => 'cms.usuario.delete']);
    });

    /* Rotas organizadas para páginas */
    Route::group(['prefix' => 'paginas', 'where' => ['id' => '[0-9]+']], function () {

        Route::get('', ['uses' => 'NanoCMS\CMSPaginasController@index', 'as' => 'cms.pagina.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSPaginasController@index', 'as' => 'cms.pagina.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSPaginasController@create', 'as' => 'cms.pagina.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSPaginasController@store', 'as' => 'cms.pagina.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSPaginasController@edit', 'as' => 'cms.pagina.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSPaginasController@update', 'as' => 'cms.pagina.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSPaginasController@lixeira', 'as' => 'cms.pagina.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSPaginasController@ativar', 'as' => 'cms.pagina.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSPaginasController@delete', 'as' => 'cms.pagina.delete']);
    });
});
