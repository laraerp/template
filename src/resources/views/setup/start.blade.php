@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Vamos começar?</div>
                    <div class="panel-body">

                        <h4>Olá! Comece importando suas notas fiscais de entrada e saída:</h4>
                        <hr />

                        <form id="dropzone" action="{{ route('notaFiscal.upload') }}" class="dropzone">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        Dropzone.options.dropzone = {
            paramName: "file", // The name that will be used to transfer the file
            acceptedFiles: '.xml'
        };
    </script>

@endsection
