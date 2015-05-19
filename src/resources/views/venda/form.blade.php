@extends('app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <h4>Para qual cliente deseja vender?</h4>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <a href="{{ route('cliente.form') }}" class="btn btn-success">
                        <i class="glyphicon glyphicon-plus"></i> Criar novo cliente
                    </a>
                    <a href="{{ route('venda.index') }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <hr >

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
                            <th><a href="{{Order::url('pessoa.documento')}}">Documento</a></th>
                            <th><a href="{{Order::url('pessoa.nome')}}">Nome</a></th>
                            <th><a href="{{Order::url('pessoa.razao_apelido')}}">Razão Social</a></th>
                            <th width="65">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ Utils::highlighting($cliente->pessoa->getDocumento(), Input::get('like')) }}</td>
                                <td>{{ Utils::highlighting($cliente->pessoa->nome, Input::get('like')) }}</td>
                                <td>{{ Utils::highlighting($cliente->pessoa->razao_apelido, Input::get('like')) }}</td>
                                <td>
                                    <a href="{{ route('venda.cadastrar', $cliente->id) }}" class="btn btn-primary btn-xs">
                                        Selecionar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <?php echo $clientes->appends(Input::query())->render() ?>
            </div>
        </div>


    </div>

@endsection
