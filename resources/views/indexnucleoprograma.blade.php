@extends('plantillas.privada')
@section('content')
<div class="bg-gray-light">
  <div class="content content-full pt-4 pb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
        <i class="fa fa-list-ul fa-fw text-black-50"></i>
        <span class="ml-2 font-size-md text-black">Oferta Academica</span>
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item text-black">SIAEPUDO</li>
          <li class="breadcrumb-item text-black-75 active" aria-current="page">Oferta Academica</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="content mb-3">

  <h2 class="content-heading pt-0 mb-0 pb-0 border-bottom font-note">Consulte la informacion de los estudios de Postgrados disponibles</h2>

  <!-- Elements -->
  <div class="block block-rounded block-bordered mt-4">
    <div class="block-header block-header-default bg-white text-left pt-4 pb-2">
        <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom">Datos del Programa</h5>
    </div>
    <div class="block-content">
      <div class="row push">
        <div class="col-4">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Nucleo</label>
            {{
              Form::select(
                'id_nucleo',
                array(),
                null,
                [
                  'class'=>'form-control custom-select text-uppercase font-size-input',
                  'id'=>'id_nucleo',
                  'empty'=>false,
                  'data-column' => '0'
                ]
              )
            }}
          </div>
        </div>
        <div class="col-8">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Programa</label>
            {{
              Form::select(
                'id_programa',
                array(),
                null,
                [
                  'class'=>'form-control custom-select text-uppercase font-size-input',
                  'id'=>'id_programa',
                  'empty'=>false,
                  'data-column' => '2'
                ]
              )
            }}
          </div>
        </div>
      </div>
      <div class="row push">
        <div class="col-12">
          <p class="text-muted text-center">
            Informacion correspondiente a los estudios de Postgrados ofertados
          </p> 
          <table class="table table-vcenter table-striped display nowrap table-hover table-bordered" id="table-oferta-academica">
            <thead>
                <tr class="text-uppercase font-size-sm text-center">
                    <th class="font-w700">Núcleo</th>
                    <th class="font-w700">Programa</th>
                    <th class="font-w700"></th>
                </tr>
            </thead>
            <tbody class="text-uppercase">
                @foreach ($coleccion as $elemento)
                <tr class="font-size-table">
                    <td>
                        {{$elemento->nucleo}}
                    </td>
                    <td class="font-size-table">
                      <p class="font-w700 mb-0 text-uppercase text-xwork-light">{{ $elemento->programa }}</p>
                      @if (!is_null($elemento->mencion))
                        <p class="text-muted mt-1 mb-0 text-uppercase">Mención: {{ $elemento->mencion }}</p>
                      @endif
                    </td>
                    <td>
                        {{$elemento->programa}}
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

    $('#table-oferta-academica').DataTable({
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
        {name:'programamencion', orderable:false},
        {name:'programa', orderable:false, visible:false},

      ],
      initComplete: function() {
        this.api().columns([0,2]).every(function() {
          
          //COLUMNA A EVALUAR
          var column = this;

          //INDEX(NUMERO) DE COLUMNA A EVALUAR
          var columnIndex = column.index();

          //SE CONSTRUYEN LOS SELECT ETAPAS E INSTITUCIONES Y SE LE COLOCA EL EVENTO CHANGE
          var selects = $('select[data-column='+columnIndex+']').append('<option value="" id="-1">Todos</option>')
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
          column.data().unique().sort().each(function(d, j) {

              selects.append('<option value="' + d + '" id="'+j+'">' + d + '</option>');

          });
        });
      },
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
        "<'row row-records'<'col-sm-12'tr>>"+
        "<'row row-info'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });

  });  

</script>
        

@endsection