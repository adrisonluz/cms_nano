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
            <h1>Banners</h1>
        </div>

        <div class="col-lg-2">
            <BR>
            <a href="{{ route('cms.banners.create') }}" class="btn btn-default btn-success">Novo registro</a>
        </div>


        <div style="clear:both; height: 25px"></div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordded">
                    <thead>
                    <td width="7%">Ação</td>
                    <td>ID</td>
                    <td>Título</td>
                    <td>Página</td>
                    <td>Tipo</td>
                    <td>Ordem</td>
                    <td>Data Ini</td>
                    <td>Data Fim</td>
                    <td>Ativo</td>
                    </thead>


                    @foreach ($banners as $banner)
                    <tr>
                        <td>
                            <a href="{{ route('cms.banners.edit', ['id' => $banner->id]) }}" title="Editar">
                                <button type="button" class="btn btn-primary btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                                </button>
                            </a>

                            <a href="{{ route('cms.banners.lixeira', ['id' => $banner->id]) }}" title="Descartar">
                                <button type="button" class="btn btn-danger btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                </button>
                            </a>
                        </td>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->titulo }}</td>
                        <td>{{ $banner->pagina->titulo }}</td>
                        <td>{{ $banner->tipo }}</td>
                        <td>{{ $banner->ordem }}</td>
                        <td>{{ $banner->data_ini }}</td>
                        <td>{{ $banner->data_fim }}</td>
                        <td>{{ $banner->ativo }}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        {!! $banners->links() !!}

    </div>


</div>


@endsection
