@extends('app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h4>Selecione os produtos que deseja adicionar na Venda #{{ $venda->id }}:</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <form method="GET" class="form-inline">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="like" class="form-control" placeholder="Pesquisar por..." value="{{Input::get('like')}}" />
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <a href="#" class="btn btn-success">
                        <i class="glyphicon glyphicon-plus"></i> Criar novo produto
                    </a>
                    <a href="{{ route('venda.ver', $venda->id) }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <hr />


        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('vendaItem.adicionar', $venda->id) }}" method="POST">

                    <button type="submit" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar selecionados</button>

                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table table-condensed table-striped">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th><a href="{{Order::url('codigo')}}">Código</a></th>
                                <th><a href="{{Order::url('nome')}}">Nome</a></th>
                                <th width="90">Quantidade</th>
                                <th width="90">Unidade</th>
                                <th width="90">Valor Un.</th>
                                <th width="90">Acréscimos</th>
                                <th width="90">Descontos</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <th scope="row"><input type="checkbox" name="produtos[]" value="{{ $produto->id }}" /></th>
                                    <td>{{ Utils::highlighting($produto->codigo, Input::get('like')) }}</td>
                                    <td>{{ Utils::highlighting($produto->nome, Input::get('like')) }}</td>
                                    <td><input type="text" name="quantidades[{{ $produto->id }}]" class="form-control input-sm" value="1" /></td>
                                    <td>
                                        <select name="unidades_medida[{{ $produto->id }}]" class="form-control input-sm">
                                            @foreach($unidades as $unidade)
                                                <optgroup label="{{ $unidade->nome }}">

                                                    @foreach($unidade->unidadeMedidas as $medida)
                                                        <option value="{{ $medida->id }}" {{ ($medida->id == $produto->unidade_medida_id) ? 'selected' : '' }}>{{ $medida->simbolo }}</option>
                                                    @endforeach

                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="valores_unitario[{{ $produto->id }}]" class="form-control input-sm" value="{{ $produto->getValorUnitario() }}" /></td>
                                    <td><input type="text" name="descontos[{{ $produto->id }}]" class="form-control input-sm" /></td>
                                    <td><input type="text" name="acrescimos[{{ $produto->id }}]" class="form-control input-sm" /></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                <?php echo $produtos->appends(Input::query())->render() ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){

            $('#selectAll').click(function(event) {
                if(this.checked) {
                    $("input[name='produtos[]']").each(function() {
                        this.checked = true;
                    });
                }else{
                    $("input[name='produtos[]']").each(function() {
                        this.checked = false;
                    });
                }
            });

        });
    </script>

@endsection
