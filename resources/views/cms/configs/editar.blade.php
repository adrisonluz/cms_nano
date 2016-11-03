@extends('layouts.nano.app')
@section('content')

<div class="container">
    @if(isset($mensagem))
    <ul class="alert {{ $mensagem['class'] }}">
        <li>{{ $mensagem['text'] }}</li>
    </ul>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h1>Configurações / Editar</h1>
        </div>

        @if ($errors->any())
        <ul class="alert alert-warning">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form name="frm" action="{{ route("cms.configs.update")}}" method="post" >
            <div class="col-md-6">
                {{ csrf_field() }}
                <h4>Dados do site</h4>
                <div class="form-group">
                    <label for="sitename" class="col-sm-4 control-label text-capitalize">Nome do site:</label>
                    <div class="col-sm-8">
                        <input name="sitename" type="text" value="{{ $configs['sitename'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sitedesc" class="col-sm-4 control-label text-capitalize">Descrição do site:</label>
                    <div class="col-sm-8">
                        <input name="sitedesc" type="text" value="{{ $configs['sitedesc'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="endereco" class="col-sm-4 control-label text-capitalize">Endereço:</label>
                    <div class="col-sm-8">
                        <input name="endereco" type="text" value="{{ $configs['endereco'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="base" class="col-sm-4 control-label text-capitalize">Base / Domínio:</label>
                    <div class="col-sm-8">
                        <input name="base" type="text" value="{{ $configs['base'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefone" class="col-sm-4 control-label text-capitalize">Telefone:</label>
                    <div class="col-sm-8">
                        <input name="telefone" type="text" value="{{ $configs['telefone'] }}" class="form-control formFone">
                    </div>
                </div>
                <br>
                <h4>Configurações de painel</h4>
                <div class="form-group">
                    <label for="imgprincipal" class="col-sm-4 control-label text-capitalize">Imagem principal:</label>
                    <div class="col-sm-8">
                        <input name="imgprincipal" type="text" value="{{ $configs['imgprincipal'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="qntmenulist" class="col-sm-4 control-label text-capitalize">Qnt Menu:</label>
                    <div class="col-sm-8">
                        <input name="qntmenulist" type="number" value="{{ $configs['qntmenulist'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="qntdestlist" class="col-sm-4 control-label text-capitalize">Qnt Destaques:</label>
                    <div class="col-sm-8">
                        <input name="qntdestlist" type="number" value="{{ $configs['qntdestlist'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="qntpostlist" class="col-sm-4 control-label text-capitalize">Qnt Posts:</label>
                    <div class="col-sm-8">
                        <input name="qntpostlist" type="number" value="{{ $configs['qntpostlist'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pagpost" class="col-sm-4 control-label text-capitalize">Páginas:</label>
                    <div class="col-sm-8">
                        <input name="pagpost" type="number" value="{{ $configs['pagpost'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pagpaginas" class="col-sm-4 control-label text-capitalize">Paginador:</label>
                    <div class="col-sm-8">
                        <input name="pagpaginas" type="number" value="{{ $configs['pagpaginas'] }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h4>Configurações de email</h4>
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label text-capitalize">Email:</label>
                    <div class="col-sm-8">
                        <input name="email" type="email" value="{{ $configs['email'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mailuser" class="col-sm-4 control-label text-capitalize">Usuário Email:</label>
                    <div class="col-sm-8">
                        <input name="mailuser" type="text" value="{{ $configs['mailuser'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mailpass" class="col-sm-4 control-label text-capitalize">Senha Email:</label>
                    <div class="col-sm-8">
                        <input name="mailpass" type="text" value="{{ $configs['mailpass'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mailport" class="col-sm-4 control-label text-capitalize">Porta Email:</label>
                    <div class="col-sm-8">
                        <input name="mailport" type="text" value="{{ $configs['mailport'] }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mailhost" class="col-sm-4 control-label text-capitalize">Host Email:</label>
                    <div class="col-sm-8">
                        <input name="mailhost" type="text" value="{{ $configs['mailhost'] }}" class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="mailresp" class="col-sm-12 control-label text-capitalize">Resposta automática:</label>
                    <div class="col-sm-12">
                        <textarea rows="10" class="form-control editor" name="mailresp">{{ $configs['mailresp'] }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="pull-right ">
                        <br>
                        <a href="javascript:history.back(-1)">
                            <button type="button" class="btn btn-default">Voltar</button>
                        </a>
                        <button type="submit"  class="btn btn-primary">SALVAR</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
/