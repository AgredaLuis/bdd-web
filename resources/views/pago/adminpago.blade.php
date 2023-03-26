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
    <table class="table table-vcenter table-striped display nowrap table-hover table-bordered" id="table-aspirantes">
      <thead>
        <tr class="text-uppercase font-size-sm text-center">
          <th class="font-w700">Fecha Deposito</th>
          <th class="font-w700">N Ref</th>
          <th class="font-w700">Banco</th>
          <th class="font-w700">Estudiante</th>
          <th class="font-w700">Vauche</th>
          <th class="font-w700">DB Fecha</th>
          <th class="font-w700">DB Ref</th>
          <th class="font-w700">Confirmar</th>
        </tr>
      </thead>
      <tbody class="text-uppercase tbody-font">
        @foreach($pagos as $pago)
          @if($pago->procesado == 0)
            <tr>
              <td class="text-left">
                {{ $pago->fechaPago }}
              </td>
              <td class="text-left">
                {{ $pago->referencia }}
              </td>
              <td class="text-left">
                {{ $pago->bancoEmisor }}
              </td>
              <td class="text-left">
                {{ $pago->persona->ci }}
              </td>
              <td class="text-left">
                {{ 'Imagen por subir' }}
              </td>
              @if($pago->hasReferencia($pago->referencia))
                <td class="text-left">
                  {{ 'Referencia de fecha concuerda' }}
                </td>
                <td class="text-left">
                  {{ 'Numero de referencia concuerda' }}
                </td>
                <td>
                  <a href="{{ route('pago.confirmar',$pago->id) }}">Confirmar</a>
                </td>
              @else
                <td class="text-left">
                  {{ 'No existe en la db una referencia a este pago' }}
                </td>
                <td class="text-left">
                  {{ 'No existe en la db una referencia a este pago' }}
                </td>
                <td>
                  {{ 'No se puede confirmar' }}
                </td>
              @endif
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  <br />
  <button type="button" class="btn btn-sm btn-dark pt-1 btn-details">
    <a class="nav-link" href={{ route('pago.referencias') }}>
      <i class="fa fa-credit-card text-light"></i><span class="text-uppercase ml-2 text-light">Ingresar Documento excel</span>
    </a>
  </button>
  @endsection