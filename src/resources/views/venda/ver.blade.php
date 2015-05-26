@extends('app')

@section('content')


    <div class="container-fluid">


        <div class="row">
            <div class="col-md-6">
                <h4>Venda #{{ $venda->id }}</h4>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <a href="#" class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Imprimir</a>
                    <a href="{{ route('venda.index') }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <hr >

        <div class="row">
            <div class="col-md-6">

                <div class="list-group">
                    <a href="#" class="list-group-item disabled">
                        Dados do cliente
                    </a>
                    <a href="#" class="list-group-item">{{ $venda->cliente->pessoa->getNome() }}</a>
                    <a href="#" class="list-group-item">{{ $venda->cliente->pessoa->getDocumento() }}</a>
                </div>

            </div>

            <div class="col-md-6">

                <div class="list-group">
                    <a href="#" class="list-group-item disabled">
                        Faturamento
                    </a>
                    <a href="#" class="list-group-item">
                        <h4>R$ 0,00</h4>
                    </a>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Items

                        <a href="{{ route('vendaItem.form', $venda->id) }}" class="btn btn-xs btn-success pull-right">
                            <i class="glyphicon glyphicon-plus"></i> Adicionar
                        </a>
                    </div>
                    <div class="panel-body">


                        <div class="table-responsive">
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Qtd.</th>
                                    <th>Un.</th>
                                    <th>Valor</th>
                                    <th>Acrésc.</th>
                                    <th>Desc.</th>
                                    <th>Total</th>
                                    <th width="30">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($venda->itens as $item)
                                    <tr>
                                        <td>{{ $item->descricao }}</td>
                                        <td>{{ $item->quantidade }}</td>
                                        <td>{{ $item->valor_unitario }}</td>
                                        <td>{{ $item->valor_bruto }}</td>
                                        <td>{{ $item->valor_acrescimo }}</td>
                                        <td>{{ $item->valor_desconto }}</td>
                                        <td>{{ $item->valor_liquido }}</td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8"><i>Nenhum item adicionado</i></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
