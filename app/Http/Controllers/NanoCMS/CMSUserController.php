<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSUser;
use NanoCMS\Nivel;

class CMSUserController extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('acessUsers');

        $this->middleware('auth');
        $this->retorno = array();
        $this->request = $request->except('_token');
        $this->area = 'cms.usuarios';

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos usuários
     */
    public function index() {
        $usuarios = CMSUser::whereNull('lixeira')
                ->orWhereIn('lixeira', ['', 'nao'])
                ->paginate(env('25'));

        $this->retorno['usuarios'] = $usuarios;

        return view($this->area . ".index", $this->retorno);
    }

    /**
     * 	Cadastro de usuários
     */
    public function create() {
        return view($this->area . ".inserir", $this->retorno);
    }

    /**
     * 	Inserir usuário no banco
     */
    public function store() {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'login' => 'required'
        );

        if ($this->request['password'] !== $this->request['password_confirmation'] || $this->request['password'] == '') {
            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Campo senha não confere com a confirmação de senha ou está vazio.'
            ];

            $this->retorno['request'] = $this->request;
            return view($this->area . '.inserir')->with($this->retorno);
        }

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();
            $this->retorno['request'] = $this->request;
            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $usuario = new CMSUser;
            $usuario->name = $this->request['name'];
            $usuario->email = $this->request['email'];
            $usuario->password = bcrypt($this->request['password']);
            $usuario->login = $this->request['login'];
            $usuario->rg = $this->request['rg'];
            $usuario->cpf = $this->request['cpf'];
            $usuario->nascimento = $this->request['nascimento'];
            $usuario->telefone = $this->request['telefone'];
            $usuario->celular = $this->request['celular'];
            $usuario->endereco = $this->request['endereco'];
            $usuario->bairro = $this->request['bairro'];
            $usuario->cidade = $this->request['cidade'];
            $usuario->uf = $this->request['uf'];
            $usuario->cep = $this->request['cep'];
            $usuario->observacoes = $this->request['observacoes'];
            $usuario->nivel = $this->request['nivel'];
            $usuario->lixeira = 'nao';

            if ($this->request['codImagem'] !== '') {
                $usuario->foto = setUri($usuario->name) . '_' . $usuario->id . '.png';
                $usuario->setImagemFoto($this->request['codImagem'], $usuario->foto);
            }

            if ($usuario->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Usuário criado com sucesso!'
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
     * 	Edição de usuários
     */
    public function edit($id) {
        $this->retorno['usuario'] = CMSUser::find($id);
        $this->retorno['niveis'] = Nivel::all();

        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar usuário no banco
     */
    public function update($id) {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'login' => 'required'
        );

        if ($this->request['password'] !== $this->request['password_confirmation'] || $this->request['password'] == '') {
            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Campo senha não confere com a confirmação de senha ou está vazio.'
            ];

            $this->retorno['request'] = $this->request;
            return view($this->area . '.editar')->with($this->retorno);
        }

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();
            $this->retorno['request'] = $this->request;
            return view($this->area . '.editar')->with($this->retorno);
        } else {
            $usuario = CMSUser::find($id);
            $usuario->name = $this->request['name'];
            $usuario->email = $this->request['email'];
            $usuario->password = bcrypt($this->request['password']);
            $usuario->login = $this->request['login'];
            $usuario->rg = $this->request['rg'];
            $usuario->cpf = $this->request['cpf'];
            $usuario->nascimento = $this->request['nascimento'];
            $usuario->telefone = $this->request['telefone'];
            $usuario->celular = $this->request['celular'];
            $usuario->endereco = $this->request['endereco'];
            $usuario->bairro = $this->request['bairro'];
            $usuario->cidade = $this->request['cidade'];
            $usuario->uf = $this->request['uf'];
            $usuario->cep = $this->request['cep'];
            $usuario->observacoes = $this->request['observacoes'];
            $usuario->nivel = $this->request['nivel'];
            $usuario->lixeira = 'nao';

            if ($usuario->save()) {
                if ($this->request['codImagem'] !== '') {
                    $usuario->foto = setUri($usuario->name) . '_' . $usuario->id . '.png';
                    $usuario->setImagemFoto($this->request['codImagem'], $usuario->foto);
                }

                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Usuário editado com sucesso!'
                ]);
                return redirect()->route($this->area . '.index')->with($this->retorno);
            }

            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ];
            return view($this->area . '.editar')->with($this->retorno);
        }
    }

    /**
     * Desativar usuário
     */
    public function lixeira($id) {
        $usuario = CMSUser::find($id);
        $usuario->lixeira = 'sim';

        if ($usuario->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Usuário desativado com sucesso!'
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
     * Ativar usuário
     */
    public function ativar($id) {
        $usuario = CMSUser::find($id);
        $usuario->lixeira = '';

        if ($usuario->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Usuário ativado com sucesso!'
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
     * 	Deletar usuários
     */
    public function delete($id) {
        if (CMSUser::find($id)->delete()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Usuário editado com sucesso!'
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
