@extends('nano.layout')
@section('content')

<div class="container">
    @if(isset($mensagem))
    <ul class="alert {{ $mensagem['class'] }}">
        <li>{{ $mensagem['text'] }}</li>
    </ul>
    @endif

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h1>Menus / Editar</h1>
        </div>

        <form name="frm" action="{{ route("nano.cms.menus.update", ["id"=> $menu->id ])}}" method="post" enctype="multipart/form-data">
            <div class="col-md-5">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="titulo" class="col-sm-3 control-label">Título:</label>
                    <div class="col-sm-9">
                        <input name="titulo" type="text" value="{{ $menu->titulo }}" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="col-md-5">                
                <div class="form-group">
                    <label for="tipo" class="col-sm-3 control-label">Tipo:</label>
                    <div class="col-sm-9">
                        <select name="tipo" class="form-control">
                            <option value="">Selecione um:</option>
                            <option value="top" {{ $menu->tipo == 'top' ? 'selected=selected' : '' }}>Top</option>
                            <option value="bottom" {{ $menu->tipo == 'bottom' ? 'selected=selected' : '' }}>Bottom</option>
                            <option value="lateral" {{ $menu->tipo == 'lateral' ? 'selected=selected' : '' }}>Lateral</option>
                            <option value="sitemap" {{ $menu->tipo == 'sitemap' ? 'selected=selected' : '' }}>Sitemap</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <a href="javascript:history.back(-1)">
                        <button type="button" class="btn btn-default">Voltar</button>
                    </a>
                    <button type="submit"  class="btn btn-primary">SALVAR</button>
                </div>
            </div>
        </form>
    
            <div class="clearfix"></div>

            <div class="panel panel-default">
                <div class="panel-heading col-md-12">
                    <div class="">
                        <h4>Itens de menu</h4>
                        <small>Adicione itens e/ou sub-itens ao menu. Crie links simples no menu ou menus estilo drop-down "linkando" sub-itens à outro sub-item pai. Para adicionar links internos do site, lembre-se de comoçar sempre com uma barra "/", exemplo: "/exemplo-de-url". Caso o link seja para a home do site, insira somente a barra "/". Para links externos, inserir o endereço absoluto do destino, exemplo: "http://exemplo.com/teste".</small>
                    </div>
                </div>
          
                <div class="panel-body">
                    <form class="menus-itens" action="{{ route("nano.cms.menus-itens.store") }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <input type="hidden" name="editId" value="">
                        <table class="table table-striped table-bordded">
                            <thead>
                                <td>Ação</td>
                                <td>Titulo</td>
                                <td>Link</td>
                                <td>Tipo</td>
                                <td>Ativo</td>
                            </thead>
                            @if(count($menu->itens) > 0)
                            @foreach($menu->itens as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('nano.cms.menus-itens.edit', ['id' => $item->id]) }}" title="Editar" class="editar" rel="{{ $item->id }}">
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>
                                        </button>
                                    </a>

                                    <a href="{{ route('nano.cms.menus-itens.lixeira', ['id' => $item->id]) }}" title="Descartar" class="delete" rel="{{ $item->id }}">
                                        <button type="button" class="btn btn-danger btn-xs">
                                            <span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>
                                        </button>
                                    </a>
                                </td>
                                <td class="titulo">{{ $item->titulo }}</td>
                                <td class="link">{{ $item->link }}</td>
                                <td class="tipo" rel="{{ $item->menupai_id }}">{{ ($item->menupai_id == 0 ? 'item' : 'sub-item' ) }}</td>
                                <td class="ativo" rel="{{ $item->ativo }}">{{ $item->ativo }}</td>
                            </tr>
                            @endforeach
                            @endif
                            <tr>
                                <td colspan="5" class="separator">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5"><strong>Novo item de menu:</strong></td>
                            </tr>
                            <tfoot>
                                <td><button type="submit"  class="btn btn-primary enviar"><i class="fa fa-save"></i></button></td>
                                <td><input name="titulo" type="text" value="" class="form-control" ></td>
                                <td><input name="link" type="text" value="" class="form-control" ></td>
                                <td>
                                    <select name="tipo" class="form-control">
                                        <option value="item">Item</option> 
                                        @if(count($menu->itens) > 0)
                                        <optgroup label="Sub-item de:">
                                            @foreach($menu->itens as $item)
                                            <option value="{{ $item->id }}">{{ $item->titulo }}</option>
                                            @endforeach                                      
                                        </optgroup>    
                                        @endif                                     
                                    </select>
                                </td>
                                <td>
                                    <select name="ativo" class="form-control">
                                        <option value="sim">Sim</option> 
                                        <option value="não">Não</option>                          
                                    </select>
                                </td>
                            </tfoot>
                        </table>
                    </form>      
                </div>
            </div>
    </div>
</div>
@endsection

<!-- Modal Niveis -->
<div class="modal fade" id="modalMenusItens" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="box-title">Itens de menu</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">×</span></button>
                </h3>
            </div>
            <div class="modal-body row text-center">
                    
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->