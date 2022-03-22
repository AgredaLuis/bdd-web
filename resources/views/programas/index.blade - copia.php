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

    $(".select-disabled").attr("disabled",true);
    $('#id_nucleo').on('change',onSelectNucleoChange);

  });

  function onSelectNucleoChange(){

    if($(this).val() === 'default'){

      $('#id_programa').html('<option value="default" selected>'+'Seleccione...'+'</option>');          
      $('#id_programa').attr("disabled",true);  
      return;

    }

    //AJAX
    $.ajax({
      url:"{{ url('ProgramaNucleo') }}",
      type:"GET",
      data: {'id_nucleo': $(this).val()},
      dataType:'json',
      success: function(data){

        $('#id_programa').attr("disabled",false);   

        html_select = '<option value="default" selected>Seleccione...</option>';

        if(Object.keys(data).length == 0){}
        else{

          $.each(data, function(index,accountObj){
            html_select += '<option value="'+accountObj.id+'">Por Cargar</option>';
          });

        }

        $('#id_programa').html(html_select);
        $("#id_programa option[value='default']").prop("selected",true);     

      },
      error: function(){

      }

    });

  }

</script>
        

@endsection