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
                        <a href="{{ route('produto.form') }}" class="btn btn-success">
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
                        <form method="POST">

                            <button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Excluir selecionados</button>

                            <div class="btn-group">
                                <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="glyphicon glyphicon-tag"></i> Aplicar tags <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-tags" role="menu">
                                    <li style="padding: 3px;">
                                        <input type="hidden" name="tabela" value="produtos" />
                                        <input type="text" name="novaTag" class="form-control input-sm" placeholder="Nova tag" />
                                    </li>
                                    @foreach($tags as $tag)
                                        <li style="padding: 3px; font-size: 12px;"><input type="checkbox" name="tags[]" value="{{$tag->nome}}" /> {{$tag->nome}}</li>
                                    @endforeach
                                    <li class="divider"></li>
                                    <li class="text-center">
                                        <button type="button" onClick="$(this).parents('form:first').attr('action', '<?php echo route('tag.adicionar'); ?>').submit()" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus-sign"></i> Aplicar</button>
                                        <button type="button" onClick="$(this).parents('form:first').attr('action', '<?php echo route('tag.remover'); ?>').submit()" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus-sign"></i> Remover</button>
                                    </li>
                                </ul>
                            </div>

                            <hr />

                            <div class="table-responsive">
                                <table class="table table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll" /></th>
                                        <th>&nbsp;</th>
                                        <th><a href="{{Order::url('codigo')}}">Código</a></th>
                                        <th><a href="{{Order::url('descricao')}}">Descrição</a></th>
                                        <th><a href="{{Order::url('unidade.nome')}}">Unidade</a></th>
                                        <th width="65">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($produtos as $produto)
                                        <?php $tags = $produto->tags->toArray(); ?>

                                        <tr>
                                            <th scope="row"><input type="checkbox" name="codigos[]" value="{{ $produto->getId() }}" /></th>
                                            <td>
                                                @if(count($tags)>1)
                                                    <i class="glyphicon glyphicon-tags" data-toggle="tooltip" data-placement="top" title="<?php echo implode(', ', array_map(function($c){ return $c['nome'];}, $tags))?>"></i>
                                                @elseif (count($tags) == 1)
                                                    <i class="glyphicon glyphicon-tag" data-toggle="tooltip" data-placement="top" title="{{ $tags[0]['nome'] }}"></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ Utils::highlighting($produto->getCodigo(), Input::get('like')) }}</td>
                                            <td>{{ Utils::highlighting($produto->getDescricao(), Input::get('like')) }}</td>
                                            <td>{{ $produto->getUnidade()->getNome() }}</td>
                                            <td>
                                                <a href="{{ route('produto.ver', $produto->getId()) }}" class="btn btn-info btn-xs">
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </a>
                                                <a href="{{ route('produto.deletar', $produto->getId()) }}" class="btn btn-danger btn-xs">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <?php echo $produtos->appends(Input::query())->render() ?>
                        </form>
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
                    $("input[name='codigos[]']").each(function() {
                        this.checked = true;
                    });
                }else{
                    $("input[name='codigos[]']").each(function() {
                        this.checked = false;
                    });
                }
            });

        });
    </script>

@endsection