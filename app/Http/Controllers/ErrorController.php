<?php

namespace NanoCMS\Http\Controllers;

use NanoCMS\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    public function erro403() {
        $this->retorno['erroMensagem'] = 'Desculpe, mas você não tem permissão para editar esta área. Entre em contato com o administrador do sistema para mais informações';

        return view('errors.index', $this->retorno);
    }

    public function erro404() {
        $this->retorno['erroMensagem'] = 'Desculpe, mas a página solicitada não foi encontrada ou não existe.';

        return view('errors.index', $this->retorno);
    }

}
