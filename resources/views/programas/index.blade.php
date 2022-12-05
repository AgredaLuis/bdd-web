@extends('plantillas.privada')
@section('content')
<div class="bg-gray-light">
  <div class="content content-full pt-4 pb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
        <i class="fa fa-list-ul fa-fw text-black-50"></i>
        <span class="ml-2 font-size-md text-black">Programas</span>
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item text-black">SIAEPUDO</li>
          <li class="breadcrumb-item text-black-75 active" aria-current="page">Programas</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="content mb-3">

  <h2 class="content-heading pt-0 mb-0 pb-0 border-bottom font-note text-uppercase">Consulte la informacion de los programas registrados</h2>

  <!-- Elements -->
  <div class="block block-rounded block-bordered mt-4">
    <div class="block-header block-header-default bg-white text-left pt-4 pb-2">
        <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom">Listado de Programas</h5>
    </div>
    <div class="block-content">
      <div class="row push">
        <div class="col-12">
          <table class="table table-vcenter table-striped display nowrap table-hover" id="table-oferta-academica" style="width:100%">
            <thead>
                <tr class="text-uppercase tr-thead-table">
                    <th class="font-w700">Programa</th>
                    <th class="font-w700">Acción</th>
                </tr>
            </thead>
            <tbody class="text-uppercase">
                @foreach ($coleccion as $programa)
                <tr>
                    <td>
                        {{$programa->nombre}}
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="{{ route('programas.edit',[ Crypt::encrypt($programa->id) ])}}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                      </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- END Basic Elements -->
    </div>  
  </div>
  <!-- END Elements -->
</div>

<script type="text/javascript">

  $(function () {  

    /*$('#table-oferta-academica').DataTable({
      destroy: true,
      info: true,
      paging: true,
      searching: true,
      ordering: true,
      pageLength:100,
      responsive: true,
      //lengthMenu:[[5,10,-1],[5,10,"TODOS"]],                 
      columns:
      [
        {name:'producto'},
        {name:'categoria'},
        {name:'presentacion'},
      ],
      language: 
      {
        search:"Buscar:",
        loadingRecords:"Cargando Registros...",
        processing:"Procesando...",
        infoPostFix:"",
        paginate:
        { 
          first:"Primero",
          previous:"Previo",
          next:"Proximo",
          last:"Ultimo"
        },
        aria: 
        {
          sortAscending:": activate to sort column ascending",
          sortDescending:": activate to sort column descending"
        },
        info:'Mostrando _START_ a _END_ de <span class="font-w700">_TOTAL_ Registros</span>',
        infoFiltered:'<span class="span-max-registros">(Filtrado de _MAX_ Registros Totales)</span>',
        lengthMenu:"Mostrar _MENU_ Registros por Pagina",
        infoEmpty:"No hay registros disponibles",
        zeroRecords: "NO HAY REGISTROS",
        decimal:",",
        thousands:".",
      },
      dom:
        "<'row'<'col-sm-12 col-md-12 py-2 mb-2'f>>"+
        "<'row row-records'<'col-sm-12'tr>>"+
        "<'row row-info'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });*/

  });  

</script>
        

@endsection