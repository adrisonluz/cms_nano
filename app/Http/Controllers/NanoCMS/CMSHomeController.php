<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSPagina;
use NanoCMS\CMSConfig;

class CMSHomeController extends \NanoCMS\Http\Controllers\NanoController {

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
        return view("home", $this->retorno);
    }

}
