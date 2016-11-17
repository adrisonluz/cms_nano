@extends('nano.layout')


@section('content')
<div class="container">
    @if(isset($mensagem))
    <ul class="alert {{ $mensagem['class'] }}">
        <li>{{ $mensagem['text'] }}</li>
    </ul>
    @endif

    <div class="row">
        <div class="col-lg-10">
            <h1>Configurações</h1>
        </div>

        <div style="clear:both; height: 25px"></div>
        <div class="container">
            <h3>Muito cuidado ao editar as configurações do sistema, pois isto poderá levar ao mal funcionamento ou até mesmo em
                perda total do sistema. Além de erros ou perda de dados.</h3>
            <h3>Tenha certeza do que irá ajustar antes de prosseguir.</h3>
            <div class="row">
                <br>
                <div class="text-center">
                    <a href="javascript:history.back(-1)">
                        <button type="button" class="btn btn-default">Voltar</button>
                    </a>
                    <a href="{{ route("nano.cms.configs.edit") }}">
                        <button type="button" class="btn btn-danger">Prosseguir</button>
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection
