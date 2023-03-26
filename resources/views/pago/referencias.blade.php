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

  <form action="{{ url('referencias/importar')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3 col-5">
      <label for="imagen_comprobante" class="form-label">Arvhico de tablas(.xlsx)</label>
      <input type="file" name="documento" class="form-control-file">
    </div>

    <!-- <div class="col-md-6">
      <input type="file" name="documento">
    </div> -->
    <button type="submit" class="btn btn-sm btn-dark p-2 btn-details ml-2" id="restart-filter" title="Limpiar Filtros">
      <i class="fa fa-credit-card text-light"></i><span class="text-uppercase ml-2 text-light">Actulizar Referencias</span>
    </button>

  </form>


  @endsection