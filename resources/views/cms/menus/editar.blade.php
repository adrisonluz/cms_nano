@extends('layouts.nano.app')
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
            <h1>Menus / Editar</h1>
        </div>

        <form name="frm" action="{{ route("cms.menus.update", ["id"=> $menu->id ])}}" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="titulo" class="col-sm-3 control-label">Título:</label>
                    <div class="col-sm-9">
                        <input name="titulo" type="text" value="{{ $menu->titulo }}" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">                
                <div class="form-group">
                    <label for="tipo" class="col-sm-3 control-label">Tipo:</label>
                    <div class="col-sm-9">
                        <select name="tipo" class="form-control">
                            <option value="">Selecione um:</option>
                            <option value="top" {{ $menu->tipo == 'top' ? 'selected=selected' : '' }}>Top</option>
                            <option value="bottom" {{ $menu->tipo == 'bottom' ? 'selected=selected' : '' }}>Bottom</option>
                            <option value="lateral" {{ $menu->tipo == 'lateral' ? 'selected=selected' : '' }}>Lateral</option>
                            <option value="sitemap" {{ $menu->tipo == 'sitemap' ? 'selected=selected' : '' }}>Sitemap</option>
                        </select>
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
