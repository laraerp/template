@extends('app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <h4>Qual(is) produto(s) deseja adicionar?</h4>
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
                            <th><input type="checkbox" id="selectAll" /></th>
                            <th><a href="{{Order::url('codigo')}}">Código</a></th>
                            <th><a href="{{Order::url('nome')}}">Nome</a></th>
                            <th><a href="{{Order::url('valor')}}">Valor</a></th>
                            <th width="65">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <th scope="row"><input type="checkbox" name="produtos[]" value="{{ $produto->id }}" /></th>
                                <td>{{ Utils::highlighting($produto->codigo, Input::get('like')) }}</td>
                                <td>{{ Utils::highlighting($produto->nome, Input::get('like')) }}</td>
                                <td>{{ $produto->getValor() }}</td>
                                <td>
                                    <a href="{{ route('cliente.ver', $produto->id) }}" class="btn btn-info btn-xs">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                    <a href="{{ route('cliente.deletar', $produto->id) }}" class="btn btn-danger btn-xs">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </a>
                                </td>
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
