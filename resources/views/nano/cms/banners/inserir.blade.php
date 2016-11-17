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
            <h1>Banners / Inserir</h1>
        </div>

        <form name="frm" action="{{ route("nano.cms.banners.store")}}" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="titulo" class="col-sm-3 control-label">Título:</label>
                    <div class="col-sm-9">
                        <input name="titulo" type="text" value="@if(isset($request['titulo'])) {{$request['titulo']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="conteudo" class="col-sm-3 control-label">Conteudo:</label>
                    <div class="col-sm-9">
                        <textarea rows="3" class="form-control" name="conteudo">@if(isset($request['conteudo'])) {{$request['conteudo']}} @endif</textarea>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label for="pagina_id" class="col-sm-3 control-label">Página:</label>
                    <div class="col-sm-9">
                        <select name="pagina_id" class="form-control">
                            <option value="0">Todas</option>
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
                            <option value="banner"  @if(isset($request)) {{ $request['tipo'] == 'banner' ? 'selected=selected' : '' }} @endif>Banner</option>
                            <option value="modal"  @if(isset($request)) {{ $request['tipo'] == 'modal' ? 'selected=selected' : '' }} @endif>Modal</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="data" class="col-sm-3 control-label">Data Inicio:</label>
                    <div class="col-sm-9">
                        <input name="data_ini" type="date" value="@if(isset($request['data_ini'])) {{$request['data_ini']}} @endif" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="data" class="col-sm-3 control-label">Data Fim:</label>
                    <div class="col-sm-9">
                        <input name="data_fim" type="date" value="@if(isset($request['data_fim'])) {{$request['data_fim']}} @endif" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="link" class="col-sm-3 control-label">Link:</label>
                    <div class="col-sm-9">
                        <input name="link" type="text" placeholder="Link externo" value="@if(isset($request['link'])) {{$request['link']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagem" class="col-sm-3 control-label">Imagem:</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input class="form-control" name="imagem" id="imagem" type="file" value="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" onclick="javascript:document.getElementById('imagem').click()"><i class="fa fa-file"></i></button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="video" class="col-sm-3 control-label">Video:</label>
                        <div class="col-sm-9">
                            <input name="video" type="text" placeholder="Link do Youtube" value="@if(isset($request['video'])) {{$request['video']}} @endif" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="link" class="col-sm-3 control-label">Ordem:</label>
                    <div class="col-sm-9">
                        <input name="ordem" type="number" value="@if(isset($request['ordem'])) {{$request['ordem']}} @endif" class="form-control">
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
