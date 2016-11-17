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
            <h1>Forms / Inserir</h1>
        </div>

        <form name="frm" action="{{ route("nano.cms.forms.store")}}" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="titulo" class="col-sm-3 control-label">Título:</label>
                    <div class="col-sm-9">
                        <input name="titulo" type="text" value="@if(isset($request['titulo'])) {{$request['titulo']}} @endif" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="origem" class="col-sm-3 control-label">Origem:</label>
                    <div class="col-sm-9">
                        <input name="origem" type="text" value="@if(isset($request['origem'])) {{$request['origem']}} @endif" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="classe" class="col-sm-3 control-label">Classe:</label>
                    <div class="col-sm-9">
                        <input name="classe" type="text" value="@if(isset($request['classe'])) {{$request['classe']}} @endif" class="form-control" />
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
                            <option value="{{ $pagina->id }}"  @if(isset($request)) {{ $pagina->id == $request['pagina_id'] ? 'selected=selected' : '' }} @endif>{{ $pagina->titulo }}</option>
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
                            <option value="top"  @if(isset($request)) {{ $request['tipo'] == 'top' ? 'selected=selected' : '' }} @endif>Top</option>
                            <option value="bottom"  @if(isset($request)) {{ $request['tipo'] == 'bottom' ? 'selected=selected' : '' }} @endif>Bottom</option>
                            <option value="lateral"  @if(isset($request)) {{ $request['tipo'] == 'lateral' ? 'selected=selected' : '' }} @endif>Lateral</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ordem" class="col-sm-3 control-label">Ordem:</label>
                    <div class="col-sm-9">
                        <input name="ordem" type="number" value="@if(isset($request['ordem'])) {{$request['ordem']}} @endif" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <div class="pull-right ">
                        <br>
                        <a href="javascript:history.back(-1)">
                            <button type="button" class="btn btn-default">Voltar</button>
                        </a>
                        <button type="submit"  class="btn btn-primary">SALVAR</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

        <br>

    <div class="panel panel-default">
        <div class="panel-heading full">
            <div class="">
                <h4>Instruções</h4>
                <p>Após cadastrado o novo formulário e devidamente vinculado à uma página, você precisa entrar na área de edição do mesmo para incluir fields (campos). O campo <strong>Origem</strong> serve para identificar de onde veio o contato/cotação do site, por isso ele é obrigatório. O tipo <strong>Todas</strong> respeita o layout do site, então é possível que em algumas páginas o formulário não apareça, mesmo sendo do tipo todas.</p>
            </div>
        </div>
    </div>
</div>
@endsection
