@extends('app')

@section('content')
    <form class="form-horizontal" role="form" method="post" action="{{route('produto.salvar')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <input type="submit" class="btn btn-success" value="Cadastrar" />
                        <input type="reset" class="btn btn-danger" value="Limpar" />
                        <a href="{{ route('produto.index') }}" class="btn btn-primary">Voltar</a>
                    </div>
                </div>
            </div>

            <hr >

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Cadastrar produto
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="codigo" value="{{ Input::old('codigo') }}" placeholder="Código do Produto"">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descrição:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="descricao" value="{{ Input::old('descricao') }}" placeholder="Descrição do produto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Unidade de venda:</label>
                                <div class="col-sm-10">
                                    <select name="unidade_id" class="form-control">
                                        @foreach($unidades as $unidade)
                                            <option value="{{ $unidade->getId() }}">{{ $unidade->getNome() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </form>

@endsection
