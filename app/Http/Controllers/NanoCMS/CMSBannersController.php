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
use NanoCMS\CMSPagina;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class CMSBannersController extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('acessBanners');

        $this->middleware('auth');
        $this->area = 'cms.banners';
        $this->retorno = array();
        $this->request = $request->except('_token');
        $this->retorno['paginas'] = CMSPagina::all();

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos banners
     */
    public function index() {
        $banners = CMSBanner::whereNull('lixeira')
                ->orWhereIn('lixeira', ['', 'nao'])
                ->orderBy('ordem')
                ->paginate(env('25'));

        $this->retorno['banners'] = $banners;
        return view($this->area . ".index", $this->retorno);
    }

    /**
     * 	Cadastro de banner
     */
    public function create() {
        return view($this->area . ".inserir", $this->retorno);
    }

    /**
     * 	Inserir banner no banco
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
            $banner = new CMSBanner;
            $banner->titulo = $this->request['titulo'];
            $banner->conteudo = $this->request['conteudo'];
            $banner->pagina_id = $this->request['pagina_id'];
            $banner->tipo = $this->request['tipo'];
            $banner->data_ini = $this->request['data_ini'];
            $banner->data_fim = $this->request['data_fim'];
            $banner->link = $this->request['link'];
            $banner->video = $this->request['video'];
            $banner->ordem = $this->request['ordem'];
            $banner->ativo = 'sim';

            if ($banner->save()) {
                if (Input::hasFile('imagem')) {
                    $ext = Input::file('imagem')->getClientOriginalExtension();
                    $banner->imagem = setUri($banner->titulo) . '_' . $banner->id . '.' . $ext;
                    Input::file('imagem')->move('img/banners', setUri($banner->imagem));
                }

                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Banner cadastrado com sucesso!'
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
     * 	Edição de banner
     */
    public function edit($id) {
        $this->retorno['banner'] = CMSBanner::find($id);

        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar banner no banco
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
            $banner = CMSBanner::find($id);
            $banner->titulo = $this->request['titulo'];
            $banner->conteudo = $this->request['conteudo'];
            $banner->pagina_id = $this->request['pagina_id'];
            $banner->tipo = $this->request['tipo'];
            $banner->data_ini = $this->request['data_ini'];
            $banner->data_fim = $this->request['data_fim'];
            $banner->link = $this->request['link'];
            $banner->video = $this->request['video'];
            $banner->ordem = $this->request['ordem'];
            $banner->ativo = 'sim';

            if (Input::hasFile('imagem')) {
                File::delete('img/banners/' . $banner->imagem);

                $ext = Input::file('imagem')->getClientOriginalExtension();
                $banner->imagem = setUri($banner->titulo) . '_' . $banner->id . '.' . $ext;
                Input::file('imagem')->move('img/banners', $banner->imagem);
            }

            if ($banner->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Banner editado com sucesso!'
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
     * Desativar banner
     */
    public function lixeira($id) {
        $banner = CMSBanner::find($id);
        $banner->lixeira = 'sim';

        if ($banner->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Banner enviado para a lixeira'
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
     * Ativar banner
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
     * 	Deletar banner
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
