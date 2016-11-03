@extends('layouts.nano.app')
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
            <h1>Usuários / Inserir</h1>
        </div>

        <form name="frm" action="{{ route("cms.usuarios.store")}}" method="post" >
            <div class="col-md-6">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Nome:</label>
                    <div class="col-sm-9">
                        <input name="name" type="text" value="@if(isset($request['name'])) {{$request['name']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">E-mail:</label>
                    <div class="col-sm-9">
                        <input name="email" type="email" value="@if(isset($request['email'])) {{$request['email']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="telefone" class="col-sm-3 control-label">Telefone:</label>
                    <div class="col-sm-9">
                        <input name="telefone" type="tel" value="@if(isset($request['telefone'])) {{$request['telefone']}} @endif" class="formFone form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="celular" class="col-sm-3 control-label">Celular:</label>
                    <div class="col-sm-9">
                        <input name="celular" type="tel" value="@if(isset($request['celular'])) {{$request['celular']}} @endif" class="formFone form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="login" class="col-sm-3 control-label">Login:</label>
                    <div class="col-sm-9">
                        <input name="login" type="text" value="@if(isset($request['login'])) {{$request['login']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Senha:</label>
                    <div class="col-sm-9">
                        <input name="password" type="password" value="" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="passwordc" class="col-sm-3 control-label">Repita a senha:</label>
                    <div class="col-sm-9">
                        <input name="password_confirmation" type="password" value="" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagem" class="col-sm-3 control-label">Imagem:</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input class="form-control" name="foto" type="text" value="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" id="btn-camera" data-toggle="modal" data-target="#modalCamera"><i class="fa fa-camera"></i></button>
                            </span>
                        </div>
                        <p class="text-danger">Clique na câmera e depois em 'ok' para tirar uma foto.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="preview" class="col-sm-3 control-label">Preview:</label>
                    <div class="col-sm-9">
                        <div id="imagem-preview"><canvas id="canvas" width="400" height="300"></canvas></div>
                        <input type="hidden" name="codImagem" value="@if(isset($request['codImagem'])) {{$request['codImagem']}} @endif">
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="rg" class="col-sm-3 control-label">Nascimento:</label>
                    <div class="col-sm-9">
                        <input name="nascimento" type="text" value="@if(isset($request['nascimento'])) {{$request['nascimento']}} @endif" class="formDate form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="rg" class="col-sm-3 control-label">RG:</label>
                    <div class="col-sm-9">
                        <input name="rg" type="text" value="@if(isset($request['rg'])) {{$request['rg']}} @endif" class="formRG form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="cpf" class="col-sm-3 control-label">CPF:</label>
                    <div class="col-sm-9">
                        <input name="cpf" type="text" value="@if(isset($request['cpf'])) {{$request['cpf']}} @endif" class="formCPF form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="endereco" class="col-sm-3 control-label">Endereço:</label>
                    <div class="col-sm-9">
                        <input name="endereco" type="text" value="@if(isset($request['endereco'])) {{$request['endereco']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="bairro" class="col-sm-3 control-label">Bairro:</label>
                    <div class="col-sm-9">
                        <input name="bairro" type="text" value="@if(isset($request['bairro'])) {{$request['bairro']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="cidade" class="col-sm-3 control-label">Cidade:</label>
                    <div class="col-sm-9">
                        <input name="cidade" type="text" value="@if(isset($request['cidade'])) {{$request['cidade']}} @endif" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="cep" class="col-sm-3 control-label">CEP:</label>
                    <div class="col-sm-4">
                        <input name="cep" type="text" value="@if(isset($request['cep'])) {{$request['cep']}} @endif" class="formCEP form-control" />
                    </div>
                    <label for="uf" class="col-sm-1 control-label">UF:</label>
                    <div class="col-sm-4">
                        <select name="uf" class="form-control">
                            <option value="">Selecione</option>
                            <option value="AC" {{ $request['uf'] == 'AC' ? 'selected=selected' : '' }} >AC</option>
                            <option value="AL" {{ $request['uf'] == 'AL' ? 'selected=selected' : '' }} >AL</option>
                            <option value="AM" {{ $request['uf'] == 'AM' ? 'selected=selected' : '' }} >AM</option>
                            <option value="AP" {{ $request['uf'] == 'AP' ? 'selected=selected' : '' }} >AP</option>
                            <option value="BA" {{ $request['uf'] == 'BA' ? 'selected=selected' : '' }} >BA</option>
                            <option value="CE" {{ $request['uf'] == 'CE' ? 'selected=selected' : '' }} >CE</option>
                            <option value="DF" {{ $request['uf'] == 'DF' ? 'selected=selected' : '' }} >DF</option>
                            <option value="ES" {{ $request['uf'] == 'ES' ? 'selected=selected' : '' }} >ES</option>
                            <option value="GO" {{ $request['uf'] == 'GO' ? 'selected=selected' : '' }} >GO</option>
                            <option value="MA" {{ $request['uf'] == 'MA' ? 'selected=selected' : '' }} >MA</option>
                            <option value="MG" {{ $request['uf'] == 'MG' ? 'selected=selected' : '' }} >MG</option>
                            <option value="MS" {{ $request['uf'] == 'MS' ? 'selected=selected' : '' }} >MS</option>
                            <option value="MT" {{ $request['uf'] == 'MT' ? 'selected=selected' : '' }} >MT</option>
                            <option value="PA" {{ $request['uf'] == 'PA' ? 'selected=selected' : '' }} >PA</option>
                            <option value="PB" {{ $request['uf'] == 'PB' ? 'selected=selected' : '' }} >PB</option>
                            <option value="PE" {{ $request['uf'] == 'PE' ? 'selected=selected' : '' }} >PE</option>
                            <option value="PI" {{ $request['uf'] == 'PI' ? 'selected=selected' : '' }} >PI</option>
                            <option value="PR" {{ $request['uf'] == 'PR' ? 'selected=selected' : '' }} >PR</option>
                            <option value="RJ" {{ $request['uf'] == 'RJ' ? 'selected=selected' : '' }} >RJ</option>
                            <option value="RN" {{ $request['uf'] == 'RN' ? 'selected=selected' : '' }} >RN</option>
                            <option value="RS" {{ $request['uf'] == 'RS' ? 'selected=selected' : '' }} >RS</option>
                            <option value="RO" {{ $request['uf'] == 'RO' ? 'selected=selected' : '' }} >RO</option>
                            <option value="RR" {{ $request['uf'] == 'RR' ? 'selected=selected' : '' }} >RR</option>
                            <option value="SC" {{ $request['uf'] == 'SC' ? 'selected=selected' : '' }} >SC</option>
                            <option value="SE" {{ $request['uf'] == 'SE' ? 'selected=selected' : '' }} >SE</option>
                            <option value="SP" {{ $request['uf'] == 'SP' ? 'selected=selected' : '' }} >SP</option>
                            <option value="TO" {{ $request['uf'] == 'TO' ? 'selected=selected' : '' }} >TO</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nivel" class="col-sm-3 control-label">Nível:</label>
                    <div class="col-sm-9">
                        <select name="nivel" class="form-control">
                            <option value="">Selecione um:</option>
                            @if(count($niveis) > 0)
                            @foreach($niveis as $nivel)
                            <option value="{{ $nivel->id }}"  {{ $usuario->nivel == $request['nivel'] ? 'selected=selected' : '' }} >{{ $nivel->nivel }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="observacoes" class="col-sm-3 control-label">Observações:</label>
                    <div class="col-sm-9">
                        <textarea rows="4" class="form-control" name="observacoes">@if(isset($request['observacoes'])) {{$request['observacoes']}} @endif</textarea>
                    </div>
                </div>

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

<!-- Modal Câmera -->
<div class="modal fade" id="modalCamera" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">×</span></button>
                <h3 class="box-title">Preview</strong></h3>
            </div>
            <div class="modal-body">
                <video id="video" autoplay></video>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary btn-block" id="okFoto" data-dismiss="modal" value="ok"><b>OK</b></a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
