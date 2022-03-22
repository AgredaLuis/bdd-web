@extends('plantillas.publica')
@section('content')

    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{ asset('storage/img/avaluos.png') }}');">
            <div class="row no-gutters bg-gd-lake-op">
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
                            <a class="link-fx text-success font-w700 font-size-h2 text-uppercase" href="javascript:void(0)">
                                <span class="text-dark">Siaep</span><span class="text-success">UDO</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Crear Cuenta de Usuario</p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign Up Form -->
                        <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <div class="row no-gutters justify-content-center">
                            <div class="col-sm-8 col-xl-6">
                                <form class="js-validation" action="{{ route('register') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="role" name="role" value="4">
                                    <div class="py-3">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email" placeholder="Correo Electrónico" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg form-control-alt js-maxlength" id="password" name="password" maxlength="15" placeholder="Contraseña" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-danger" data-placement="right">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg form-control-alt js-maxlength" id="password_confirmation" name="password_confirmation" maxlength="15" placeholder="Confirmar Contraseña" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-danger" data-placement="right">
                                        </div>                    
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-hero-lg btn-hero-success">
                                            <i class="fa fa-fw fa-plus mr-1"></i> Crear Cuenta de Usuario
                                        </button>
                                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                            <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('login') }}">
                                                <i class="fa fa-sign-in-alt text-muted mr-1"></i> Iniciar Sesión
                                            </a>
                                            <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('forgotpassword') }}">
                                                <i class="fa fa-exclamation-triangle text-muted mr-1"></i> Olvidé Contraseña
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
                            <i class="si si-user-follow fa-2x"></i>
                        </p>
                        <p class="display-4 font-w700 text-white mb-0 text-uppercase font-w700 font-size-note">
                            Registrate con tus credenciales
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

@endsection
