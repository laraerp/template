@extends('app')

@section('content')
    <div class="container-fluid">

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
                    <div class="pull-right">
                        <a href="/" class="btn btn-success">
                            <i class="glyphicon glyphicon-plus"></i> Criar novo
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Lista de clientes
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th><a href="{{Order::url('id')}}">#</a></th>
                                    <th><a href="{{Order::url('pessoa.documento')}}">Documento</a></th>
                                    <th><a href="{{Order::url('pessoa.nome')}}">Nome</a></th>
                                    <th><a href="{{Order::url('pessoa.razao_apelido')}}">Razão Social</a></th>
                                    <th width="65">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <th scope="row">{{ $cliente->id }}</th>
                                        <td>{{ $cliente->pessoa->documento }}</td>
                                        <td>{{ $cliente->pessoa->nome }}</td>
                                        <td>{{ $cliente->pessoa->razao_apelido }}</td>
                                        <td>
                                            <a href="/cliente/view/{{ $cliente->id }}" class="btn btn-info btn-xs">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a href="/cliente/delete/{{ $cliente->id }}" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $clientes->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
