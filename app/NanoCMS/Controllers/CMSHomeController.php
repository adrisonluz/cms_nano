<?php

namespace Nano\NanoCMS\Controllers;

// Use - Defaults
use Illuminate\Http\Request;
use Nano\Nano\Requests;
use Nano\Nano\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use Nano\NanoCMS\CMSPagina;
use Nano\NanoCMS\CMSConfig;

class CMSHomeController extends \Nano\Nano\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();

        $this->middleware('auth');
        $this->retorno = array();
        $this->request = $request->except('_token');

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos usuários
     */
    public function index() {
        return view("nano.home", $this->retorno);
    }

}
