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
                        <a href="{{ route('cliente.form') }}" class="btn btn-success">
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
                        Lista de produtos
                    </div>
                    <div class="panel-body">

                        <div id="acoesMultiplas" class="panel-collapse collapse" role="tabpanel">
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
                        </div>

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
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $('.dropdown-menu input, .dropdown-menu').click(function(e) {
                e.stopPropagation();
            });

            $('#selectAll').click(function(event) {
                if(this.checked) {
                    $("input[name='produtos[]']").each(function() {
                        this.checked = true;
                    });
                    $("#acoesMultiplas").collapse('show');
                }else{
                    $("input[name='produtos[]']").each(function() {
                        this.checked = false;
                    });
                    $("#acoesMultiplas").collapse('hide')
                }
            });

            $("input[name='produtos[]']").change(function() {
                var n = $("input[name='produtos[]']:checked").length;
                if(n>0)
                    $("#acoesMultiplas").collapse('show');
                else
                    $("#acoesMultiplas").collapse('hide')
            });

        });
    </script>

@endsection