<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSForm;
use NanoCMS\CMSField;
use NanoCMS\CMSConfig;
use NanoCMS\CMSPagina;
use NanoCMS\CMSMascara;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class CMSFormsController extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('accessForms');

        $this->middleware('auth');
        $this->area = 'nano.cms.forms';
        $this->retorno = array();
        $this->request = $request->except('_token');
        $this->retorno['paginas'] = CMSPagina::all();
        $this->retorno['mascaras'] = CMSMascara::all();
        
        $this->retorno['js'] = [
            url('NanoCMS/js/forms.js')
        ];

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos forms
     */
    public function index() {
        $forms = CMSForm::ativos()
                ->paginate(env('25'));

        $this->retorno['forms'] = $forms;
        return view($this->area . ".index", $this->retorno);
    }

    /**
     * 	Cadastro de form
     */
    public function create() {
        return view($this->area . ".inserir", $this->retorno);
    }

    /**
     * 	Inserir form no banco
     */
    public function store() {
        $this->retorno['request'] = $this->request;

        $rules = array(
            'titulo' => 'required',
            'origem' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();

            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $form = new CMSForm;

            if($this->request['pagina_id'] !== '' && $this->request['pagina_id'] !== 0){
                $form->pagina_id = null;    
            }

            $form->titulo = $this->request['titulo'];
            $form->classe = $this->request['classe'];
            $form->origem = $this->request['origem'];
            $form->tipo = $this->request['tipo'];
            $form->ordem = $this->request['ordem'];
            $form->ativo = 'sim';
            $form->agent_id = $this->usuario_logado->id;

            if ($form->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Formulário cadastrado com sucesso!'
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
     * 	Edição de form
     */
    public function edit($id) {
        $this->retorno['form'] = CMSForm::find($id);

        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar form no banco
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
            $form = CMSForm::find($id);
            $form->titulo = $this->request['titulo'];
            $form->tipo = $this->request['tipo'];
            $form->ativo = 'sim';
            $form->agent_id = $this->usuario_logado->id;

            if ($form->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Formulário editado com sucesso!'
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
     * Desativar form
     */
    public function lixeira($id) {
        $form = CMSForm::find($id);
        $form->lixeira = 'sim';

        if ($form->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Formulário enviado para a lixeira'
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
     * Ativar form
     */
    public function ativar($id) {
        $form = CMSForm::find($id);
        $form->lixeira = '';

        if ($form->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Formulário restaurado com sucesso!'
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
     * 	Deletar form
     */
    public function delete($id) {
        if (CMSForm::find($id)->delete()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => '`Formulário excluído com sucesso!'
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
