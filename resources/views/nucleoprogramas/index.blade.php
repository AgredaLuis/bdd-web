@extends('plantillas.privada')
@section('content')

<div class="bg-gray-light">
  <div class="content content-full pt-4 pb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
        <i class="fa fa-graduation-cap fa-fw text-black-50"></i>
        <span class="ml-2 font-size-md text-black">Oferta Academica</span>
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item text-black text-uppercase breadcrumb-item-font">SIAEPUDO</li>
          <li class="breadcrumb-item text-black-75 active text-uppercase breadcrumb-item-font-active" aria-current="page">Oferta Academica</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="content mb-3">
  <h2 class="content-heading pt-0 mb-0 pb-0 border-bottom font-note text-uppercase">Consulte la informacion de los estudios de Postgrados disponibles</h2>
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
                  'data-column' => '0'
                ]
              )
            }}
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Tipo</label>
            {{
              Form::select(
                'tipo',
                $pluck["Tipos"],
                null,
                [
                  'class'=>'form-control custom-select text-uppercase font-size-input select-filter',
                  'id'=>'tipo',
                  'empty'=>false,
                  'data-column' => '1'
                ]
              )
            }}
          </div>
        </div>
        <div class="col-6">
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
                Informacion correspondiente a los estudios de postgrado ofertados.
              </p>
            </div>
          </div> 
          <table class="table table-vcenter table-striped display nowrap table-hover table-bordered" id="table-oferta-academica">
            <thead>
                <tr class="text-uppercase font-size-sm text-center">
                    <th class="font-w700">Núcleo</th>
                    <th class="font-w700">Tipo</th>
                    <th class="font-w700">Programa</th>
                    <th class="font-w700">Detalles</th>
                </tr>
            </thead>
            <tbody class="text-uppercase tbody-font">
                @foreach ($coleccion as $elemento)
                <tr>
                    <td class="text-center">
                        {{$elemento->nucleo}}
                    </td>
                    <td class="text-center">
                        {{$elemento->tipo}}
                    </td>
                    <td>
                      <p class="font-w700 mb-0 text-uppercase text-xwork-light">{{ $elemento->programa }}</p>
                      @if (!is_null($elemento->mencion))
                        <p class="text-muted mt-1 mb-0 text-uppercase">Mención: {{ $elemento->mencion }}</p>
                      @endif
                    </td>
                    <td class="text-center p-2">
                      <a href="{{ route('nucleoprogramas.edit',[ Crypt::encrypt($elemento->id) ])}}" class="btn btn-secondary btn-sm pt-2" title="Ver Detalles" style="width: 50%;">
                        <i class="si si-speech fa-2x i-font-details"></i>
                      </a>
                      <!--<a href="{{ route('nucleoprogramas.edit',$elemento->id)}}" class="btn btn-sm btn-outline-secondary pt-2 btn-font-details" title="Ver Detalles" style="width: 50%;" data-status="{{is_null($elemento->programacion)?'inactive':'active'}}">
                        <i class="i-font-details i-details"></i>
                        <p class="m-0 font-w700 p-font-details p-details"></p>
                      </a>-->
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

    table = $('#table-oferta-academica').DataTable({
      destroy: true,
      info: true,
      paging: true,
      searching: true,
      ordering: false,
      pageLength:50,
      //responsive: true,                 
      columns:
      [
        {name:'nucleo', orderable:false},
        {name:'tipo', orderable:false},
        {name:'programamencion', orderable:false},
        {name:'detalles', orderable:false},

      ],
      initComplete: function() {
        this.api().columns([0,1]).every(function() {
          
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

    $('a[data-status="active"]').find(".p-details").text("Postularse");
    $('a[data-status="inactive"]').find(".p-details").text("No");

    $('a[data-status="active"]').find(".i-details").addClass("si si-pin fa-2x ");
    $('a[data-status="inactive"]').find(".i-details").addClass("si si-ban fa-2x ");

  });  

  function onInputProgramaKeyup(){

    table.column(2).search( $(this).val() ).draw();

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