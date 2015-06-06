@extends('app')

@section('content')


    <div class="container-fluid">


        <div class="row">
            <div class="col-md-6">
                <h2>Venda #{{ $venda->getId(true) }}</h2>
            </div>
            <div class="col-md-6">
                <div class="pull-right">

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Ações
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li class="disabled"><a href="#">Exportar .pdf</a></li>
                            <li class="disabled"><a href="#">Imprimir</a></li>
                            <li class="disabled"><a href="#">Nota fiscal</a></li>
                        </ul>
                    </div>

                    <input type="submit" class="btn btn-success" value="Salvar" />
                    <a href="{{ route('venda.index') }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <br />

        <div class="row">
            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dados do cliente

                        <a href="{{ route('cliente.ver', $venda->getCliente()->getId()) }}" class="btn btn-xs btn-primary pull-right">
                            <i class="glyphicon glyphicon-eye-open"></i> Ver mais
                        </a>
                    </div>
                    <div class="panel-body">

                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome:</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{ $venda->getCliente()->getPessoa()->getNome() }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Documento:</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{ $venda->getCliente()->getPessoa()->getDocumento() }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Financeiro

                        <a href="{{ route('cliente.ver', $venda->getCliente()->getId()) }}" class="btn btn-xs btn-primary pull-right">
                            <i class="glyphicon glyphicon-eye-open"></i> Ver mais
                        </a>
                    </div>
                    <div class="panel-body">

                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Valor total:</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{ $venda->getValorTotal() }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Valor pago:</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">R$ 0,00</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dados da venda
                    </div>
                    <div class="panel-body">

                        <div class="form-horizontal">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código:</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static">{{ $venda->getId(true) }}</p>
                                </div>

                                <label class="col-sm-2 control-label">Data:</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static">{{ $venda->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Endereço de entrega:</label>
                                <div class="col-sm-4">
                                    <select name="endereco_entrega_id" class="form-control">
                                        <option value="null">Nenhum</option>
                                        @foreach($venda->getCliente()->getPessoa()->getEnderecos() as $endereco)
                                            <option value="{{ $endereco->getId() }}" {{ (!is_null($venda->getEnderecoEntrega()) && $endereco->getId() == $venda->getEnderecoEntrega()->getId()) ? 'selected' : '' }}>{{ $endereco->getEndereco() }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 control-label">Data da entrega:</label>
                                <div class="col-sm-4">
                                    <input class="form-control datepicker" name="previsao_entrega" id="previsao_entrega" value="" placeholder="dd/mm/aaaa">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Observações:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control datepicker" name="observacoes" id="observacoes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <th>Un.</th>
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
                                        <td>{{ $item->getQuantidade() }}</td>
                                        <td>{{ $item->getUnidadeMedida()->getSimbolo() }}</td>
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
