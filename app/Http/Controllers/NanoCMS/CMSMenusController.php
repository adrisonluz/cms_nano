<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSMenu;
use NanoCMS\CMSConfig;
use NanoCMS\CMSPagina;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class CMSMenusController extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('accessMenus');

        $this->middleware('auth');
        $this->area = 'nano.cms.menus';
        $this->retorno = array();
        $this->request = $request->except('_token');
        $this->retorno['paginas'] = CMSPagina::all();
        
        $this->retorno['js'] = [
            url('NanoCMS/js/menus.js')
        ];

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos menus
     */
    public function index() {
        $menus = CMSMenu::ativos()
                ->paginate(env('25'));

        $this->retorno['menus'] = $menus;
        return view($this->area . ".index", $this->retorno);
    }

    /**
     * 	Cadastro de menu
     */
    public function create() {
        return view($this->area . ".inserir", $this->retorno);
    }

    /**
     * 	Inserir menu no banco
     */
    public function store() {
        $this->retorno['request'] = $this->request;

        $rules = array(
            'titulo' => 'required',
            'tipo' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();

            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $menu = new CMSMenu;
            $menu->titulo = $this->request['titulo'];
            $menu->tipo = $this->request['tipo'];
            $menu->ativo = 'sim';
            $menu->agent_id = $this->usuario_logado->id;

            if ($menu->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Menu cadastrado com sucesso!'
                ]);
                return redirect()->route($this->area . '.index')->with($this->retorno);
            }

            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ];
            return view($this->area . '.inserir')->with($this->retorno);
        }
    }

    /**
     * 	Edição de menu
     */
    public function edit($id) {
        $this->retorno['menu'] = CMSMenu::find($id);

        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar menu no banco
     */
    public function update($id) {
        $this->retorno['request'] = $this->request;

        $rules = array(
            'titulo' => 'required',
            'tipo' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();

            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $menu = CMSMenu::find($id);
            $menu->titulo = $this->request['titulo'];
            $menu->tipo = $this->request['tipo'];
            $menu->ativo = 'sim';
            $menu->agent_id = $this->usuario_logado->id;

            if ($menu->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Menu editado com sucesso!'
                ]);
                return redirect()->route($this->area . '.index')->with($this->retorno);
            }

            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ];
            return view($this->area . '.inserir')->with($this->retorno);
        }
    }

    /**
     * Desativar menu
     */
    public function lixeira($id) {
        $menu = CMSMenu::find($id);
        $menu->lixeira = 'sim';

        if ($menu->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Menu enviado para a lixeira'
            ]);
        } else {
            Session::put('mensagem', [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ]);
        }

        return redirect()->route($this->area . '.index')->with($this->retorno);
    }

    /**
     * Ativar menu
     */
    public function ativar($id) {
        $menu = CMSMenu::find($id);
        $menu->lixeira = '';

        if ($menu->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Menu restaurado com sucesso!'
            ]);
        } else {
            Session::put('mensagem', [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ]);
        }

        return redirect()->route($this->area . '.index')->with($this->retorno);
    }

    /**
     * 	Deletar menu
     */
    public function delete($id) {
        if (CMSMenu::find($id)->delete()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => '`Menu excluído com sucesso!'
            ]);
        } else {
            Session::put('mensagem', [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ]);
        }

        return redirect()->route($this->area . '.index')->with($this->retorno);
    }

}
