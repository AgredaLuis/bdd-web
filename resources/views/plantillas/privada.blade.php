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

        <!-- ESTILOS -->
        <link rel="stylesheet" id="css-main" href="{{ asset('css/sb-admin-2.min.css') }}">

        <!-- FONT -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">

        <!-- ESTILOS -->
        <link rel="stylesheet" id="css-main" href="{{ asset('css/private/dashmix.css') }}">
        <link rel="stylesheet" id="css-theme" href="{{ asset('css/private/themes/xwork.min.css') }}">
        <link href="{{ asset('css/compartidos/fontawesome/css/all.min.css') }}" rel="stylesheet">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('Dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('Dashmix/src/assets/js/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">

        <style type="text/css">
            .font-note{
                font-size: 0.65rem !important;
            }
            .font-label-form
            {
                font-size: 0.75rem !important;   
            }
            .font-size-input
            {
                font-size: 0.75rem !important;   
            }
            .select2-container .select2-selection--single
            {
                height: calc(2.25rem + 2px) !important;
                font-size: 0.75rem !important;
                text-transform: uppercase !important;
                padding: 0.375rem 0.75rem;                            
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow
            {
                height: 35px;
            }
            .select2-container .select2-selection--single .select2-selection__rendered
            {
                padding-left: 0px !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered
            {
                line-height: 25px !important;
                color: #495057 !important;                
            }
            .select2-container--default .select2-selection--single
            {
                border-color: #e1e1e1 !important; 
            }
            .select2-container--default .select2-results__option--highlighted[aria-selected]
            {
                background-color: #343a40 !important;                  
            }
            .select2-results__option
            {
                text-transform: uppercase !important; 
                font-size: 0.75rem !important;  
            }
            .select2-search__field
            {
                text-transform: uppercase !important;  
                font-size: 0.75rem !important;   
            }
            .btn-delete
            {
                cursor: pointer;
            }
            .font-size-details
            {
                font-size: 0.60rem !important;   
            }
            .tbody-font tr *
            {
                font-size: 0.75rem !important;   
            }
            .tbody-font .i-font-table{
                font-size: 1.75rem !important;
            }
            .row-info{
                font-size: 0.75rem !important;
                text-transform: uppercase;  
            }
            .i-font-block{
                font-size: 1.00rem !important;
            }
            .tbody-font .i-font-details{
                font-size: 1.10rem !important;
                cursor: pointer;
            }
            .btn-details{
                font-size: 0.75rem !important;  
                font-weight: bold;
            }
            .tbody-font .p-font-details{
                font-size: 0.55rem !important;
            }
            .breadcrumb-item-font{
                font-size: 0.80rem !important;
            }
            .breadcrumb-item-font-active{
                font-size: 0.70rem !important;
            }
            .breadcrumb.breadcrumb-alt .breadcrumb-item + .breadcrumb-item::before{
                font-size: 0.65rem !important;   
            }
            .sidebar-brand-menu{
                height: 1.60rem !important; 
            }
            /*.row-filter{
                font-size: 0.75rem !important;
                text-transform: uppercase;  
            }
            .row-filter input{
                font-size: 0.75rem !important;
                text-transform: uppercase;  
            }
            .dataTables_filter {
               float: left !important;
            }
            .dataTables_filter input[type="search"] {
               width: 100% !important;
            }*/
            .nav-item-active{
                background-color: #f8f9fa !important;
                color:#000 !important;                
            }
            .nav-item-active a{
                color:#000 !important;
                font-weight: bold !important;
            }
            .nav-item-active i{
                color:#000 !important;
                font-weight: bold !important;
            }            
            @media (min-width: 768px){

                .sidebar.toggled {
                    overflow: visible;
                    width: 9.5rem !important;
                }
                .sidebar.toggled .nav-item .nav-link {
                    width: 9.5rem !important;
                }

            }
            .sidebar-dark hr.sidebar-divider {
                border-top: 1px solid rgba(255,255,255,.30) !important;
            }            
        </style>

        <!-- JS-->
            <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <!-- FIN DE JS-->

        <!--DATATABLE-->
            <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}">
            <link rel="stylesheet" href="{{ asset('vendor/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
            
        <!--FIN DE DATATABLE-->



        <link rel="stylesheet" href="{{ asset('Dashmix/src/assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('Dashmix/src/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" id="css-main" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('Dashmix/src/assets/js/plugins/slick-carousel/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('Dashmix/src/assets/js/plugins/slick-carousel/slick-theme.css') }}">

        <script type="text/javascript">
            function AcceptNum(evt){
                //ACEPTA NUMERO
                var key = evt.which || evt.keyCode;
                return (key <= 13 || (key >= 48 && key <= 57) );
            }
            function AcceptNumPunto(evt){
                //ACEPTA NUMERO
                var key = evt.which || evt.keyCode;
                return (key <= 13 || key <= 46 || (key >= 48 && key <= 57) );
            }
            function AcceptLetra(evt){
                //ACEPTA LETRAS
                var key = evt.which || evt.keyCode;
                if((key!=32) && (key<65) || (key>90) && (key<97) || (key>122 && key != 241 && key != 209 && key != 225 && key != 233 && key != 237 && key != 243 && key != 250 && key != 193 && key != 201 && key != 205 && key != 211 && key != 218)){
                    if(key==0 || key==8 || key==9 || key==17 || key==18 || key==46 || key==37 || key==38 || key==39 || key==40 || key==116){
                        return key;
                    }else{
                        return false;
                    }
                }else{
                    return key;
                }
            }
            function trunc (x, posiciones = 2) {
                //FUNCION PARA TRUNCAR NUMEROS FLOTANTES
                var s = x.toString()
                var l = s.length
                var decimalLength = s.indexOf('.') + 1

                if (l - decimalLength <= posiciones){
                return x
                }
                // Parte decimal del número
                var isNeg  = x < 0
                var decimal =  x % 1
                var entera  = isNeg ? Math.ceil(x) : Math.floor(x)
                // Parte decimal como número entero
                // Ejemplo: parte decimal = 0.77
                // decimalFormated = 0.77 * (10^posiciones)
                // si posiciones es 2 ==> 0.77 * 100
                // si posiciones es 3 ==> 0.77 * 1000
                var decimalFormated = Math.floor(
                Math.abs(decimal) * Math.pow(10, posiciones)
                )
                // Sustraemos del número original la parte decimal
                // y le sumamos la parte decimal que hemos formateado
                var finalNum = entera +
                ((decimalFormated / Math.pow(10, posiciones))*(isNeg ? -1 : 1))

                return finalNum
            }
            $(document).ready(function() {
                  $(".alert").fadeOut(5000);
            });
        </script>
    </head>
    <body id="page-top">
        <?php
            $ruta= Route::getCurrentRoute()->getActionName();
            $accion=explode('@', Route::getCurrentRoute()->getActionName())[1];
        ?>
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- MENU -->
                @include('elementos.menu')
            <!-- FIN DE MENU -->

            <!-- Contenido -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- BARRA SUPERIOR -->
                      @include('elementos.barrasuperior')
                    <!-- FIN DE BARRA SUPERIOR -->

                    <div class="container-fluid p-0">
                        <!-- CONTENIDO -->
                            @yield('content')
                        <!-- FIN DE CONTENIDO -->
                    </div>
                </div>

                <!-- Footer -->
                  @include('elementos.footer')

                <!-- End of Footer -->
            </div>
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>       

        <!-- JS -->
            <!-- Bootstrap core JavaScript-->
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

            <!--
            Dashmix JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            assets/js/core/jquery.min.js
            assets/js/core/bootstrap.bundle.min.js
            assets/js/core/simplebar.min.js
            assets/js/core/jquery-scrollLock.min.js
            assets/js/core/jquery.appear.min.js
            assets/js/core/js.cookie.min.js
            -->
            <script src="{{ asset('Dashmix/src/assets/js/dashmix.core.min.js') }}"></script>

            <!--
                Dashmix JS

                Custom functionality including Blocks/Layout API as well as other vital and optional helpers
                webpack is putting everything together at assets/_es6/main/app.js
            -->
            <script src="{{ asset('Dashmix/src/assets/js/dashmix.app.min.js') }}"></script>

            <!-- Page JS Plugins -->
            <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js') }}"></script>

            <!-- Maskedinput -->
            <script src="{{ asset('Dashmix/src/assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
            <script src="{{ asset('Dashmix/src/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('Dashmix/src/assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('Dashmix/src/assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

            <!-- manipular los formatos de fechas con JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

            <!-- Page JS Plugins -->
            <script src="{{ asset('Dashmix/src/assets/js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
            <script src="{{ asset('Dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>



            <!-- Page JS Plugins -->
        <script src="{{ asset('Dashmix/src/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('Dashmix/src/assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('Dashmix/src/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('Dashmix/src/assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
        <script src="{{ asset('Dashmix/src/assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('Dashmix/src/assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('Dashmix/src/assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

        <!-- Page JS Code-->

        <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>


        <!-- Page JS Plugins -->
        <script src="{{ asset('Dashmix/src/assets/js/plugins/slick-carousel/slick.min.js') }}"></script>

        <!-- Page JS Code 
        <script src="{{ asset('Dashmix/src/assets/js/pages/be_comp_onboarding.min.js') }}"></script>-->

        

            <script>
                
                //Bloquear la tecla ENTER
                window.addEventListener("keypress", function(event){
                    if (event.keyCode == 13){
                        event.preventDefault();
                    }
                }, false);

                //Permitir solo el ingreso de números
                $(".numero").keydown(function(event){

                    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
                            return false;
                    }
                });

                /*Habilitando tooltip*/
                $(function () {
                  
                  $('[data-toggle="tooltip"]').tooltip();

                  //Dashmix.block('state_toggle', '.block-load');

                });

                $( window ).on("load",function() {
                            
                    //Dashmix.block('state_normal', '.block-mode-loading-refresh');

                });

            </script>
        <!-- FIN DE JS -->

        @include('message/message')
        @include('js/jsvalidation')
    </body>
</html>
