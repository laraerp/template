<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laraerp</title>

        <link href="/public/vendor/laraerp/template/styles.css" rel="stylesheet">

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Laraerp</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    @if (Auth::check())
                    <ul class="nav navbar-nav">
                        <li><a href="/">Dashboard</a></li>
                    </ul>

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cadastros <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/cliente">Clientes</a></li>
                                <li><a href="/fornecedor">Fornecedores</a></li>
                                <li><a href="/produto">Produtos</a></li>
                                <li><a href="/servico">Serviços</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/configuracoes">Configurações</a></li>
                                <li><a href="/auth/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </nav>

        @yield('content')

        <!-- Scripts -->
        <script src="/public/vendor/laraerp/template/scripts.js"></script>
    </body>
</html>
