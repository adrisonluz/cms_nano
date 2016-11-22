@extends('nano.layout')
@section('content')

<div class="container">
    @if(isset($mensagem))
    <ul class="alert {{ $mensagem['class'] }}">
        <li>{{ $mensagem['text'] }}</li>
    </ul>
    @endif

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h1>Forms / Editar</h1>
        </div>

        <form name="frm" action="{{ route("nano.cms.forms.update", ["id"=> $form->id ])}}" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="titulo" class="col-sm-3 control-label">Título:</label>
                    <div class="col-sm-9">
                        <input name="titulo" type="text" value="{{ $form->titulo }}" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="origem" class="col-sm-3 control-label">Origem:</label>
                    <div class="col-sm-9">
                        <input name="origem" type="text" value="{{ $form->origem }}" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="classe" class="col-sm-3 control-label">Classe:</label>
                    <div class="col-sm-9">
                        <input name="classe" type="text" value="{{ $form->classe }}" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="classe" class="col-sm-3 control-label">Enviar por email:</label>
                    <div class="col-sm-9">
                        <input name="envio_email" type="checkbox" value="sim" class="" @if($form->envio_email == 'sim') checked="checked" @endif />
                    </div>
                </div>
            </div>

            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="pagina_id" class="col-sm-3 control-label">Página:</label>
                    <div class="col-sm-9">
                        <select name="pagina_id" class="form-control">
                            <option value="" >Todas</option>
                            @if(count($paginas) > 0)
                            @foreach($paginas as $pagina)
                            <option value="{{ $pagina->id }}" {{ $pagina->id == $form->pagina_id ? 'selected=selected' : '' }}>{{ $pagina->titulo }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tipo" class="col-sm-3 control-label">Tipo:</label>
                    <div class="col-sm-9">
                        <select name="tipo" class="form-control">
                            <option value="">Selecione um:</option>
                            <option value="top"  {{ $form->tipo == 'top' ? 'selected=selected' : '' }}>Top</option>
                            <option value="bottom"  {{ $form->tipo == 'bottom' ? 'selected=selected' : '' }}>Bottom</option>
                            <option value="lateral"  {{ $form->tipo == 'lateral' ? 'selected=selected' : '' }}>Lateral</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ordem" class="col-sm-3 control-label">Ordem:</label>
                    <div class="col-sm-9">
                        <input name="ordem" type="number" value="{{ $form->ordem }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="classe" class="col-sm-3 control-label">Resposta automática:</label>
                    <div class="col-sm-9">
                        <input name="resposta" type="checkbox" value="sim" class="" @if($form->resposta == 'sim') checked="checked" @endif/>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group pull-right">
                    <a href="javascript:history.back(-1)">
                        <button type="button" class="btn btn-default">Voltar</button>
                    </a>
                    <button type="submit"  class="btn btn-primary">SALVAR</button>
                </div>
            </div>
        </form>
    
            <div class="clearfix"></div>

            <div class="panel panel-default">
                <div class="panel-heading col-md-12">
                    <div class="">
                        <h4>Fields de form</h4>
                        <small>Adicione fields (campos) ao formulário. </small>
                    </div>
                </div>
          
                <div class="panel-body">
                    <form class="fields" action="{{ route("nano.cms.fields.store") }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="form_id" value="{{ $form->id }}">
                        <input type="hidden" name="editId" value="">
                        <table class="table table-striped table-bordded">
                            <thead>
                                <td>Ação</td>
                                <td>Nome</td>
                                <td>Valor</td>
                                <td>Placeholder</td>
                                <td>Máscara</td>
                                <td>Obrigatório</td>
                                <td>Tipo</td>
                                <td>Ordem</td>
                            </thead>
                            @if(count($form->fields) > 0)
                            @foreach($form->fields as $field)
                            @if($field->input_id == null)
                            <tr>
                                <td width="85">
                                    <a href="{{ route('nano.cms.fields.edit', ['id' => $field->id]) }}" title="Editar" class="editar" rel="{{ $field->id }}">
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                                        </button>
                                    </a>

                                    <a href="{{ route('nano.cms.fields.lixeira', ['id' => $field->id]) }}" title="Descartar" class="delete" rel="{{ $field->id }}">
                                        <button type="button" class="btn btn-danger btn-xs">
                                            <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                        </button>
                                    </a>
                                </td>
                                <td>{{ $field->nome }}</td>
                                <td>{{ $field->valor }}</td>
                                <td>{{ $field->placeholder }}</td>
                                <td>{{ $field->mascara->nome or 'nenhuma' }}</td>
                                <td>{{ $field->obrigatorio }}</td>
                                <td>{{ $field->tipo }}</td>
                                <td>{{ $field->ordem }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                            <tr>
                                <td colspan="8" class="separator">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="8"><strong>Novo field:</strong></td>
                            </tr>
                            <tfoot>
                                <td>
                                    <button type="submit" class="btn btn-primary enviar btn-sm pull-left"><i class="fa fa-save"></i></button>
                                    <button type="reset" class="btn btn-success btn-sm pull-right">
                                        <span class="glyphicon" aria-hidden="true"><i class="fa fa-eraser"></i></span>
                                    </button>
                                </td>
                                <td><input name="nome" type="text" value="" class="form-control" ></td>
                                <td><input name="valor" type="text" value="" class="form-control" ></td>
                                <td><input name="placeholder" type="text" value="" class="form-control" ></td>
                                <td>
                                    <select name="mascara_id" class="form-control">
                                        <option value="">Nenhuma</option>   
                                        @if(count($mascaras) > 0)
                                            @foreach($mascaras as $mask)
                                            <option value="{{ $mask->id }}">{{ $mask->nome }}</option>
                                            @endforeach          
                                        @endif                                     
                                    </select>
                                </td>
                                <td>
                                    <select name="obrigatorio" class="form-control">
                                        <option value="sim">Sim</option> 
                                        <option value="não">Não</option>                          
                                    </select>
                                </td>
                                <td>
                                    <select name="tipo" class="form-control">
                                        <option value="input">Input texto</option> 
                                        <option value="hidden">Input hidden</option>
                                        <option value="select">Select</option>
                                        <option value="checkbox">Checkbox</option>
                                        <option value="textarea">Text area</option>
                                        <option value="captcha">Captcha</option>                
                                    </select>
                                </td>
                                <td width="50px"><input name="ordem" type="number" value="" class="form-control" ></td>
                            </tfoot>
                        </table>
                    </form>      
                </div>
            </div>
    </div>
</div>
@endsection

<!-- Modal Forms -->
<div class="modal fade" id="modalForms" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="box-title">Fields do formulário</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">×</span></button>
                </h3>
            </div>
            <div class="modal-body row text-center">
                    
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Fields -->
<div class="modal fade" id="modalFields" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="box-title">Opções no field</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">×</span></button>
                </h3>
                <p>Este field exige pelo menos uma opção. Os campos são obrigatórios e o campo valor não pode possuir espaços ou caracteres especiais, apenas letras e números.</p>
            </div>
            <div class="modal-body row text-center">
                <div class="col-xs-12">
                    <form class="options" action="{{ route("nano.cms.fields.store") }}" method="post">
                        <table class="table table-striped table-bordded">
                            <thead>
                                <td>Ação</td>
                                <td>Nome</td>
                                <td>Valor</td>
                                <td>Ordem</td>
                            </thead>                            
                            <tr>
                                <td colspan="4" class="separator">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong>Novo option:</strong></td>
                            </tr>
                            <tfoot>
                                <td><button type="submit"  class="btn btn-primary enviar"><i class="fa fa-save"></i></button></td>
                                <td><input name="nome" type="text" value="" class="form-control" ></td>
                                <td><input name="valor" type="text" value="" class="form-control" ></td>
                                <td width="50px"><input name="ordem" type="number" value="" class="form-control" ></td>
                            </tfoot>
                        </table>
                    </form>    
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->