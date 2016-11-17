<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSField;

class CMSFieldsController  extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct() {
        parent::__construct();
        $this->retorno = array();
    }

    public function store(){
        if(!empty($_POST['editId']))
            $editId = $_POST['editId'];

        $titulo = $_POST['titulo'];
        $link = $_POST['link'];
        $ativo = $_POST['ativo'];
        $form_id = $_POST['form_id'];
        $input_id = ($_POST['tipo'] == 'item' ? 0 : $_POST['tipo']);

        if($titulo !== '' && $link !== ''){
            if(isset($editId)){
                $menuItem = CMSField::find($editId);
                $resposta = 'editado';
            }else{
                $menuItem = new CMSField();
                $resposta = 'criado';
            }
            
            $menuItem->titulo = $titulo;
            $menuItem->link = $link;
            $menuItem->ativo = $ativo;
            $menuItem->form_id = $form_id;
            $menuItem->input_id = $input_id;

            if($menuItem->save()){
                $this->retorno['type'] = 'success';
                $this->retorno['msg'] = 'Field ' . $resposta . ' com sucesso!';
                $this->retorno['menuItemId'] = $menuItem->id;
                $this->retorno['menuItemTitulo'] = $menuItem->titulo;
                $this->retorno['menuItemLink'] = $menuItem->link;
                $this->retorno['menuItemTipo'] = ($menuItem->tipo == 0) ? 'item' : 'sub-item';
                $this->retorno['menuItemAtivo'] = $menuItem->ativo;
                $this->retorno['resposta'] = $resposta;
            }else{
                $this->retorno['type'] = 'danger';
                $this->retorno['msg'] = 'Houve algum erro durante o processamento. Por favor, tente mais tarde.';
            }
        }else{
            $this->retorno['type'] = 'warning';
            $this->retorno['msg'] = 'Atenção, todos os campos são obrigatórios.';
        }

        echo json_encode($this->retorno);
        die();
    }

    public function lixeira(){
        $fieldsId = $_POST['id'];
        if(CMSField::find($fieldsId)->delete()){
            $this->retorno['type'] = 'success';
            $this->retorno['msg'] = 'Field excluido com sucesso!';
        }else{
            $this->retorno['type'] = 'danger';
            $this->retorno['msg'] = 'Houve algum erro durante o processamento. Por favor, tente mais tarde.';
        }
        
        echo json_encode($this->retorno);
        die();
    }
}
