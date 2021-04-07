<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="<?php echo session()->get(session()->get('idempresa').'_Configuracion.Web.descripcion');?>">
        <meta name="keywords" content="<?php echo session()->get(session()->get('idempresa').'_Configuracion.Web.palabrasclaves');?>" />
        <meta name="author" content="{{ env('APP_AUTOR') }}">

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            <?php echo session()->get(session()->get('idempresa').'_Configuracion.Web.titulo');?>
        </title>

        <!-- FONT -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">

        <!-- ESTILOS -->
        <link rel="stylesheet" id="css-main" href="{{ asset('css/private/dashmix.css') }}">
        <link rel="stylesheet" id="css-theme" href="{{ asset('css/private/themes/xmodern.min.css') }}">
        <link href="{{ asset('css/compartidos/fontawesome/css/all.min.css') }}" rel="stylesheet">

        <!-- JS-->
            <script src="{{ asset('js/private/jquery-3.3.1.min.js') }}"></script>
            <script src="{{ asset('js/private/dashmix.core.min.js') }}"></script>
            <script src="{{ asset('js/private/dashmix.app.min.js') }}"></script>
        <!-- FIN DE JS -->
    </head>
    <body>
    	<div id="page-container">
            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('{{ asset('img/private/photos/photo24@2x.jpg') }}');">
                    <div class="hero bg-black-90">
                        <div class="hero-inner">
                            <div class="content content-full">
                                <div class="px-3 py-5 text-center">
                                    <div class="mb-3">
                                        <a class="link-fx font-w700 font-size-h1" href="index.html">
                                            <span class="text-primary"><?= session()->get(session()->get('idempresa').'_Configuracion.Web.titulo');?></span>
                                        </a>
                                        <br>
                                        <i class="text-white fas fa-exclamation-circle fa-5x"></i>
                                    </div>
                                    <h1 class="text-white font-w700 mt-5 mb-3">Usuario bloqueado</h1>
                                    <h2 class="h3 text-white-75 font-w400 text-muted mb-5">Temporalmente su usuario se encuentra bloqueado, por favor contacte con el administrador.</h2>
                                    <a class="btn btn-hero-primary mb-3" href="{{ route('login') }}">
                                        <i class="fas fa-home"></i> Ir a home
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
    </body>
</html>
