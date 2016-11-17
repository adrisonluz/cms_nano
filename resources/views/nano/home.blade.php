@extends('nano.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(isset($mensagem))
            <ul class="alert {{ $mensagem['class'] }}">
                <li>{{ $mensagem['text'] }}</li>
            </ul>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                @if (session('mensagem'))
                <div class="alert alert-success">
                    {{ session('mensagem') }}
                </div>
                @endif

                <div class="panel-body">
                    Seja bem vindo {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
