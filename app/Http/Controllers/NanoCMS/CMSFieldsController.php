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

        if(!empty($_POST['optionData'])){
            foreach ($_POST['optionData'] as $data) {
                $optionArray[] = json_decode($data);    
            }
            
            unset($_POST['optionData']);
        }

        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        unset($_POST['_token']);
        unset($_POST['editId']);

        if(empty($_POST['mascara_id']))
            $_POST['mascara_id'] = null;

        if($nome !== '' && $tipo !== ''){
            if(isset($editId)){
                $field = CMSField::find($editId);
                $resposta = 'editado';
            }else{
                $field = new CMSField();
                $resposta = 'criado';
            }

            foreach ($_POST as $key => $val) {
                $field->$key = $val;
            }

            if($field->save()){
                $mascara = (count($field->mascara) > 0 ? $field->mascara->nome : 'nenhuma');
                $msg = '';

                if(isset($optionArray)){
                    $tipoOption = ($field->tipo == 'select' ? 'option' : 'checkbox');

                    foreach($optionArray as $optionInfo){   
                        $option = new CMSField();
                        $option->nome = $optionInfo[0]->value;
                        $option->valor = $optionInfo[1]->value;
                        $option->ordem = $optionInfo[2]->value;
                        $option->tipo = $tipoOption;
                        $option->form_id = $field->form_id;
                        $option->input_id = $field->id;
                        
                        if(!$option->save()){
                            $msg = 'Houve algum erro ao salvar as opções, favor verificar e tentar novamente.';
                        }
                    }
                }

                $this->retorno['type'] = 'success';
                $msg = ($msg == '' ? 'Field ' . $resposta . ' com sucesso!' : $msg);

                $this->retorno['msg'] = $msg;
                $this->retorno['fieldId'] = $field->id;
                $this->retorno['fieldNome'] = $field->nome;
                $this->retorno['fieldValor'] = $field->valor;
                $this->retorno['fieldPlaceholder'] = $field->placeholder;
                $this->retorno['fieldMask'] = $mascara;
                $this->retorno['fieldObrigatorio'] = $field->obrigatorio;
                $this->retorno['fieldTipo'] = $field->tipo;
                $this->retorno['fieldOrdem'] = $field->ordem;
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

    public function update(){
        if(!empty($_POST['editId']))
            $id = $_POST['editId'];

        if($id){
                $field = CMSField::find($id);

                $this->retorno['fieldId'] = $field->id;
                $this->retorno['fieldNome'] = $field->nome;
                $this->retorno['fieldValor'] = $field->valor;
                $this->retorno['fieldPlaceholder'] = $field->placeholder;
                $this->retorno['fieldMask'] = $field->mascara_id;
                $this->retorno['fieldObrigatorio'] = $field->obrigatorio;
                $this->retorno['fieldTipo'] = $field->tipo;
                $this->retorno['fieldOrdem'] = $field->ordem;
                $this->retorno['fieldOptions'] = (count($field->options) > 0 ? $field->options->toArray() : null);
        }

        echo json_encode($this->retorno);
        die();
    }

    public function lixeira(){
        $fieldsId = $_POST['editId'];
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
