@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Seja bem vindo!</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="post" action="{{route('setup.salvar')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <h4>Para começar, informe os dados da empresa:</h4>
                            <hr />

                            <div class="form-group">
                                <label class="col-sm-2 control-label">CNPJ:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control cnpj" id="documento" name="documento" value="{{ old('documento') }}" placeholder="CNPJ" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" id="btnConsultarReceita" type="button">Consultar</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Nome fantasia" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Razão Social:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="razao_apelido" name="razao_apelido" value="{{ old('razao_apelido') }}" placeholder="Razão Social" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Fundação:</label>
                                <div class="col-sm-10">
                                    <input class="form-control datepicker" name="nascimento_fundacao" id="nascimento_fundacao" value="{{ old('nascimento_fundacao') }}" placeholder="dd/mm/aaaa">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Insc. estadual:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="inscricao_estadual" value="{{ Input::old('inscricao_estadual') }}" placeholder="Inscrição estadual">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Insc. municipal:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="inscricao_municipal" value="{{ Input::old('inscricao_municipal') }}" placeholder="Inscrição municipal">
                                </div>
                            </div>

                            <h4>Informe o endereço:</h4>
                            <hr />

                            @include('endereco.formFields', ['params' => old()])

                            <h4>Dados de contato:</h4>
                            <hr />

                            @include('contato.formFields', ['params' => old()])

                            <div class="pull-right">
                                <button type="submit" class="btn btn-success btn-lg">Salvar configurações</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Consulta Receita-->
    <div id="consultaReceita" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Consultar</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button id="btnConsultar" type="button" class="btn btn-primary">Consultar</button>
                    <button id="btnTrocarImg" type="button" class="btn btn-warning">Atualizar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        $(function(){

            $('#btnConsultarReceita').click(function(){
                var params = {documento:$('#documento').val()};

                if(params.documento.length > 0){
                    getParams(params, responseParams);
                }else
                    alert('Informe um documento');
            });

            $('#btnTrocarImg').click(function(){
                getParams({documento:$('#documento').val()}, responseParams);
            });

            function getParams(params, response){
                $('#consultaReceita div.modal-body').html('<div class="progress">' +
                '<div id="progressReceita" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                'Aguarde.. Conectando ao site da Receita..' +
                '</div>' +
                '</div>');

                $("#consultaReceita").modal('show');

                $.post('<?php echo route('pessoa.receitaParams'); ?>', params, response, 'json').fail(function() {
                    $("#progressReceita")
                            .addClass("progress-bar-danger")
                            .removeClass("active")
                            .removeClass("progress-bar-striped")
                            .html("Ocorreu um erro de conexao");
                });
            }

            function buildForm(captcha){
                return '<img src="'+ captcha + '" />' + '<br /><br /><input class="form-control" id="captcha" placeholder="Digite aqui" />';
            }

            function responseParams(response){

                if(response.code == 0){
                    var html = buildForm(response.params.captchaBase64);
                    var params = {
                        documento: $('#documento').val()
                    };

                    $('#btnConsultar').unbind();
                    $('#btnConsultar').click(function(){
                        params.captcha = $('#captcha').val();
                        params.cookie = response.params.cookie;
                        consultar(params);
                    });
                }else
                    html = response.message;

                $('#consultaReceita div.modal-body').html(html);
            }

            function consultar(params){
                $('#consultaReceita div.modal-body').html('<div class="progress">' +
                '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                'Consultando...' +
                '</div>' +
                '</div>');

                $.post('<?php echo route('pessoa.receitaConsulta'); ?>', params, function(json){

                    if (json.code === 0 || json.code === 1) {

                        if (json.code === 0) {
                            $("#nome").val(json.params.nome_fantasia);
                            $("#razao_apelido").val(json.params.razao_social);

                            //Endereco
                            $("#cep").val(json.params.cep);
                            $('#btnConsultarCorreios').trigger('click');

                            //Cliente
                            $("#nascimento_fundacao").val(json.params.situacao_cadastral_data);

                            //Contato
                            $("#email").val(json.params.email);

                        }

                        if (json.code === 1) {
                            $("#nome").val(json.params.nome);
                        }

                        $('#consultaReceita').modal('hide');
                    } else
                        $('#consultaReceita div.modal-body').html(json.message);

                }, 'json');
            }

        });
    </script>
@endsection
