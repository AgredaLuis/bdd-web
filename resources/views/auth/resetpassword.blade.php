@extends('plantillas.publica')
@section('content')

    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{ asset('storage/img/avaluos.png') }}');">
            <div class="row no-gutters bg-primary-op">
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
                            <a class="link-fx text-dark font-w700 font-size-h2 text-uppercase" href="javascript:void(0)">
                                <span class="text-dark">Siaep</span><span class="text-dark">UDO</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Restablecer Contraseña</p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign Up Form -->
                        <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <div class="row no-gutters justify-content-center">
                            <div class="col-sm-8 col-xl-6">
                                <form class="js-validation" action="{{ route('password.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="py-3">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email" value="{{ $email }}" placeholder="Correo Electrónico" readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" placeholder="Contraseña" maxlength="15" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg form-control-alt" id="password-confirm" name="password_confirmation" maxlength="15" placeholder="Confirmar Contraseña">
                                        </div>                    
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-hero-lg btn-hero-dark">
                                            <i class="fa fa-fw fa-plus mr-1"></i> Restablecer Contraseña
                                        </button>
                                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                            <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('signin') }}">
                                                <i class="fa fa-sign-in-alt text-muted mr-1"></i> Iniciar Sesión
                                            </a>
                                            <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('newaccount') }}">
                                                <i class="fa fa-plus text-muted mr-1"></i> Crear Cuenta
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END Sign Up Form -->
                    </div>
                </div>
                <!-- END Main Section -->
                <!-- Meta Info Section -->
                <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                    <div class="p-3">                        
                        <p class="font-size-h5 font-w600 text-white-75 mb-0">
                            <i class="si si-lock fa-2x"></i>
                        </p>
                        <p class="display-4 font-w700 text-white mb-0 text-uppercase font-w700 font-size-note">
                            Cambia tus credenciales
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

@endsection