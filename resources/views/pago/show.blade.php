@extends('plantillas.privada')
@section('content')
<div class="bg-gray-light">
  <div class="content content-full pt-4 pb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
        <i class="fa fa-wallet fa-fw text-black-50"></i>
        <span class="ml-2 font-size-md text-black">{{ "Pago ".$pago->id }}</span>
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
@endsection