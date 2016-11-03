@extends('layouts.nano.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(isset($mensagem))
            <ul class="alert {{ $mensagem['class'] }}">
                <li>{{ $mensagem['text'] }}</li>
            </ul>
            @endif

            <div class="panel panel-danger">
                <div class="panel-heading">Erro</div>

                <div class="panel-body">
                    <p class="text-danger">{{ $erroMensagem }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
