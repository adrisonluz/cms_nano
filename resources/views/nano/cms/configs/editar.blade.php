@extends('nano.layout')
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

        <form name="frm" action="{{ route("nano.cms.configs.update")}}" method="post" >
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
                <div class="form-group">
                    <label for="mailresp" class="col-sm-12 control-label text-capitalize">Resposta automática:</label>
                    <div class="col-sm-12">
                        <textarea rows="15" class="form-control editor" name="mailresp">{{ $configs['mailresp'] }}</textarea>
                    </div>
                </div>
            </div>
            <br>
            <div class="clearfix"></div>
            <br><br>
            <div class="panel panel-default">
                <div class="panel-heading col-md-12">
                    <div class="">
                        <h4>Controle de acesso</h4>
                        <small>Selecione os níveis que podem gerenciar as áreas do CMS. Para deixar uma área totalmente acessível, basta não selecionar nenhum nivel no campo correspondente.</small>
                    </div>
                </div>
          
                <div class="panel-body ctrlAcessos">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Usuários:</label>
                            <div class="col-sm-8">
                                <select name="accessUsers[]" class="form-control select2" multiple >
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessUsers'])) {{ in_array($nivel->id, $acessos['accessUsers']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Páginas:</label>
                            <div class="col-sm-8">
                                <select name="accessPages[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessPages'])) {{ in_array($nivel->id, $acessos['accessPages']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Menus:</label>
                            <div class="col-sm-8">
                                <select name="accessMenus[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessMenus'])) {{ in_array($nivel->id, $acessos['accessMenus']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Formulários:</label>
                            <div class="col-sm-8">
                                <select name="accessForms[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessForms'])) {{ in_array($nivel->id, $acessos['accessForms']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Banners:</label>
                            <div class="col-sm-8">
                                <select name="accessBanners[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessBanners'])) {{ in_array($nivel->id, $acessos['accessBanners']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Agenda:</label>
                            <div class="col-sm-8">
                                <select name="accessAgenda[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessAgenda'])) {{ in_array($nivel->id, $acessos['accessAgenda']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Categorias:</label>
                            <div class="col-sm-8">
                                <select name="accessCategorias[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessCategorias'])) {{ in_array($nivel->id, $acessos['accessCategorias']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Blocos:</label>
                            <div class="col-sm-8">
                                <select name="accessBlocos[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessBlocos'])) {{ in_array($nivel->id, $acessos['accessBlocos']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Posts:</label>
                            <div class="col-sm-8">
                                <select name="accessPosts[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessPosts'])) {{ in_array($nivel->id, $acessos['accessPosts']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">SEO:</label>
                            <div class="col-sm-8">
                                <select name="accessSEO[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessSEO'])) {{ in_array($nivel->id, $acessos['accessSEO']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Galerias:</label>
                            <div class="col-sm-8">
                                <select name="accessGalerias[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessGalerias'])) {{ in_array($nivel->id, $acessos['accessGalerias']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="acesso" class="col-sm-4 control-label text-capitalize">Configurações:</label>
                            <div class="col-sm-8">
                                <select name="accessConfigs[]" class="form-control select2" multiple>
                                    <option value="">Selecione quantos forem necessários:</option>
                                    @if(count($niveis) > 0)
                                    @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"  @if(isset($acessos['accessConfigs'])) {{ in_array($nivel->id, $acessos['accessConfigs']) ? 'selected=selected' : '' }} @endif>{{ $nivel->nivel }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <h4>Niveis</h4>    
                    </div>
                    
                    <div class="col-xs-6 divNiveis">
                        @if(count($niveis) > 0)
                        @foreach($niveis as $nivel)
                        <div class="col-sm-4">
                            <a href="{{ route('nivel.lixeira', ['id' => $nivel->id]) }}" rel="{{ $nivel->id }}" data-toggle="modal" data-target="#modaNiveis" title="Descartar" class="nivelDelete">
                                <button type="button" class="btn btn-danger btn-xs ">
                                    <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                </button>
                            </a>
                            <span text=""> &nbsp; {{$nivel->nivel}}</span>
                        </div>
                        @endforeach
                        @else
                        <p class="text-danger">Não há níveis cadastrados no <sistema class=""></sistema></p>
                        @endif
                    </div>

                    <div class="col-xs-6">
                        <label for="imagem" class="col-sm-4 control-label">Novo:</label>
                        <div class="col-sm-8">
                            <div class="input-group input-group-sm">
                                <input class="form-control inputNivel" name="nivel" type="text" value="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" id="btnNivel" data-toggle="modal" data-target="#modaNiveis"><i class="fa fa-save"></i></button>
                                </span>
                            </div>
                        </div>
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

<!-- Modal Niveis -->
<div class="modal fade" id="modalNiveis" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="box-title">Niveis</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">×</span></button>
                </h3>
            </div>
            <div class="modal-body row text-center">
                    
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->