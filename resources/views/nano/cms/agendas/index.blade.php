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
            <h1>Agenda</h1>
        </div>

        <div class="col-lg-2">
            <BR>
            <a href="{{ route('nano.cms.agendas.create') }}" class="btn btn-default btn-success">Novo registro</a>
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
                    <td>Data Ini</td>
                    <td>Data Fim</td>
                    <td>Ativo</td>
                    </thead>


                    @foreach ($agendas as $agenda)
                    <tr>
                        <td>
                            <a href="{{ route('nano.cms.agendas.edit', ['id' => $agenda->id]) }}" title="Editar">
                                <button type="button" class="btn btn-primary btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                                </button>
                            </a>

                            <a href="{{ route('nano.cms.agendas.lixeira', ['id' => $agenda->id]) }}" title="Descartar">
                                <button type="button" class="btn btn-danger btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                </button>
                            </a>
                        </td>
                        <td>{{ $agenda->id }}</td>
                        <td>{{ $agenda->titulo }}</td>
                        <td>{{ $agenda->url }}</td>
                        <td>{{ $agenda->data_ini }}</td>
                        <td>{{ $agenda->data_fim }}</td>
                        <td>{{ $agenda->ativo }}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        {!! $agendas->links() !!}

    </div>


</div>


@endsection
