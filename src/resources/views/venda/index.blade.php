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
                        <a href="{{ route('venda.form') }}" class="btn btn-success">
                            <i class="glyphicon glyphicon-plus"></i> Criar nova
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
                        Minhas vendas
                    </div>
                    <div class="panel-body">


                        <button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Excluir selecionados</button>

                        <div class="btn-group">
                            <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="glyphicon glyphicon-tag"></i> Aplicar tags <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-tags" role="menu">
                                <li style="padding: 3px;">
                                    <input type="text" class="form-control input-sm" placeholder="Digite para criar uma" />
                                </li>
                                <li style="padding: 3px;"><input type="checkbox" /> Tag 01</li>
                                <li style="padding: 3px;"><input type="checkbox" /> Tag 02</li>
                                <li style="padding: 3px;"><input type="checkbox" /> Tag 03</li>
                                <li class="divider"></li>
                                <li class="text-center">
                                    <button type="button" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus-sign"></i> Aplicar</button>
                                    <button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus-sign"></i> Remover</button>
                                </li>
                            </ul>
                        </div>

                        <hr />

                        <div class="table-responsive">
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll" /></th>
                                    <th><a href="{{Order::url('id')}}">Código</a></th>
                                    <th><a href="{{Order::url('cliente.pessoa.nome')}}">Cliente</a></th>
                                    <th><a href="{{Order::url('valor_liquido')}}">Valor</a></th>
                                    <th width="65">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($vendas as $venda)
                                    <tr>
                                        <th scope="row"><input type="checkbox" name="vendas[]" value="{{ $venda->id }}" /></th>
                                        <td>{{ $venda->id }}</td>
                                        <td>{{ Utils::highlighting($venda->cliente->pessoa->nome, Input::get('like')) }}</td>
                                        <td>{{ $venda->valor_liquido }}</td>
                                        <td>
                                            <a href="{{ route('venda.ver', $venda->id) }}" class="btn btn-info btn-xs">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a href="{{ route('venda.deletar', $venda->id) }}" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <?php echo $vendas->appends(Input::query())->render() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $('.dropdown-menu input, .dropdown-menu').click(function(e) {
                e.stopPropagation();
            });

            $('#selectAll').click(function(event) {
                if(this.checked) {
                    $("input[name='vendas[]']").each(function() {
                        this.checked = true;
                    });
                }else{
                    $("input[name='vendas[]']").each(function() {
                        this.checked = false;
                    });
                }
            });

        });
    </script>

@endsection