@extends('app')

@section('content')


    <div class="container-fluid">


        <form class="form-horizontal" method="POST" action="{{ route('cliente.editar', $cliente->id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <input type="submit" class="btn btn-success" value="Salvar" />
                        <a href="{{ route('venda.cadastrar', $cliente->id) }}" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i> Criar venda</a>
                        <a href="{{ route('cliente.index') }}" class="btn btn-primary">Voltar</a>
                    </div>
                </div>
            </div>

            <hr >

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dados do cliente
                        </div>
                        <div class="panel-body">

                            @include('pessoa.formFields', ['params' => $cliente->pessoa])

                            <div id="dadosClienteEmpresa" class="<?php echo (strlen(Utils::unmask($cliente->pessoa->documento)) == 11) ? 'hide' : '' ?>">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Insc. estadual:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="inscricao_estadual" value="{{ $cliente->inscricao_estadual }}" placeholder="Inscrição estadual">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Insc. municipal:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="inscricao_municipal" value="{{ $cliente->inscricao_municipal }}" placeholder="Inscrição municipal">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Retém ISS:</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" id="retem_issqn" name="retem_issqn" data-size="mini" data-on-text="Sim" data-off-text="Não" {{ $cliente->retem_issqn ? 'checked' : '' }} />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Endereços
                        <a class="collapsed btn btn-xs btn-success pull-right" data-toggle="collapse" href="#addEndereco" aria-expanded="false">
                            <i class="glyphicon glyphicon-plus"></i> Adicionar
                        </a>
                    </div>
                    <div class="panel-body">
                        <div id="addEndereco" class="panel-collapse collapse" role="tabpanel">
                            <form class="form-horizontal" method="POST" action="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @include('endereco.formFields', ['params' => Input::old()])

                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                            <hr />
                        </div>

                        <div class="table-responsive">
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th>Endereço</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cliente->pessoa->enderecos as $endereco)
                                    <tr>
                                        <td>{{ $endereco->getEndereco() }}</td>
                                        <td>
                                            <a href="{{ route('cliente.deletar', $cliente->id) }}" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Contatos
                        <a class="collapsed btn btn-xs btn-success pull-right" data-toggle="collapse" href="#addContato" aria-expanded="false">
                            <i class="glyphicon glyphicon-plus"></i> Adicionar
                        </a>
                    </div>
                    <div class="panel-body">

                        <div id="addContato" class="panel-collapse collapse" role="tabpanel">
                            <form class="form-horizontal" method="POST" action="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @include('contato.formFields', ['params' => Input::old()])

                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                            <hr />
                        </div>

                        <div class="table-responsive">
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th>Responsavel</th>
                                    <th>Telefone</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cliente->pessoa->contatos as $contato)
                                    <tr>
                                        <td>{{ $contato->responsavel }}</td>
                                        <td>{{ $contato->getTelefone() }}</td>
                                        <td>{{ $contato->getCelular() }}</td>
                                        <td>{{ $contato->email }}</td>
                                        <td>
                                            <a href="{{ route('cliente.deletar', $cliente->id) }}" class="btn btn-danger btn-xs">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(function(){
            $('.tipoPessoa').change(function () {
                if ($(this).val() === 'CPF') {
                    $("#dadosClienteEmpresa").addClass('hide');
                }else
                    $("#dadosClienteEmpresa").removeClass('hide');
            });
        });
    </script>
@endsection
