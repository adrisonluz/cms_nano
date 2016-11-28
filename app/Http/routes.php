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


/*** Nano Soluctions ***/
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

    Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSHomeController@index', 'as' => 'nano.cms.dashboard']);
    Route::get('/home', ['uses' => '\Nano\NanoCMS\Controllers\CMSHomeController@index', 'as' => 'nano.cms.dashboard']);
    Route::get('/index', ['uses' => '\Nano\NanoCMS\Controllers\CMSHomeController@index', 'as' => 'nano.cms.dashboard']);
    Route::get('/dashboard', ['uses' => '\Nano\NanoCMS\Controllers\CMSHomeController@index', 'as' => 'nano.cms.dashboard']);

    /* Rotas organizadas para usuários */
    Route::group(['prefix' => 'usuarios', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@index', 'as' => 'nano.cms.usuarios.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@index', 'as' => 'nano.cms.usuarios.index']);
        Route::get('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@create', 'as' => 'nano.cms.usuarios.create']);
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@store', 'as' => 'nano.cms.usuarios.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@edit', 'as' => 'nano.cms.usuarios.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@update', 'as' => 'nano.cms.usuarios.update']);
        Route::get('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@lixeira', 'as' => 'nano.cms.usuarios.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@ativar', 'as' => 'nano.cms.usuarios.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSUserController@delete', 'as' => 'nano.cms.usuarios.delete']);
    });

    /* Rotas organizadas para páginas */
    Route::group(['prefix' => 'paginas', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@index', 'as' => 'nano.cms.paginas.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@index', 'as' => 'nano.cms.paginas.index']);
        Route::get('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@create', 'as' => 'nano.cms.paginas.create']);
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@store', 'as' => 'nano.cms.paginas.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@edit', 'as' => 'nano.cms.paginas.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@update', 'as' => 'nano.cms.paginas.update']);
        Route::get('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@lixeira', 'as' => 'nano.cms.paginas.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@ativar', 'as' => 'nano.cms.paginas.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSPaginasController@delete', 'as' => 'nano.cms.paginas.delete']);
    });

    /* Rotas organizadas para banners */
    Route::group(['prefix' => 'banners', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@index', 'as' => 'nano.cms.banners.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@index', 'as' => 'nano.cms.banners.index']);
        Route::get('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@create', 'as' => 'nano.cms.banners.create']);
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@store', 'as' => 'nano.cms.banners.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@edit', 'as' => 'nano.cms.banners.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@update', 'as' => 'nano.cms.banners.update']);
        Route::get('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@lixeira', 'as' => 'nano.cms.banners.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@ativar', 'as' => 'nano.cms.banners.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSBannersController@delete', 'as' => 'nano.cms.banners.delete']);
    });

    /* Rotas organizadas para menus */
    Route::group(['prefix' => 'menus', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@index', 'as' => 'nano.cms.menus.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@index', 'as' => 'nano.cms.menus.index']);
        Route::get('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@create', 'as' => 'nano.cms.menus.create']);
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@store', 'as' => 'nano.cms.menus.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@edit', 'as' => 'nano.cms.menus.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@update', 'as' => 'nano.cms.menus.update']);
        Route::get('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@lixeira', 'as' => 'nano.cms.menus.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@ativar', 'as' => 'nano.cms.menus.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusController@delete', 'as' => 'nano.cms.menus.delete']);
    });

    /* Rotas organizadas para itens de menus */
    Route::group(['prefix' => 'menus-itens', 'where' => ['id' => '[0-9]+']], function () {
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusItensController@store', 'as' => 'nano.cms.menus-itens.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusItensController@edit', 'as' => 'nano.cms.menus-itens.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusItensController@update', 'as' => 'nano.cms.menus-itens.update']);
        Route::post('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusItensController@lixeira', 'as' => 'nano.cms.menus-itens.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusItensController@ativar', 'as' => 'nano.cms.menus-itens.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSMenusItensController@delete', 'as' => 'nano.cms.menus-itens.delete']);
    });

    /* Rotas organizadas para forms */
    Route::group(['prefix' => 'forms', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@index', 'as' => 'nano.cms.forms.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@index', 'as' => 'nano.cms.forms.index']);
        Route::get('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@create', 'as' => 'nano.cms.forms.create']);
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@store', 'as' => 'nano.cms.forms.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@edit', 'as' => 'nano.cms.forms.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@update', 'as' => 'nano.cms.forms.update']);
        Route::get('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@lixeira', 'as' => 'nano.cms.forms.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@ativar', 'as' => 'nano.cms.forms.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSFormsController@delete', 'as' => 'nano.cms.forms.delete']);
    });

    /* Rotas organizadas para itens de menus */
    Route::group(['prefix' => 'fields', 'where' => ['id' => '[0-9]+']], function () {
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSFieldsController@store', 'as' => 'nano.cms.fields.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSFieldsController@edit', 'as' => 'nano.cms.fields.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSFieldsController@update', 'as' => 'nano.cms.fields.update']);
        Route::post('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSFieldsController@lixeira', 'as' => 'nano.cms.fields.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSFieldsController@ativar', 'as' => 'nano.cms.fields.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSFieldsController@delete', 'as' => 'nano.cms.fields.delete']);
    });

    /* Rotas organizadas para posts */
    Route::group(['prefix' => 'posts', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@index', 'as' => 'nano.cms.posts.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@index', 'as' => 'nano.cms.posts.index']);
        Route::get('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@create', 'as' => 'nano.cms.posts.create']);
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@store', 'as' => 'nano.cms.posts.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@edit', 'as' => 'nano.cms.posts.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@update', 'as' => 'nano.cms.posts.update']);
        Route::get('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@lixeira', 'as' => 'nano.cms.posts.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@ativar', 'as' => 'nano.cms.posts.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSPostsController@delete', 'as' => 'nano.cms.posts.delete']);
    });

    /* Rotas organizadas para categorias */
    Route::group(['prefix' => 'categorias', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@index', 'as' => 'nano.cms.categorias.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@index', 'as' => 'nano.cms.categorias.index']);
        Route::get('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@create', 'as' => 'nano.cms.categorias.create']);
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@store', 'as' => 'nano.cms.categorias.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@edit', 'as' => 'nano.cms.categorias.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@update', 'as' => 'nano.cms.categorias.update']);
        Route::get('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@lixeira', 'as' => 'nano.cms.categorias.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@ativar', 'as' => 'nano.cms.categorias.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSCategoriasController@delete', 'as' => 'nano.cms.categorias.delete']);
    });

    /* Rotas organizadas para agendas */
    Route::group(['prefix' => 'agendas', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@index', 'as' => 'nano.cms.agendas.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@index', 'as' => 'nano.cms.agendas.index']);
        Route::get('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@create', 'as' => 'nano.cms.agendas.create']);
        Route::post('inserir', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@store', 'as' => 'nano.cms.agendas.store']);
        Route::get('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@edit', 'as' => 'nano.cms.agendas.edit']);
        Route::post('{id}/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@update', 'as' => 'nano.cms.agendas.update']);
        Route::get('{id}/lixeira', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@lixeira', 'as' => 'nano.cms.agendas.lixeira']);
        Route::get('{id}/ativar', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@ativar', 'as' => 'nano.cms.agendas.ativar']);
        Route::get('{id}/deletar', ['uses' => '\Nano\NanoCMS\Controllers\CMSAgendasController@delete', 'as' => 'nano.cms.agendas.delete']);
    });

    /* Rotas organizadas para configurações */
    Route::group(['prefix' => 'configs', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => '\Nano\NanoCMS\Controllers\CMSConfigsController@index', 'as' => 'nano.cms.configs.index']);
        Route::get('index', ['uses' => '\Nano\NanoCMS\Controllers\CMSConfigsController@index', 'as' => 'nano.cms.configs.index']);
        Route::get('/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSConfigsController@edit', 'as' => 'nano.cms.configs.edit']);
        Route::post('/editar', ['uses' => '\Nano\NanoCMS\Controllers\CMSConfigsController@update', 'as' => 'nano.cms.configs.update']);
    });
});
