@extends('app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h4>Selecione os produtos que deseja adicionar na Venda #{{ $venda->getId() }}:</h4>
            </div>
        </div>
        <br />

        <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
                <div class="pull-right">
                    <a href="#" class="btn btn-success">
                        <i class="glyphicon glyphicon-plus"></i> Criar novo produto
                    </a>
                    <a href="{{ route('venda.ver', $venda->getId()) }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <hr />


        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('vendaItem.adicionar') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="venda_id" value="{{ $venda->getId() }}">

                    <button type="submit" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar selecionados</button>

                    <br />
                    <br />

                    <div class="table-responsive">

                        <?php if(isset($errors)){
                            $erros = [];

                            foreach($errors->getBags() as $bag)
                                $erros = array_merge($erros, array_keys($bag->toArray()));


                        }?>

                        <table class="table table-condensed table-striped">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th><a href="{{Order::url('codigo')}}">Código</a></th>
                                <th><a href="{{Order::url('nome')}}">Nome</a></th>
                                <th>Quantidade</th>
                                <th>Unidade</th>
                                <th>Valor Un.</th>
                                <th>Acréscimos</th>
                                <th>Descontos</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($produtos as $produto)
                                <tr>
                                    <th scope="row"><input type="checkbox" class="checkProduto" name="produtos[{{ $produto->getId() }}]" value="{{ $produto->getId() }}" {{ old('produtos.'.$produto->getId())>0 ? 'checked' : '' }} /></th>

                                    <td>{{ Utils::highlighting($produto->getCodigo(), Input::get('like')) }}</td>

                                    <td>{{ Utils::highlighting($produto->getDescricao(), Input::get('like')) }}</td>

                                    <td class="form-group {{ in_array('quantidades.'.$produto->getId(), $erros) ? 'has-error' : ''  }}">
                                        <input type="text" name="quantidades[{{ $produto->getId() }}]" class="form-control input-sm" value="{{ old('quantidades.'.$produto->getId()) }}" />
                                    </td>

                                    <td class="form-group">
                                        <select name="unidades_medida[{{ $produto->getId() }}]" class="form-control input-sm">
                                            @foreach($produto->getUnidade()->getUnidadeMedidas() as $medida)
                                                <option value="{{ $medida->getId() }}">{{ $medida->getSimbolo() }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="form-group {{ in_array('valores_unitario.'.$produto->getId(), $erros) ? 'has-error' : ''  }}">
                                        <input type="text" name="valores_unitario[{{ $produto->getId() }}]" class="form-control input-sm" value="{{ old('valores_unitario.'.$produto->getId()) }}" />
                                    </td>

                                    <td class="form-group {{ in_array('acrescimos.'.$produto->getId(), $erros) ? 'has-error' : ''  }}">
                                        <input type="text" name="acrescimos[{{ $produto->getId() }}]" class="form-control input-sm" value="{{ old('acrescimos.'.$produto->getId()) }}" />
                                    </td>

                                    <td class="form-group {{ in_array('descontos.'.$produto->getId(), $erros) ? 'has-error' : ''  }}">
                                        <input type="text" name="descontos[{{ $produto->getId() }}]" class="form-control input-sm" value="{{ old('descontos.'.$produto->getId()) }}" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Nenhum produto encontrado</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){

            $('#selectAll').click(function(event) {
                if(this.checked) {
                    $(".checkProduto").each(function() {
                        this.checked = true;
                    });
                }else{
                    $(".checkProduto").each(function() {
                        this.checked = false;
                    });
                }
            });

        });
    </script>

@endsection
