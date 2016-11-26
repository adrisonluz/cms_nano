<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSCategoria;
use NanoCMS\CMSConfig;
use NanoCMS\CMSPost;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class CMSCategoriasController extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('accessPosts');

        $this->middleware('auth');
        $this->area = 'nano.cms.categorias';
        $this->retorno = array();
        $this->request = $request->except('_token');
        $this->retorno['posts'] = CMSPost::all();
        
        $this->retorno['js'] = [
            url('NanoCMS/js/categorias.js')
        ];

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos categorias
     */
    public function index() {
        $categorias = CMSCategoria::ativos()
                ->paginate(env('25'));

        $this->retorno['categorias'] = $categorias;
        return view($this->area . ".index", $this->retorno);
    }

    /**
     * 	Cadastro de categoria
     */
    public function create() {
        $this->retorno['categorias'] = CMSCategoria::ativos()->get();
        return view($this->area . ".inserir", $this->retorno);
    }

    /**
     * 	Inserir categoria no banco
     */
    public function store() {
        $this->retorno['request'] = $this->request;

        $rules = array(
            'titulo' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();

            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $categoria = new CMSCategoria;
            $categoria->titulo = $this->request['titulo'];
            $categoria->categoria_pai_id = (isset($this->request['categoria_pai_id']) ? $this->request['categoria_pai_id'] : null);
            $categoria->conteudo = $this->request['conteudo'];
            $categoria->url = $this->request['url'];
            $categoria->ordem = $this->request['ordem'];
            $categoria->ativo = 'sim';
            $categoria->agent_id = $this->usuario_logado->id;

            if (Input::hasFile('imagem')) {
                $ext = Input::file('imagem')->getClientOriginalExtension();
                $categoria->imagem = setUri($categoria->titulo) . '.' . $ext;
                Input::file('imagem')->move('NanoCMS/img/categorias', setUri($categoria->titulo));
            }else{
                $categoria->imagem = 'noimage.png';
            }

            if ($categoria->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Categoria cadastrada com sucesso!'
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
     * 	Edição de categoria
     */
    public function edit($id) {
        $this->retorno['categoria'] = CMSCategoria::find($id);
        $this->retorno['categorias'] = CMSCategoria::ativos()->get();
        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar categoria no banco
     */
    public function update($id) {
        $this->retorno['request'] = $this->request;

        $rules = array(
            'titulo' => 'required',
        );

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();

            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $categoria = CMSCategoria::find($id);
            $categoria->titulo = $this->request['titulo'];
            $categoria->categoria_pai_id = (isset($this->request['categoria_pai_id']) ? $this->request['categoria_pai_id'] : null);
            $categoria->conteudo = $this->request['conteudo'];
            $categoria->url = $this->request['url'];
            $categoria->ordem = $this->request['ordem'];
            $categoria->agent_id = $this->usuario_logado->id;

            if (Input::hasFile('imagem')) {
                $ext = Input::file('imagem')->getClientOriginalExtension();
                $categoria->imagem = setUri($categoria->titulo) . '.' . $ext;
                Input::file('imagem')->move('NanoCMS/img/categorias', setUri($categoria->titulo));
            }

            if ($categoria->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Categoria editada com sucesso!'
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
     * Desativar categoria
     */
    public function lixeira($id) {
        $categoria = CMSCategoria::find($id);
        $categoria->lixeira = 'sim';

        if ($categoria->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Categoria enviada para a lixeira'
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
     * Ativar categoria
     */
    public function ativar($id) {
        $categoria = CMSCategoria::find($id);
        $categoria->lixeira = '';

        if ($categoria->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Categoria restaurada com sucesso!'
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
     * 	Deletar categoria
     */
    public function delete($id) {
        if (CMSCategoria::find($id)->delete()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Categoria excluído com sucesso!'
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
