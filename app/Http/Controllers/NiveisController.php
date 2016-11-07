<?php

namespace NanoCMS\Http\Controllers;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\Nivel;

class NiveisController extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct() {
        parent::__construct();
        $this->retorno = array();
    }

    public function store(){
        $nivel = $_POST['nivel'];

        if($nivel !== ''){
            $createNivel = new Nivel();
            $createNivel->nivel = $nivel;

            if($createNivel->save()){
                $this->retorno['type'] = 'success';
                $this->retorno['msg'] = 'Nivel criado com sucesso!';
                $this->retorno['nivelId'] = $createNivel->id;
                $this->retorno['nivelName'] = $createNivel->nivel;
            }else{
                $this->retorno['type'] = 'danger';
                $this->retorno['msg'] = 'Houve algum erro durante o processamento. Por favor, tente mais tarde.';
            }
        }else{
            $this->retorno['type'] = 'warning';
            $this->retorno['msg'] = 'Por favor, insira o nome do nivel a ser criado.';
        }

        echo json_encode($this->retorno);
        die();
    }

    public function lixeira(){
        $nivel = $_POST['nivel'];
        if(Nivel::find($nivel)->delete()){
            $this->retorno['type'] = 'success';
            $this->retorno['msg'] = 'Nivel excluido com sucesso!';
        }else{
            $this->retorno['type'] = 'danger';
            $this->retorno['msg'] = 'Houve algum erro durante o processamento. Por favor, tente mais tarde.';
        }
        
        echo json_encode($this->retorno);
        die();
    }
}
