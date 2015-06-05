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
                        <h4>{{ $venda->getValorTotal() }}</h4>
                    </a>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Itens

                        <a href="{{ route('venda.adicionarItem', $venda->id) }}" class="btn btn-xs btn-success pull-right">
                            <i class="glyphicon glyphicon-plus"></i> Adicionar
                        </a>
                    </div>
                    <div class="panel-body">


                        <div class="table-responsive">
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th>Cód</th>
                                    <th>Descrição</th>
                                    <th>Qtd.</th>
                                    <th>Valor Un.</th>
                                    <th>Desconto</th>
                                    <th>Acréscimo</th>
                                    <th>Total</th>
                                    <th width="30">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($venda->getVendasItens() as $item)
                                    <tr>
                                        <td>{{ $item->getCodigo() }}</td>
                                        <td>{{ $item->getDescricao() }}</td>
                                        <td>{{ $item->getQuantidade() . ' '. $item->getUnidadeMedida()->getSimbolo() }}</td>
                                        <td>{{ $item->getValorUnitario() }}</td>
                                        <td>{{ $item->getValorDesconto() }}</td>
                                        <td>{{ $item->getValorAcrescimo() }}</td>
                                        <td>{{ $item->getValorTotal() }}</td>
                                        <td>
                                            <a href="{{ route('vendaItem.deletar', $item->getId()) }}" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9"><i>Nenhum item adicionado</i></td>
                                    </tr>
                                @endforelse
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>{{ $venda->getValorTotal() }}</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
