@extends('app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <h4>Selecione os produtos que deseja adicionar:</h4>
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
        </div>

        <br />

        <div class="row">
            <div class="col-md-12">
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
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <th scope="row"><input type="checkbox" name="produtos[]" value="{{ $produto->id }}" /></th>
                                <td>{{ Utils::highlighting($produto->codigo, Input::get('like')) }}</td>
                                <td>{{ Utils::highlighting($produto->nome, Input::get('like')) }}</td>
                                <td><input type="text" class="form-control input-sm" value="1" /></td>
                                <td>
                                    <select class="form-control input-sm">
                                        @foreach($unidades as $unidade)
                                            <optgroup label="{{ $unidade->nome }}">

                                                @foreach($unidade->unidadeMedidas as $medida)
                                                    <option {{ ($medida->id == $produto->unidade_medida_id) ? 'selected' : '' }}>{{ $medida->simbolo }}</option>
                                                @endforeach

                                            </optgroup>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control input-sm" value="{{ $produto->getValorUnitario() }}" /></td>
                                <td><input type="text" class="form-control input-sm" /></td>
                                <td><input type="text" class="form-control input-sm" /></td>
                                <td>{{ $produto->getValorUnitario() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <?php echo $produtos->appends(Input::query())->render() ?>
            </div>
        </div>


    </div>

@endsection
