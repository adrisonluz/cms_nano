<?php

namespace NanoCMS\Http\Controllers;

use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\UserRequest;
use NanoCMS\User;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     *   Listagem dos usuários
     */
    public function index() {
        $usuarios = User::paginate(env('25'));
        return view("admin.usuarios.index", [ "usuarios" => $usuarios]);
    }

    /**
     * 	Cadastro de usuários
     */
    public function create() {
        return view("admin.usuarios.inserir");
    }

    /**
     * 	Inserir usuário no banco
     */
    public function store(UserRequest $request) {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        return redirect()->route('admin.usuarios.index');
    }

    /**
     * 	Edição de usuários
     */
    public function edit($id) {
        $usuario = User::find($id);
        return view('admin.usuarios.editar', [ 'usuario' => $usuario]);
    }

    /**
     * 	Editar usuário no banco
     */
    public function update(UserRequest $request, $id) {

        $usuario = User::find($id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);
        return redirect()->route('admin.usuarios.index');
    }

    /**
     * 	Deletar usuários
     */
    public function delete($id) {
        User::find($id)->delete();
        return redirect()->route('admin.usuarios.index');
    }

}
