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
use Illuminate\Support\Facades\Input;

class CMSPaginasController extends \Nano\Nano\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('accessPages');

        $this->middleware('auth');
        $this->area = 'nano.cms.paginas';
        $this->retorno = array();
        $this->request = $request->except('_token');

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos página
     */
    public function index() {
        $paginas = CMSPagina::ativos()
                ->paginate(env('25'));

        $this->retorno['paginas'] = $paginas;
        return view($this->area . ".index", $this->retorno);
    }

    /**
     * 	Cadastro de página
     */
    public function create() {
        return view($this->area . ".inserir", $this->retorno);
    }

    /**
     * 	Inserir usuário no banco
     */
    public function store() {
        $rules = array(
            'titulo' => 'required',
            'conteudo' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();
            $this->retorno['request'] = $this->request;
            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $pagina = new CMSPagina;
            $pagina->titulo = $this->request['titulo'];
            $pagina->resumo = $this->request['resumo'];
            $pagina->url = $this->request['url'];
            //$pagina->data = $this->request['data'];
            $pagina->conteudo = $this->request['conteudo'];
            $pagina->ativo = 'sim';
            $pagina->agent_id = $this->usuario_logado->id;

            if (Input::hasFile('imagem')) {
                $ext = Input::file('imagem')->getClientOriginalExtension();
                $pagina->imagem = setUri($pagina->titulo) . '.' . $ext;
                Input::file('imagem')->move('NanoCMS/img/paginas', setUri($pagina->titulo));
            }else{
                $pagina->imagem = 'noimage.png';
            }

            if ($pagina->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Página criada com sucesso!'
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
     * 	Edição de página
     */
    public function edit($id) {
        $this->retorno['pagina'] = CMSPagina::find($id);

        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar usuário no banco
     */
    public function update($id) {
        $rules = array(
            'titulo' => 'required',
            'conteudo' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();
            $this->retorno['request'] = $this->request;
            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $pagina = CMSPagina::find($id);
            $pagina->titulo = $this->request['titulo'];
            $pagina->resumo = $this->request['resumo'];
            $pagina->url = $this->request['url'];
            //$pagina->data = $this->request['data'];
            $pagina->conteudo = $this->request['conteudo'];
            $pagina->agent_id = $this->usuario_logado->id;

            if (Input::hasFile('imagem')) {
                $ext = Input::file('imagem')->getClientOriginalExtension();
                $pagina->imagem = setUri($pagina->titulo) . '.' . $ext;
                Input::file('imagem')->move('NanoCMS/img/paginas', setUri($pagina->titulo));
            }

            if ($pagina->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Página editada com sucesso!'
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
     * Desativar página
     */
    public function lixeira($id) {
        $pagina = CMSPagina::find($id);
        $pagina->lixeira = 'sim';

        if ($pagina->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Página enviada para a lixeira'
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
     * Ativar página
     */
    public function ativar($id) {
        $pagina = CMSPagina::find($id);
        $pagina->lixeira = '';

        if ($pagina->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Página restaurada com sucesso!'
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
     * 	Deletar página
     */
    public function delete($id) {
        if (CMSPagina::find($id)->delete()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => '`Página excluída com sucesso!'
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
