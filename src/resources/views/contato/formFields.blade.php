<div class="form-group">
    <label class="col-sm-2 control-label">Responsável:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="responsavel" name="responsavel" value="{{ $params['responsavel'] or '' }}" placeholder="Responsavel" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Email:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="email" value="{{ $params['email'] or '' }}" placeholder="Email" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Telefone:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control telefone" id="telefone" name="telefone" value="{{ $params['telefone'] or '' }}" placeholder="Telefone" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Celular:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control telefone" id="celular" name="celular" value="{{ $params['celular'] or '' }}" placeholder="Celular" />
    </div>
</div>