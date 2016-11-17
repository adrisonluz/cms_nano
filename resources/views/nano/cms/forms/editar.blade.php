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
            <div class="col-md-5">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="titulo" class="col-sm-3 control-label">Título:</label>
                    <div class="col-sm-9">
                        <input name="titulo" type="text" value="{{ $menu->titulo }}" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="origem" class="col-sm-3 control-label">Origem:</label>
                    <div class="col-sm-9">
                        <input name="origem" type="text" value="{{ $menu->origem }}" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="classe" class="col-sm-3 control-label">Classe:</label>
                    <div class="col-sm-9">
                        <input name="classe" type="text" value="{{ $menu->classe }}" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="pagina_id" class="col-sm-3 control-label">Página:</label>
                    <div class="col-sm-9">
                        <select name="pagina_id" class="form-control">
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
                        <input name="ordem" type="number" value="{{ $menu->ordem }}" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
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
                    <form class="forms-fields" action="{{ route("nano.cms.forms-fields.store") }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="form_id" value="{{ $form->id }}">
                        <input type="hidden" name="editId" value="">
                        <table class="table table-striped table-bordded">
                            
                        </table>
                    </form>      
                </div>
            </div>
    </div>
</div>
@endsection

<!-- Modal Niveis -->
<div class="modal fade" id="modalFields" role="dialog">
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