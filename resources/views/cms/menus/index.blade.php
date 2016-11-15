@extends('layouts.nano.app')


@section('content')
<div class="container">
    @if(isset($mensagem))
    <ul class="alert {{ $mensagem['class'] }}">
        <li>{{ $mensagem['text'] }}</li>
    </ul>
    @endif

    <div class="row">
        <div class="col-lg-10">
            <h1>Menus</h1>
        </div>

        <div class="col-lg-2">
            <BR>
            <a href="{{ route('cms.menus.create') }}" class="btn btn-default btn-success">Novo registro</a>
        </div>


        <div style="clear:both; height: 25px"></div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordded">
                    <thead>
                    <td width="7%">Ação</td>
                    <td>ID</td>
                    <td>Título</td>
                    <td>Tipo</td>
                    <td>Ativo</td>
                    </thead>


                    @foreach ($menus as $menu)
                    <tr>
                        <td>
                            <a href="{{ route('cms.menus.edit', ['id' => $menu->id]) }}" title="Editar">
                                <button type="button" class="btn btn-primary btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                                </button>
                            </a>

                            <a href="{{ route('cms.menus.lixeira', ['id' => $menu->id]) }}" title="Descartar">
                                <button type="button" class="btn btn-danger btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                </button>
                            </a>
                        </td>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->titulo }}</td>
                        <td>{{ $menu->tipo }}</td>
                        <td>{{ $menu->ativo }}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        {!! $menus->links() !!}

    </div>


</div>


@endsection
