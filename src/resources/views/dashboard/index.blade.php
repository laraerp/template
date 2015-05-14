@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Financeiro</div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-condensed table-striped extrato">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th><span class="pull-right">Valor</span></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>03/04/2015</td>
                                    <td>FATURAMENTO VENDA <a href="">#30270</a></td>
                                    <td class="receita">+ 700,00</td>
                                </tr>
                                <tr>
                                    <td>06/04/2015</td>
                                    <td>COMPRA DE INSUMOS <a href="">#0301</a></td>
                                    <td class="despesa">- 300,00</td>
                                </tr>
                                <tr>
                                    <td>06/04/2015</td>
                                    <td>FATURAMENTO VENDA <a href="">#30271</a></td>
                                    <td class="receita">+ 2.500,00</td>
                                </tr>
                                <tr>
                                    <td>06/04/2015</td>
                                    <td>DESPESA CONTA LUZ <a href="">#0302</a></td>
                                    <td class="despesa">- 150,00</td>
                                </tr>
                                <tr>
                                    <td>06/04/2015</td>
                                    <td>GASTOS FUNCIONARIO</td>
                                    <td class="despesa">- 100,00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>



        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Tarefas</div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
