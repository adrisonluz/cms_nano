@extends('layouts.app')

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
            <table class="table table-striped">
                <thead>

                    <td width="7%">Ação</td>
                    <td>Nome</td>
                    <td>E-mail</td>

                </thead>


            @foreach ($usuarios as $user)

                <tr>
                    <td>
                        <a href="<?=route('usuario.edit', ['id' => $user->id]);?>">

                            <button type="button" class="btn btn-default btn-xs ">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </button>

                        </a>

                        <a href="<?=route('usuario.delete', ['id' =>  $user->id]);?>">
                            <button type="button" class="btn btn-default btn-xs ">
                                <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                            </button>
                        </a>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach

            </table>

            {!! $usuarios->links() !!}

        </div>


    </div>


@endsection
