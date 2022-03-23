@extends('plantillas.publica')
@section('content')
    
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{ asset('storage/img/avaluos.png') }}');">            
            <div class="row no-gutters bg-gd-sea-op">
                <!-- Main Section -->
                <div class="hero-static col-md-6 d-flex align-items-center bg-white border-right border-4x">

                    <div class="p-3 w-100">
                        <!-- Header -->
                        <div class="mb-2 py-2 text-center">
                            <a class="img-link" href="javascript:void(0);">
                                <img class="img-fluid" style="width: 120px;" alt="SIAEPUDO" src="{{ asset('storage/'.session()->get('Configuracion.Web.logo')) }}"/>
                            </a>
                        </div>

                        <div class="mb-3 text-center">
                            <a class="link-fx text-info font-w700 font-size-h2 text-uppercase" href="javascript:void(0)">
                                <span class="text-dark">Siaep</span><span class="text-info">UDO</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Iniciar Sesión</p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <div class="row no-gutters justify-content-center">
                            <div class="col-sm-8 col-xl-6">
                                <form class="js-validation" action="{{ route('signin') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="text" class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Correo Electrónico">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg form-control-alt form-control-user @error('password') is-invalid @enderror" id="password" name="password" maxlength="15" placeholder="Contraseña" autocomplete="password">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" onclick="mostrarPassword();" style="cursor:pointer;border-color: #f4f6fa;">
                                                    <i class="fa fa-eye-slash icon"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-hero-lg btn-hero-info">
                                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Iniciar Sesión
                                        </button>
                                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                            <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('forgotpassword') }}">
                                                <i class="fa fa-exclamation-triangle text-muted mr-1"></i> Olvidé Contraseña
                                            </a>
                                            <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('newaccount') }}">
                                                <i class="fa fa-plus text-muted mr-1"></i> Crear Cuenta
                                            </a>
                                        </p>
                                    </div>                                 
                                </form>
                            </div>
                        </div>
                        <!-- END Sign In Form -->
                    </div>

                </div>
                <!-- END Main Section -->
                <!-- Meta Info Section -->
                <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                    <div class="p-3">                        
                        <p class="font-size-h5 font-w600 text-white-75 mb-0">
                            <i class="si si-graduation fa-2x"></i>
                        </p>
                        <p class="display-4 font-w700 text-white mb-0 text-uppercase font-w700 font-size-note">
                            Ingresa y Prepárate con nosotros
                        </p>
                    </div>
                </div>
                <!-- END Meta Info Section -->
            </div>
        </div>
        <!-- END Page Content -->

    </main>
    <!-- END Main Container -->

    <!-- Page JS Plugins -->
        <script src="{{ asset('Dashmix/src/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('Dashmix/src/assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('Dashmix/src/assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('Dashmix/src/assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    
    <script type="text/javascript">
        /**
         * Permite mostrar contrasena visualmente
         *
         */
        function mostrarPassword(){
            var password = document.getElementById("password");
            if(password.type == "password"){
                password.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                password.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    </script>
@endsection
