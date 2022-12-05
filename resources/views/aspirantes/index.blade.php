@extends('plantillas.privada')
@section('content')

<div class="bg-gray-light">
  <div class="content content-full pt-4 pb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
        <i class="fa fa-graduation-cap fa-fw text-black-50"></i>
        <span class="ml-2 font-size-md text-black">Aspirantes</span>
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item text-black text-uppercase breadcrumb-item-font">SIAEPUDO</li>
          <li class="breadcrumb-item text-black-75 active text-uppercase breadcrumb-item-font-active" aria-current="page">Aspirantes</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="content mb-3">
  <h2 class="content-heading pt-0 mb-0 pb-0 border-bottom font-note text-uppercase">Consulte la informacion de los aspirantes a los estudios de Postgrados disponibles</h2>
  <!-- Elements -->
  <div class="block block-rounded block-bordered mt-4 block-mode-loading-refresh" id="block-oferta">
    <div class="block-header block-header-default bg-white text-left pt-2 pb-2">
        <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom mt-4">Filtros de Búsqueda</h5>
        <button type="button" class="btn btn-sm btn-dark pt-1 btn-details" id="restart-filter" title="Limpiar Filtros">
          <i class="si si-refresh"></i><span class="text-uppercase ml-2">Limpiar Filtros</span>
        </button>
    </div>
    <div class="block-content">
      <div class="row push">
        <div class="col-3">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Nucleo</label>
            {{
              Form::select(
                'id_nucleo',
                $pluck["Nucleos"],
                null,
                [
                  'class'=>'form-control custom-select text-uppercase font-size-input select-filter',
                  'id'=>'id_nucleo',
                  'empty'=>false,
                  'data-column' => '2'
                ]
              )
            }}
          </div>
        </div>
        <div class="col-9">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Programa</label>
            {{
              Form::text(
                'programa',
                 null,
                [
                  'class'=>'form-control text-uppercase font-size-input input-filter',
                  'id'=>'programa',
                ]
              )
            }}
          </div>         
        </div>
      </div>
      <div class="row push">
        <div class="col-12">
          <div class="block block-rounded js-appear-enabled animated fadeIn bg-gray-lighter" data-toggle="appear">
            <div class="block-content block-content-full border-left border-3x border-dark">             
              <p class="text-muted mb-0 mt-0 font-size-details text-uppercase font-w700 text-center">
                Informacion correspondiente de los aspirantes a los estudios de postgrado ofertados.
              </p>
            </div>
          </div> 
          <table class="table table-vcenter table-striped display nowrap table-hover table-bordered" id="table-aspirantes">
            <thead>
                <tr class="text-uppercase font-size-sm text-center">
                    <th class="font-w700">Cedula</th>
                    <th class="font-w700">Nombres y Apellidos</th>
                    <th class="font-w700">Nucleo</th>
                    <th class="font-w700">Programa</th>
                </tr>
            </thead>
            <tbody class="text-uppercase tbody-font">
                @foreach ($coleccion as $elemento)
                <tr>
                    <td class="text-left">
                        {{$elemento->persona->ci}}
                    </td>
                    <td class="text-left">
                      {{$elemento->persona->nombre}} {{$elemento->persona->apellido}}
                    </td>
                    <td class="text-left">
                      {{$elemento->nucleoprograma->nucleo->nombre}}
                    </td>
                    <td class="text-left">
                      {{$elemento->nucleoprograma->programa->nombre}}
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

  var table;

  $(function () {  

    table = $('#table-aspirantes').DataTable({
      destroy: true,
      info: true,
      paging: true,
      searching: true,
      ordering: false,
      pageLength:50,
      //responsive: true,                 
      columns:
      [
        {name:'cedula'},
        {name:'nombre'},
        {name:'nucleo'},
        {name:'programa'},

      ],
      initComplete: function() {
        this.api().columns([2]).every(function() {
          
          //COLUMNA A EVALUAR
          var column = this;

          //INDEX(NUMERO) DE COLUMNA A EVALUAR
          var columnIndex = column.index();

          //SE CONSTRUYEN LOS SELECT ETAPAS E INSTITUCIONES Y SE LE COLOCA EL EVENTO CHANGE
          var selects = $('select[data-column='+columnIndex+']')/*.append('<option value="" id="-1">Todos</option>')*/
          .on('change', function() {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
              );

              //SE HACE LA BUSQUEDA DEL VALOR SELECCIONADO EN LOS CAMPOS ETAPAS O INSTITUCIONES Y SE MUESTRA EN LA TABLA EL FILTRADO POR ESOS DATOS ENVIADOS
              column
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();

          });

          //SE IDENTIFICAN LOS VALORES UNICOS EN LOS CAMPOS ETAPAS E INSTITUCIONES Y SE MANDAN AL SELECCION. ES UNA AGRUPACION
          /*column.data().unique().sort().each(function(d, j) {

              selects.append('<option value="' + d + '" id="'+j+'">' + d + '</option>');

          });*/
        });
      },
      language: 
      {
        search:"Buscar Programa:",
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
        "<'row row-records'<'col-sm-12'tr>>"+
        "<'row row-info'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });

    $('#programa').on( 'keyup',onInputProgramaKeyup);
    $('#restart-filter').on( 'click',onRestartFilterClick);

  });  

  function onInputProgramaKeyup(){

    table.column(3).search( $(this).val() ).draw();

  }

  function onRestartFilterClick(){

    Dashmix.block('state_toggle', '#block-oferta');

    $('.input-filter').val('');
    $(".select-filter option[value='']").prop("selected",true);

    table.search( '' ).columns().search( '' ).draw();

    setTimeout(function(){ Dashmix.block('state_normal', '#block-oferta'); }, 1000);

  }

</script>
        

@endsection