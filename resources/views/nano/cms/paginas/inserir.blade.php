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
            <h1>Páginas / Inserir</h1>
        </div>

        <form name="frm" action="{{ route("cms.paginas.store")}}" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="titulo" class="col-sm-3 control-label">Título:</label>
                    <div class="col-sm-9">
                        <input name="titulo" type="text" value="@if(isset($request['titulo'])) {{$request['titulo']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="resumo" class="col-sm-3 control-label">Resumo:</label>
                    <div class="col-sm-9">
                        <textarea rows="3" class="form-control" name="resumo">@if(isset($request['resumo'])) {{$request['resumo']}} @endif</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="url" class="col-sm-3 control-label">URL de acesso:</label>
                    <div class="col-sm-9">
                        <input name="url" type="text" value="@if(isset($request['url'])) {{$request['url']}} @endif" class="form-control" placeholder="exemplo-de-url" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="data" class="col-sm-3 control-label">Data:</label>
                    <div class="col-sm-9">
                        <input name="data" type="date" value="@if(isset($request['data'])) {{$request['data']}} @endif" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imegem" class="col-sm-3 control-label">Imagem (capa):</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input class="form-control" name="imagem" id="imagem" type="file" value="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" onclick="javascript:document.getElementById('imagem').click()"><i class="fa fa-file"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="conteudo" class="control-label">Conteúdo:</label>
                    <div class="col-sm-12">
                        <textarea class="form-control input-lg editor" name="conteudo">@if(isset($request['conteudo'])) {{$request['conteudo']}} @endif</textarea>
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
</div>
@endsection
