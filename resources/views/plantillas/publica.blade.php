<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="<?php echo session()->get('Configuracion.Web.descripcion');?>">
        <meta name="keywords" content="<?php echo session()->get('Configuracion.Web.palabrasclaves');?>" />
        <meta name="author" content="{{ env('APP_AUTOR') }}">

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            <?php echo session()->get('Configuracion.Web.titulo');?>
        </title>

        <!-- FONT -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">

        <!-- ESTILOS -->
        <link rel="stylesheet" id="css-main" href="{{ asset('css/private/dashmix.css') }}">
        <link rel="stylesheet" id="css-theme" href="{{ asset('css/private/themes/xwork.min.css') }}">
        <link href="{{ asset('css/compartidos/fontawesome/css/all.min.css') }}" rel="stylesheet">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('Dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

        <!-- JS-->
            <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <!-- FIN DE JS-->

        <style type="text/css">
            .font-size-note{
                font-size: 1.50rem !important;
            }
        </style>
    </head>
    <body style="background-color: #f8f8f8;">
        <div class="page-container">
            <!-- CONTENIDO -->
                @yield('content')
            <!-- FIN DE CONTENIDO -->
        </div>

        

        <!-- JS -->
            <!-- Bootstrap core JavaScript-->
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>.

            <!-- Page JS Plugins -->
            <script src="{{ asset('Dashmix/src/assets/js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
            <script src="{{ asset('Dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    
        <!-- FIN DE JS -->

        @include('message/message')
        @include('js/jsvalidation')

    </body>
</html>
