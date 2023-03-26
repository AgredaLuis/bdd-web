@extends('plantillas.privada')
@section('content')
<div class="bg-gray-light">
  <div class="content content-full pt-4 pb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
        <i class="fa fa-wallet fa-fw text-black-50"></i>
        <span class="ml-2 font-size-md text-black">Mis Pagos</span>
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item text-black text-uppercase breadcrumb-item-font">SIAEPUDO</li>
          <li class="breadcrumb-item text-black-75 active text-uppercase breadcrumb-item-font-active" aria-current="page">MIS PAGOS</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="col-12">
  <div class="block block-rounded js-appear-enabled animated fadeIn bg-gray-lighter" data-toggle="appear">
    <div class="block-content block-content-full border-left border-3x border-dark">
      <p class="text-muted mb-0 mt-0 font-size-details text-uppercase font-w700 text-center">
        Informacion correspondiente de depositos por favor mantenerlo estos datos en privado.
      </p>
    </div>
  </div>
  <div class="block block-rounded block-bordered mt-4 block-mode-loading-refresh" id="block-oferta">
    <div class="block-header block-header-default bg-white text-left pt-2 pb-2">
      <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom mt-4">Registrar dato de pago</h5>
    </div>
    <!-- <div class="block-header block-header-default bg-white text-left pt-2 pb-2"> -->

      <form action={{ route('pago.store') }} method="POST" enctype="multipart/form-data">
        @csrf
        <div id="OpcionSeleccionada"></div>
        <div class="mb-3 col-5">
          <label for="exampleInputEmail1" class="form-label">Numero de referencia</label>
          <input type="text" name="referencia" class="form-control" id="referemcoa" placeholder="002555343" aria-describedby="emailHelp">
        </div>

        <div class="mb-3 col-5">
          <label for="BancoEmisor" class="form-label">Banco Emisor</label>
          <input type="text" name="bancoEmisor" id="bancoEmisor" class="form-control" placeholder="Banesco">
        </div>

        <div class="mb-3 col-5">
          <label for="fechaPago" class="form-label">Fecha realizado</label>
          <input type="date" name="fechaPago" id="fechaPago" class="form-control" placeholder="Fecha de pago">
        </div>

        <div class="mb-3 col-5">
          <label for="descripcion" class="form-label">Descripcion</label>
          <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Pago del curso ....">
        </div>

        <div class="mb-3 col-5">
          <label for="pdf" class="form-label">Captura de pago(.pdf)</label>
          <input type="file" name="pdf" class="form-control-file" id="pdf">
        </div>

        <div class="mb-3 col-5">
          <label for="monto" class="form-label">Monto</label>
          <input type="text" name="monto" class="form-control" placeholder="monto en numeros enteros" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>


        <!-- <input type="text" name="referencia" id="referencia" placeholder="Numero de Referencia">
          <input type="text" name="bancoEmisor" id="bancoEmisor" placeholder="Banco Emisor"> -->
        <!-- <input type="date" name="fechaPago" id="fechaPago" placeholder="Fecha de pago"> -->
        <!-- <input type="text" name="descripcion" id="descripcion" placeholder="Decripcion"> -->
        <!-- <input type="text" name="monto"  disabled="true" value=25 id="monto" placeholder="Monto"> -->

    <!-- </div> -->
    <br>
    <div class="pl-4 pb-4">
    <button type="submit" class="btn btn-sm btn-dark pt-2 p-2 btn-details" id="restart-filter" title="Limpiar Filtros">
      <i class="fa fa-credit-card"></i><span class="text-uppercase ml-2 p-2 ">Guardar</span>
    </button>
    </div>
    </form>

  </div>
  @endsection