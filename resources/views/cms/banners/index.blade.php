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
            <h1>Páginas</h1>
        </div>

        <div class="col-lg-2">
            <BR>
            <a href="{{ route('cms.paginas.create') }}" class="btn btn-default btn-success">Novo registro</a>
        </div>


        <div style="clear:both; height: 25px"></div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordded">
                    <thead>
                    <td width="7%">Ação</td>
                    <td>ID</td>
                    <td>Título</td>
                    <td>Resumo</td>
                    <td>URL</td>
                    <td>Ativo</td>
                    <td>Data</td>
                    </thead>


                    @foreach ($paginas as $pagina)
                    <tr>
                        <td>
                            <a href="{{ route('cms.paginas.edit', ['id' => $pagina->id]) }}" title="Editar">
                                <button type="button" class="btn btn-primary btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                                </button>
                            </a>

                            <a href="{{ route('cms.paginas.lixeira', ['id' => $pagina->id]) }}" title="Descartar">
                                <button type="button" class="btn btn-danger btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                </button>
                            </a>
                        </td>
                        <td>{{ $pagina->id }}</td>
                        <td>{{ $pagina->titulo }}</td>
                        <td>{{ $pagina->resumo }}</td>
                        <td>{{ $pagina->url }}</td>
                        <td>{{ $pagina->ativo }}</td>
                        <td>{{ $pagina->data }}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        {!! $paginas->links() !!}

    </div>


</div>


@endsection
