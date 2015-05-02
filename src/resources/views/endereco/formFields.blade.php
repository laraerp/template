<div class="form-group">
    <label class="col-sm-2 control-label">Cep:</label>
    <div class="col-sm-10">
        <div class="input-group">
            <input type="text" class="form-control cep" id="cep" name="cep" value="{{ $params['cep'] or '' }}" placeholder="CEP" />
            <span class="input-group-btn">
                <button class="btn btn-primary" id="btnConsultarCorreios" type="button">Consultar Correios</button>
            </span>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Logradouro:</label>
    <div class="col-sm-10">
        <div class="form-group" style="margin-bottom: 0px;">
            <div class="col-xs-6">
                <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ $params['logradouro'] or '' }}" placeholder="Logradouro" />
            </div>
            <div class="col-xs-3">
                <input type="text" class="form-control" id="numero" name="numero" value="{{ $params['numero'] or '' }}" placeholder="Num." />
            </div>
            <div class="col-xs-3">
                <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $params['complemento'] or '' }}" placeholder="Compl" />
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Bairro:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $params['bairro'] or '' }}" placeholder="Bairro" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Cidade:</label>
    <div class="col-sm-10">

        <div class="form-group">
            <div class="col-sm-4">
                <select class="form-control" id="uf" name="uf" default="{{ $params['uf'] or 'MG' }}"></select>
            </div>
            <div class="col-sm-8">
                <select class="form-control" id="cidade_id" name="cidade_id" default="{{ $params['cidade_id'] or '' }}"></select>
            </div>
        </div>

    </div>
</div>

<script>
    $(function(){
        $('#uf').ufs({
            onChange: function(uf){
                $('#cidade_id').cidades({uf: uf});
            }
        });
    });
</script>