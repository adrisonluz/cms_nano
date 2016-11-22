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

    Route::get('', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'nano.cms.dashboard']);
    Route::get('/home', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'nano.cms.dashboard']);
    Route::get('/index', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'nano.cms.dashboard']);
    Route::get('/dashboard', ['uses' => 'NanoCMS\CMSHomeController@index', 'as' => 'nano.cms.dashboard']);

    /* Rotas organizadas para usuários */
    Route::group(['prefix' => 'usuarios', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSUserController@index', 'as' => 'nano.cms.usuarios.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSUserController@index', 'as' => 'nano.cms.usuarios.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSUserController@create', 'as' => 'nano.cms.usuarios.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSUserController@store', 'as' => 'nano.cms.usuarios.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSUserController@edit', 'as' => 'nano.cms.usuarios.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSUserController@update', 'as' => 'nano.cms.usuarios.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSUserController@lixeira', 'as' => 'nano.cms.usuarios.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSUserController@ativar', 'as' => 'nano.cms.usuarios.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSUserController@delete', 'as' => 'nano.cms.usuarios.delete']);
    });

    /* Rotas organizadas para páginas */
    Route::group(['prefix' => 'paginas', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSPaginasController@index', 'as' => 'nano.cms.paginas.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSPaginasController@index', 'as' => 'nano.cms.paginas.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSPaginasController@create', 'as' => 'nano.cms.paginas.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSPaginasController@store', 'as' => 'nano.cms.paginas.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSPaginasController@edit', 'as' => 'nano.cms.paginas.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSPaginasController@update', 'as' => 'nano.cms.paginas.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSPaginasController@lixeira', 'as' => 'nano.cms.paginas.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSPaginasController@ativar', 'as' => 'nano.cms.paginas.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSPaginasController@delete', 'as' => 'nano.cms.paginas.delete']);
    });

    /* Rotas organizadas para banners */
    Route::group(['prefix' => 'banners', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSBannersController@index', 'as' => 'nano.cms.banners.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSBannersController@index', 'as' => 'nano.cms.banners.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSBannersController@create', 'as' => 'nano.cms.banners.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSBannersController@store', 'as' => 'nano.cms.banners.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSBannersController@edit', 'as' => 'nano.cms.banners.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSBannersController@update', 'as' => 'nano.cms.banners.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSBannersController@lixeira', 'as' => 'nano.cms.banners.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSBannersController@ativar', 'as' => 'nano.cms.banners.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSBannersController@delete', 'as' => 'nano.cms.banners.delete']);
    });

    /* Rotas organizadas para menus */
    Route::group(['prefix' => 'menus', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSMenusController@index', 'as' => 'nano.cms.menus.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSMenusController@index', 'as' => 'nano.cms.menus.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSMenusController@create', 'as' => 'nano.cms.menus.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSMenusController@store', 'as' => 'nano.cms.menus.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSMenusController@edit', 'as' => 'nano.cms.menus.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSMenusController@update', 'as' => 'nano.cms.menus.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSMenusController@lixeira', 'as' => 'nano.cms.menus.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSMenusController@ativar', 'as' => 'nano.cms.menus.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSMenusController@delete', 'as' => 'nano.cms.menus.delete']);
    });

    /* Rotas organizadas para itens de menus */
    Route::group(['prefix' => 'menus-itens', 'where' => ['id' => '[0-9]+']], function () {
        Route::post('inserir', ['uses' => 'NanoCMS\CMSMenusItensController@store', 'as' => 'nano.cms.menus-itens.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSMenusItensController@edit', 'as' => 'nano.cms.menus-itens.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSMenusItensController@update', 'as' => 'nano.cms.menus-itens.update']);
        Route::post('{id}/lixeira', ['uses' => 'NanoCMS\CMSMenusItensController@lixeira', 'as' => 'nano.cms.menus-itens.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSMenusItensController@ativar', 'as' => 'nano.cms.menus-itens.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSMenusItensController@delete', 'as' => 'nano.cms.menus-itens.delete']);
    });

    /* Rotas organizadas para forms */
    Route::group(['prefix' => 'forms', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSFormsController@index', 'as' => 'nano.cms.forms.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSFormsController@index', 'as' => 'nano.cms.forms.index']);
        Route::get('inserir', ['uses' => 'NanoCMS\CMSFormsController@create', 'as' => 'nano.cms.forms.create']);
        Route::post('inserir', ['uses' => 'NanoCMS\CMSFormsController@store', 'as' => 'nano.cms.forms.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSFormsController@edit', 'as' => 'nano.cms.forms.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSFormsController@update', 'as' => 'nano.cms.forms.update']);
        Route::get('{id}/lixeira', ['uses' => 'NanoCMS\CMSFormsController@lixeira', 'as' => 'nano.cms.forms.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSFormsController@ativar', 'as' => 'nano.cms.forms.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSFormsController@delete', 'as' => 'nano.cms.forms.delete']);
    });

    /* Rotas organizadas para itens de menus */
    Route::group(['prefix' => 'fields', 'where' => ['id' => '[0-9]+']], function () {
        Route::post('inserir', ['uses' => 'NanoCMS\CMSFieldsController@store', 'as' => 'nano.cms.fields.store']);
        Route::get('{id}/editar', ['uses' => 'NanoCMS\CMSFieldsController@edit', 'as' => 'nano.cms.fields.edit']);
        Route::post('{id}/editar', ['uses' => 'NanoCMS\CMSFieldsController@getField', 'as' => 'nano.cms.fields.update']);
        Route::post('dados', ['uses' => 'NanoCMS\CMSFieldsController@dados', 'as' => 'nano.cms.fields.dados']);
        Route::post('{id}/lixeira', ['uses' => 'NanoCMS\CMSFieldsController@lixeira', 'as' => 'nano.cms.fields.lixeira']);
        Route::get('{id}/ativar', ['uses' => 'NanoCMS\CMSFieldsController@ativar', 'as' => 'nano.cms.fields.ativar']);
        Route::get('{id}/deletar', ['uses' => 'NanoCMS\CMSFieldsController@delete', 'as' => 'nano.cms.fields.delete']);
    });

    /* Rotas organizadas para configurações */
    Route::group(['prefix' => 'configs', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => 'NanoCMS\CMSConfigsController@index', 'as' => 'nano.cms.configs.index']);
        Route::get('index', ['uses' => 'NanoCMS\CMSConfigsController@index', 'as' => 'nano.cms.configs.index']);
        Route::get('/editar', ['uses' => 'NanoCMS\CMSConfigsController@edit', 'as' => 'nano.cms.configs.edit']);
        Route::post('/editar', ['uses' => 'NanoCMS\CMSConfigsController@update', 'as' => 'nano.cms.configs.update']);
    });
});
