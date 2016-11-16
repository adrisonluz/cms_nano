<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSMenuItens;

class CMSMenusItensController  extends \NanoCMS\Http\Controllers\NanoController {

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
        $menu_id = $_POST['menu_id'];
        $menupai_id = ($_POST['tipo'] == 'item' ? 0 : $_POST['tipo']);

        if($titulo !== '' && $link !== ''){
            if(isset($editId)){
                $menuItem = CMSMenuItens::find($editId);
                $resposta = 'editado';
            }else{
                $menuItem = new CMSMenuItens();
                $resposta = 'criado';
            }
            
            $menuItem->titulo = $titulo;
            $menuItem->link = $link;
            $menuItem->ativo = $ativo;
            $menuItem->menu_id = $menu_id;
            $menuItem->menupai_id = $menupai_id;

            if($menuItem->save()){
                $this->retorno['type'] = 'success';
                $this->retorno['msg'] = 'Item de menu ' . $resposta . ' com sucesso!';
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
        $menusItensId = $_POST['id'];
        if(CMSMenuItens::find($menusItensId)->delete()){
            $this->retorno['type'] = 'success';
            $this->retorno['msg'] = 'Item de menu excluido com sucesso!';
        }else{
            $this->retorno['type'] = 'danger';
            $this->retorno['msg'] = 'Houve algum erro durante o processamento. Por favor, tente mais tarde.';
        }
        
        echo json_encode($this->retorno);
        die();
    }
}
