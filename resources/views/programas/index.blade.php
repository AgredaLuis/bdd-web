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
                $pluck["Nucleos"],
                null,
                [
                  'class'=>'js-select2 form-control custom-select text-uppercase font-size-input',
                  'required'=>true,
                  'id'=>'id_nucleo',
                  'empty'=>false,
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
                ['default' => 'Seleccione...'],
                null,
                [
                  'class'=>'js-select2 form-control custom-select text-uppercase font-size-input select-disabled',
                  'required'=>true,
                  'id'=>'id_programa',
                  'empty'=>false,
                ]
              )
            }}
          </div>
        </div>
      </div>
      <div class="row push">
        <div class="col-4">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Modalidad</label>
            {{
              Form::text(
                'modalidad',
                 null,
                [
                  'class'=>'form-control text-uppercase font-size-input',
                  'id'=>'modalidad',
                  'required'=>true,
                  'readonly'=>true,
                ]
              )
            }}
          </div>
        </div>
        <div class="col-8">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Area</label>
            {{
              Form::text(
                'area',
                 null,
                [
                  'class'=>'form-control text-uppercase font-size-input',
                  'id'=>'area',
                  'required'=>true,
                  'readonly'=>true,
                ]
              )
            }}
          </div>
        </div>
      </div>
      <div class="row push">
        <div class="col-4">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Grado</label>
            {{
              Form::text(
                'grado',
                 null,
                [
                    'class'=>'form-control text-uppercase font-size-input',
                    'id'=>'grado',
                    'required'=>true,
                    'readonly'=>true,
                ]
              )
            }}
          </div>
        </div>
        <div class="col-8">
          <div class="form-group">
            <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Mencion</label>
            {{
              Form::select(
                'mencion',
                ['individual' => 'Individual','promocion' => 'Promoción'],
                null,
                [
                  'class'=>'form-control custom-select text-uppercase font-size-input',
                  'required'=>true,
                  'id'=>'mencion',
                  'empty'=>false,
                ]
              )
            }}
          </div>
        </div>
      </div>

      <div class="row push">
        <div class="col-12">
          <table class="table table-vcenter table-striped display nowrap table-hover" id="table-oferta-academica" style="width:100%">
            <thead>
                <tr class="text-uppercase tr-thead-table">
                    <th class="font-w700">Núcleo</th>
                    <th class="font-w700">Programa</th>
                    <th class="font-w700">Mención</th>
                </tr>
            </thead>
            <tbody class="text-uppercase">
                @foreach ($coleccion as $elemento)
                <tr>
                    <td>
                        {{$elemento->id_nucleo}}
                    </td>
                    <td >
                        {{$elemento->id_programa}}
                    </td>
                    <td>
                        {{$elemento->cod_udo}}
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- END Basic Elements -->
    </div>
    <div class="block-content block-content-full block-content-sm bg-body-light text-center">
        <button type="submit" class="btn btn-hero-info">
            <i class="fa fa-save"></i> Guardar
        </button>
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
    });

  });  

</script>
        

@endsection