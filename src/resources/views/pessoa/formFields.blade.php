<div class="form-group">
    <label class="col-sm-2 control-label">Tipo:</label>
    <div class="col-sm-10">
        <select name="tipo" class="form-control none tipoPessoa" inputDocumento="documento" labelRazaoApelido="labelRazaoApelido" labelNascimentoFundacao="labelNascimentoFundacao">
            <option value="CNPJ" <?php (isset($params['documento']) && strlen(Utils::unmask($params['documento']) == 14)) ? 'selected' : '' ?>>Pessoa Jurídica</option>
            <option value="CPF"  <?php (isset($params['documento']) && strlen(Utils::unmask($params['documento']) == 11)) ? 'selected' : '' ?>>Pessoa Fisica</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Documento:</label>
    <div class="col-sm-10">
        <div class="input-group">
            <input type="text" class="form-control <?php echo (isset($params['documento']) && strlen(Utils::unmask($params['documento']) == 11)) ? 'cpf' : 'cnpj' ?>" id="documento" name="documento" value="{{ $params['documento'] or '' }}" placeholder="CPF ou CNPJ" />
            <span class="input-group-btn">
                <button class="btn btn-primary" id="btnConsultarReceita" type="button">Consultar</button>
            </span>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Nome:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nome" name="nome" value="{{ $params['nome'] or '' }}" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" id="labelRazaoApelido"><?php echo (isset($params['documento']) && strlen(Utils::unmask($params['documento']) == 11)) ? 'Apelido:' : 'Razão Social:' ?></label>
    <div class="col-sm-10">
        <input class="form-control" id="razao_apelido" name="razao_apelido" value="{{{ $params['razao_apelido'] or '' }}}" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" id="labelNascimentoFundacao"><?php echo (isset($params['documento']) && strlen(Utils::unmask($params['documento']) == 11)) ? 'Nascimento:' : 'Fundação:' ?></label>
    <div class="col-sm-10">
        <input class="form-control datepicker" name="nascimento_fundacao" id="nascimento_fundacao" value="{{ $params['nascimento_fundacao'] or '' }}" placeholder="dd/mm/aaaa">
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