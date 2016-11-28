<?php

namespace Nano\NanoCMS\Controllers;

// Use - Defaults
use Illuminate\Http\Request;
use Nano\Nano\Requests;
use Nano\Nano\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use Nano\NanoCMS\CMSAgenda;
use Nano\NanoCMS\CMSConfig;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class CMSAgendasController extends \Nano\Nano\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('accessAgendas');

        $this->middleware('auth');
        $this->area = 'nano.cms.agendas';
        $this->retorno = array();
        $this->request = $request->except('_token');

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos agendas
     */
    public function index() {
        $agendas = CMSAgenda::ativos()
                ->paginate(env('25'));

        $this->retorno['agendas'] = $agendas;
        return view($this->area . ".index", $this->retorno);
    }

    /**
     * 	Cadastro de agenda
     */
    public function create() {
        return view($this->area . ".inserir", $this->retorno);
    }

    /**
     * 	Inserir agenda no banco
     */
    public function store() {
        $this->retorno['request'] = $this->request;

        $rules = array(
            'titulo' => 'required',
            'conteudo' => 'required',
            'data_ini' => 'required',
            'data_fim' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();

            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $agenda = new CMSAgenda;
            $agenda->titulo = $this->request['titulo'];
            $agenda->data_ini = $this->request['data_ini'];
            $agenda->data_fim = $this->request['data_fim'];
            $agenda->conteudo = $this->request['conteudo'];
            $agenda->url = $this->request['url'];
            $agenda->ativo = 'sim';
            $agenda->agent_id = $this->usuario_logado->id;

            if ($agenda->save()) {
                if (Input::hasFile('imagem')) {
                    $ext = Input::file('imagem')->getClientOriginalExtension();
                    $agenda->imagem = setUri($agenda->titulo) . '_' . $agenda->id . '.' . $ext;
                    Input::file('imagem')->move('NanoCMS/img/agendas', setUri($agenda->imagem));
                }

                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Agenda cadastrado com sucesso!'
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
     * 	Edição de agenda
     */
    public function edit($id) {
        $this->retorno['agenda'] = CMSAgenda::find($id);

        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar agenda no banco
     */
    public function update($id) {
        $this->retorno['request'] = $this->request;

        $rules = array(
            'titulo' => 'required',
            'conteudo' => 'required',
            'data_ini' => 'required',
            'data_fim' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();

            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $agenda = CMSAgenda::find($id);
            $agenda->titulo = $this->request['titulo'];
            $agenda->data_ini = $this->request['data_ini'];
            $agenda->data_fim = $this->request['data_fim'];
            $agenda->conteudo = $this->request['conteudo'];
            $agenda->url = $this->request['url'];
            $agenda->agent_id = $this->usuario_logado->id;

            if (Input::hasFile('imagem')) {
                File::delete('NanoCMS/img/agendas/' . $agenda->imagem);

                $ext = Input::file('imagem')->getClientOriginalExtension();
                $agenda->imagem = setUri($agenda->titulo) . '_' . $agenda->id . '.' . $ext;
                Input::file('imagem')->move('NanoCMS/img/agendas', $agenda->imagem);
            }

            if ($agenda->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Agenda editado com sucesso!'
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
     * Desativar agenda
     */
    public function lixeira($id) {
        $agenda = CMSAgenda::find($id);
        $agenda->lixeira = 'sim';

        if ($agenda->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Agenda enviado para a lixeira'
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
     * Ativar agenda
     */
    public function ativar($id) {
        $agenda = CMSAgenda::find($id);
        $agenda->lixeira = '';

        if ($agenda->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Agenda restaurada com sucesso!'
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
     * 	Deletar agenda
     */
    public function delete($id) {
        if (CMSAgenda::find($id)->delete()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Agenda excluída com sucesso!'
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
