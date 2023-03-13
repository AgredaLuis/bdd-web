@extends('plantillas.privada')
@section('content')
<div class="bg-gray-light">
    <div class="content content-full pt-4 pb-4">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
                <i class="fa fa-home fa-fw text-black-50"></i>
                <span class="ml-2 font-size-md text-black">Inicio</span>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item text-black text-uppercase breadcrumb-item-font">SIAEPUDO</li>
                    <li class="breadcrumb-item text-black-75 active text-uppercase breadcrumb-item-font-active" aria-current="page">Inicio</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Onboarding Modal -->
<div class="modal fade" id="modal-onboarding" tabindex="-1" role="dialog" aria-labelledby="modal-onboarding" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded overflow-hidden bg-image" style="background-image: url('Dashmix/src/assets/media/photos/photo24.jpg')">
            <div class="row">
                <div class="col-md-5">
                    <div class="p-3 text-right text-md-left">
                        <a class="font-w600 text-white text-uppercase font-w700" href="#" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-share text-danger-light mr-1"></i> Salir
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-white shadow-lg">
                        <div class="js-slider slick-dotted-inner" data-dots="true" data-arrows="false" data-infinite="false">
                            <div class="p-4">
                                <i class="fa fa-award fa-3x text-muted my-4"></i>
                                <h3 class="font-size-sm mb-2 text-uppercase font-w700">Bienvenido a SIAEPUDO</h3>
                                <p class="text-muted">
                                    This is a modal you can show to your users when they first sign in to their dashboard. It is a great place to welcome and introduce them to your application and its functionality.
                                </p>
                                <div class="text-left">
                                    <button type="button" class="btn btn-sm btn-dark mb-4 text-uppercase btn-details" onclick="jQuery('.js-slider').slick('slickGoTo', 1);">
                                        Más información <i class="fa fa-arrow-right ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="slick-slide p-4">
                                <h3 class="font-size-sm mb-2 text-uppercase font-w700">Oferta Académica</h3>
                                <p class="text-muted">
                                    They are sent automatically to your clients with the completion of every project, so you don't have to worry about getting paid.
                                </p>
                                <h3 class="font-size-sm mb-2 text-uppercase font-w700">Prepárate con nosotros</h3>
                                <p class="text-muted">
                                    Backups are taken with every new change to ensure complete piece of mind. They are kept safe for immediate restores.
                                </p>
                                <div class="text-center">
                                    <a type="button" class="btn btn-sm btn-dark mb-4 text-uppercase btn-details" href="{{ route('personas.edit',[ Crypt::encrypt(isset(auth()->user()->persona->id)?auth()->user()->persona->id:-1) ])}}">
                                    Registrar datos personales <i class="fa fa-address-card ml-1"></i>
                                    </a>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Onboarding Modal -->

<script type="text/javascript">

    $(function () {  

        @if ( !isset($pluck['Persona']) )            
            $("#modal-onboarding").modal("show");
        @endif 

        $("#modal-onboarding").on("shown.bs.modal",function(n){

            $("js-slider","#modal-onboarding").removeClass("js-slider-enabled");
            Dashmix.helpers("slick");

        });

    });  

</script>

@endsection