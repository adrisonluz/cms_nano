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
            <h1>Categorias</h1>
        </div>

        <div class="col-lg-2">
            <BR>
            <a href="{{ route('nano.cms.categorias.create') }}" class="btn btn-default btn-success">Novo registro</a>
            <a href="{{ route('nano.cms.posts.index') }}" class="btn btn-default btn-primary">Posts</a>
        </div>


        <div style="clear:both; height: 25px"></div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordded">
                    <thead>
                    <td width="7%">Ação</td>
                    <td>ID</td>
                    <td>Título</td>
                    <td>Url</td>
                    <td>Ativo</td>
                    <td>Ordem</td>
                    </thead>


                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>
                            <a href="{{ route('nano.cms.categorias.edit', ['id' => $categoria->id]) }}" title="Editar">
                                <button type="button" class="btn btn-primary btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                                </button>
                            </a>

                            <a href="{{ route('nano.cms.categorias.lixeira', ['id' => $categoria->id]) }}" title="Descartar">
                                <button type="button" class="btn btn-danger btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                </button>
                            </a>
                        </td>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->titulo }}</td>
                        <td>{{ $categoria->url }}</td>
                        <td>{{ $categoria->ativo }}</td>
                        <td>{{ $categoria->ordem }}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        {!! $categorias->links() !!}

    </div>


</div>


@endsection
