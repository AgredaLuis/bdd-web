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
                    <!-- <th class="font-w700">Id</th> -->
                    <th class="font-w700">N Ref</th>
                    <th class="font-w700">Banco Emisor</th>
                    <th class="font-w700">Fecha Pago</th>
                    <th class="font-w700">Descripcion</th>
                    <th class="font-w700">Monto</th>
                    <th class="font-w700">Procesado</th>
                </tr>
            </thead>
            <tbody class="text-uppercase tbody-font">
              @foreach($pagos as $pago)
                <tr>
                    <!-- <td class="text-center">
                      <a href="{{ route('pago.show', $pago) }}">{{ $pago->id }}</a>
                    </td> -->
                    <td class="text-left">
                      {{ $pago->referencia }}
                    </td>
                    <td class="text-left">
                      {{ $pago->bancoEmisor }}
                    </td>
                    <td class="text-left">
                      {{ $pago->fechaPago }}
                    </td>
                    <td class="text-left">
                      {{ $pago->descripcion }}
                    </td>
                    <td class="text-center">
                      {{ $pago->monto }}
                    </td>
                    @if ($pago->procesado == 0)
                      <td class="text-center text-warning">
                        Procesando
                      </td>
                    @else
                      <td class="text-center text-success">
                          Procesado
                      </td>
                    @endif
                </tr>
              @endforeach()
            </tbody>
          </table>
          <div class="row">
            <button type="button" class="btn btn-sm btn-dark pt-1 btn-details" id="restart-filter" title="Limpiar Filtros">
              <a class="nav-link" href={{ route('pago.new') }}>
                <i class="fa fa-credit-card text-light"></i><span class="text-uppercase ml-2 text-light">Ingresar Deposito</span>
              </a>
            </button>
            <button type="button" class="btn btn-sm btn-dark pt-1 btn-details" id="restart-filter" title="Limpiar Filtros">
              <i class="fa fa-search"></i><span class="text-uppercase ml-2 ">Buscar Deposito</span>
            </button>
          </div>
@endsection

