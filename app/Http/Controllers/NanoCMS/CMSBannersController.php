<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSBanner;
use NanoCMS\CMSConfig;
use Illuminate\Support\Facades\Input;

class CMSBannersController extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('acessBanners');

        $this->middleware('auth');
        $this->area = 'cms.banners';
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
        $banners = CMSBanner::whereNull('lixeira')
                ->orWhereIn('lixeira', ['', 'nao'])
                ->paginate(env('25'));

        $this->retorno['banners'] = $banners;
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
            $banner = new CMSBanner;
            $banner->titulo = $this->request['titulo'];
            $banner->resumo = $this->request['resumo'];
            $banner->url = $this->request['url'];
            $banner->data = $this->request['data'];
            $banner->conteudo = $this->request['conteudo'];
            $banner->ativo = 'sim';

            if (Input::hasFile('imagem')) {
                $ext = Input::file('imagem')->getClientOriginalExtension();
                $banner->imagem = setUri($banner->titulo) . '.' . $ext;
                Input::file('imagem')->move('img/banners', setUri($banner->titulo));
            }

            if ($banner->save()) {
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
        $this->retorno['banner'] = CMSBanner::find($id);

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
            $banner = CMSBanner::find($id);
            $banner->titulo = $this->request['titulo'];
            $banner->resumo = $this->request['resumo'];
            $banner->url = $this->request['url'];
            $banner->data = $this->request['data'];
            $banner->conteudo = $this->request['conteudo'];

            if (Input::hasFile('imagem')) {
                $ext = Input::file('imagem')->getClientOriginalExtension();
                $banner->imagem = setUri($banner->titulo) . '.' . $ext;
                Input::file('imagem')->move('img/banners', setUri($banner->titulo));
            }

            if ($banner->save()) {
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
        $banner = CMSBanner::find($id);
        $banner->lixeira = 'sim';

        if ($banner->save()) {
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
        $banner = CMSBanner::find($id);
        $banner->lixeira = '';

        if ($banner->save()) {
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
        if (CMSBanner::find($id)->delete()) {
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
