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
            <div class="col-md-5">

                <div class="list-group">
                    <a href="#" class="list-group-item disabled">
                        Dados do cliente
                    </a>
                    <a href="#" class="list-group-item">{{ $venda->cliente->pessoa->getNome() }}</a>
                    <a href="#" class="list-group-item">{{ $venda->cliente->pessoa->getDocumento() }}</a>
                </div>


            </div>

            <div class="col-md-7">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Items
                    </div>
                    <div class="panel-body">
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
