@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1>Usuários / Inserir</h1>
            </div>

            <div style="clear:both; height: 25px"></div>

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
            </ul>
            @endif

            <form name="frm" action="{{ route("usuario.store")}}" method="post" >

                {{ csrf_field() }}

                <div class="form-group">

                    <label for="name" class="col-sm-2 control-label">Nome:</label>

                    <div class="col-sm-10">
                        <input name="name" type="text" value="" class="form-control" />
                    </div>

                </div>

                <div style="clear: both; height: 25px;"></div>

                <div class="form-group">

                    <label for="email" class="col-sm-2 control-label">E-mail:</label>

                    <div class="col-sm-10">
                        <input name="email" type="email" value="" class="form-control" />
                    </div>

                </div>


                <div style="clear: both; height: 25px;"></div>

                <div class="form-group">

                    <label for="password" class="col-sm-2 control-label">Senha:</label>

                    <div class="col-sm-10">
                        <input name="password" type="password" value="" class="form-control" />
                    </div>

                </div>


                <div style="clear: both; height: 25px;"></div>

                <div class="form-group">

                    <label for="passwordc" class="col-sm-2 control-label">Confirme a senha:</label>

                    <div class="col-sm-10">
                        <input name="password_confirmation" type="password" value="" class="form-control" />
                    </div>

                </div>

                <div style="clear: both; height: 25px;"></div>

                <div class="form-group">

                    <div class="col-sm-10  col-md-offset-2">

                        <button type="submit"  class="btn btn-primary">SALVAR</button>

                        <a href="javascript:history.back(-1)">
                            <button type="button" class="btn btn-default">Voltar</button>
                        </a>

                    </div>


                </div>

            </form>

        </div>

    </div>
@endsection
