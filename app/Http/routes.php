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
 
	Route::get('/', [ 'uses' => 'HomeController@index', 'as' => 'dashboard']);
 
});
 
Route::group(['middleware' => 'web', 'prefix' => 'usuarios'], function(){
	Route::get('index', ['uses' => 'UsuarioController@index', 'as' => 'usuario.index']);
});

Route::group(['middleware' => 'web', 'prefix' => 'admin' ], function () {

    /* Rotas */
    Route::auth();
 
    // vamos redirecionara a rota criada (register) para a view de boas vindas
    Route::get('register',function () {
        return view('welcome');
    });
 
    Route::get('/home', [ 'uses' => 'HomeController@index', 'as' => 'dashboard'] );
 
    /* Rotas organizadas para usuários */
    Route::group(['prefix'=> 'usuarios', 'where'=>['id'=>'[0-9]+'] ], function () {
 
        Route::get('', [ 'uses' => 'UserController@index', 'as' => 'usuario.index']);
		Route::get('index', [ 'uses' => 'UserController@index', 'as' => 'usuario.index']);
        Route::get('inserir', ['uses'=> 'UserController@create' , 'as' => 'usuario.create']);
        Route::post('inserir', ['uses'=> 'UserController@store' , 'as' => 'usuario.store']);
        Route::get('{id}/editar', ['uses'=> 'UserController@edit' , 'as' => 'usuario.edit']);
        Route::post('{id}/editar', ['uses'=> 'UserController@update' , 'as' => 'usuario.update']);
        Route::get('{id}/deletar', ['uses'=> 'UserController@delete' , 'as' => 'usuario.delete']);
 
    });
});
