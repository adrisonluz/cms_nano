@extends('layouts.nano.app')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-10">
            <h1>Usuários</h1>
        </div>

        <div class="col-lg-2">
            <BR>
            <a href="{{ route('usuario.create') }}" class="btn btn-default btn-success">Novo registro</a>
        </div>


        <div style="clear:both; height: 25px"></div>
        <table class="table table-striped table-bordded">
            <thead>
            <td width="7%">Ação</td>
            <td>Nome</td>
            <td>E-mail</td>
            <td>Nascimento</td>
            <td>Telefone</td>
            <td>Celular</td>
            <td>Nivel</td>
            </thead>


            @foreach ($usuarios as $user)
            <tr>
                <td>
                    <a href="{{ route('usuario.edit', ['id' => $user->id]) }}" title="Editar">
                        <button type="button" class="btn btn-primary btn-xs ">
                            <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                        </button>
                    </a>

                    <a href="{{ route('usuario.lixeira', ['id' => $user->id]) }}" title="Descartar">
                        <button type="button" class="btn btn-danger btn-xs ">
                            <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                        </button>
                    </a>
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->nascimento }}</td>
                <td>{{ $user->telefone }}</td>
                <td>{{ $user->celular }}</td>
                <td>{{ $user->nivel }}</td>
            </tr>
            @endforeach

        </table>

        {!! $usuarios->links() !!}

    </div>


</div>


@endsection
