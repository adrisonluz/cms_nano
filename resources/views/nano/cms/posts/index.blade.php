@extends('nano.layout')


@section('content')
<div class="container">
    @if(isset($mensagem))
    <ul class="alert {{ $mensagem['class'] }}">
        <li>{{ $mensagem['text'] }}</li>
    </ul>
    @endif

    <div class="row">
        <div class="col-lg-9">
            <h1>Posts</h1>
        </div>

        <div class="col-lg-3">
            <BR>
            <a href="{{ route('nano.cms.posts.create') }}" class="btn btn-default btn-success">Novo registro</a>
            <a href="{{ route('nano.cms.categorias.index') }}" class="btn btn-default btn-primary">Categorias</a>
        </div>


        <div style="clear:both; height: 25px"></div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordded">
                    <thead>
                    <td width="7%">Ação</td>
                    <td>ID</td>
                    <td>Título</td>
                    <td>Categoria</td>
                    <td>URL</td>
                    <td>Destaque</td>
                    <!--td>Data</td-->
                    <td>Ativo</td>
                    <td>Ordem</td>
                    </thead>


                    @foreach ($posts as $post)
                    <tr>
                        <td>
                            <a href="{{ route('nano.cms.posts.edit', ['id' => $post->id]) }}" title="Editar">
                                <button type="button" class="btn btn-primary btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                                </button>
                            </a>

                            <a href="{{ route('nano.cms.posts.lixeira', ['id' => $post->id]) }}" title="Descartar">
                                <button type="button" class="btn btn-danger btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                </button>
                            </a>
                        </td>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->titulo }}</td>
                        <td>{{ $post->categoria->titulo or 'nenhuma' }}</td>
                        <td>{{ $post->url }}</td>
                        <td>{{ $post->destaque }}</td>
                        <!--td>{{ $post->data }}</td-->
                        <td>{{ $post->ativo }}</td>
                        <td>{{ $post->ordem }}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        {!! $posts->links() !!}

    </div>


</div>


@endsection
