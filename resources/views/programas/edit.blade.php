@extends('plantillas.privada')
@section('content')

<div class="bg-gray-light">
  <div class="content content-full pt-4 pb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
        <i class="fa fa-address-card fa-fw text-black-50"></i>
        <span class="ml-2 font-size-md text-black">Programa</span>
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item text-black text-uppercase breadcrumb-item-font">SIAEPUDO</li>
          <li class="breadcrumb-item text-black-75 text-uppercase active breadcrumb-item-font-active" aria-current="page">Programa</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="content mb-3">
  <h2 class="content-heading pt-0 mb-0 pb-0 border-bottom font-note text-uppercase">Ingrese toda la información solicitada</h2>
    <!-- FORMULARIO -->
    {{ Form::model($Programa, ['action' => ['ProgramaController@update', $Programa->id>0?$Programa->id:-1,'index', $pluck["ubicacion"]!="Crear"?$Programa->id:0], 'id' => 'ProgramaEditForm','method' => 'put','enctype'=>'multipart/form-data', 'role'=>'form','class'=>'form-horizontal js-validation','data-smk-icon' => 'glyphicon-remove-sign']) }}
      <!-- Elements -->
      <div class="block block-rounded block-bordered mt-4 block-mode-loading-refresh" id="block-datos-personales">       
        <div class="block-header block-header-default bg-white text-left pt-2 pb-2">
            <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom mt-2">Información del Programa</h5>
        </div>    
        <div class="block-content">
          <div class="row push">
            <div class="col-12">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Programa</label>
                {{
                  Form::text(
                    'nombre',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input required-form',
                      'id'=>'nombre',
                      'required'=>true,
                    ]
                  )
                }}
              </div>
            </div>
          </div>
          <div class="row push">
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Area</label>
                {{
                  Form::select(
                    'id_area',
                    $pluck["Areas"],
                    $Programa->id>0?$Programa->id_area:null,
                    [
                      'class'=>'js-select2 form-control custom-select text-uppercase font-size-input select-required-form',
                      'required'=>true,
                      'id'=>'id_area',
                      'empty'=>false,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Grado</label>
                {{
                  Form::select(
                    'id_grado',
                    $pluck["Grados"],
                    $Programa->id>0?$Programa->id_grado:null,
                    [
                      'class'=>'js-select2 form-control custom-select text-uppercase font-size-input select-required-form',
                      'required'=>true,
                      'id'=>'id_grado',
                      'empty'=>false,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Modalidad</label>
                {{
                  Form::select(
                    'id_modalidad',
                    $pluck["Modalidades"],
                    $Programa->id>0?$Programa->id_modalidad:null,
                    [
                      'class'=>'js-select2 form-control custom-select text-uppercase font-size-input select-required-form',
                      'required'=>true,
                      'id'=>'id_modalidad',
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
    {{ Form::close() }}
    <!-- END FORMULARIO -->  
</div>
        
<script type="text/javascript">

  $(function () {   

    /*$("#ProgramaEditForm").submit(function( event ) {

      Dashmix.block('state_toggle', '#block-datos-personales');

      if ($("#PersonaEditForm").valid()) 
      {

        AuxFechaSeparar = $('#fecha_nacimiento').val().split("/",3);
        AuxFechaNAcimiento = AuxFechaSeparar[2] + '-' + AuxFechaSeparar[1] + '-' + AuxFechaSeparar[0];
        $('#fecha_nacimiento').val(AuxFechaNAcimiento);

        var Model = new Array("Titulo");
        var params = [];
        var paramsTotal=0;
        var ingresar;

        $.each( Model, function( key, value ) {

          paramsTotal = $(".row-details").find('[data-role='+value+']').length;

          if( paramsTotal != 0){

            var inputParams = {};
            inputParams["Model"] = value;
            ingresar=true;
            var encontro=false;

            $(".row-details").find('[data-role='+value+']').each(function(i, input) {

              if(!$(input).attr("disabled")){

                if($(input).attr('data-type') == 'Select'){

                  $(input).find('option').each(function(){

                    if(inputParams[$(input).attr('data-name')] == undefined ){

                      inputParams[$(input).attr('data-name')] = $(this).val();
                      encontro=true;

                    }
                    else
                    {

                      params.push(inputParams);
                      inputParams = {};
                      inputParams["Model"] = value;
                      inputParams[$(input).attr('data-name')] = $(this).val();
                      encontro=true;

                    }                                                        
                      
                  });

                }
                else{

                  if(inputParams[$(input).attr('data-name')] == undefined ){

                    if($(input).attr('data-type') == 'Checkbox'){

                      if($(input).is(':checked')){

                        inputParams[$(input).attr('data-name')] = 'U'; 
                        encontro=true;

                      }else{

                        inputParams[$(input).attr('data-name')] = 'N';
                        encontro=true; 

                      }

                    }
                    else{

                      if($(input).attr('data-type') == 'Table')
                      {
                        inputParams[$(input).attr('data-name')] = $(input).attr('data-value');
                      }
                      else
                      {
                        inputParams[$(input).attr('data-name')] = $(input).val();
                      }
                      
                      encontro=true;

                    }
                      
                  }
                  else
                  {     

                    params.push(inputParams);
                    inputParams = {};
                    inputParams["Model"] = value;

                    if($(input).attr('data-type') == 'Checkbox'){

                      if($(input).is(':checked')){

                        inputParams[$(input).attr('data-name')] = 'U';
                        encontro=true; 

                      }else{

                        inputParams[$(input).attr('data-name')] = 'N';
                        encontro=true; 

                      }

                    }
                    else{

                      if($(input).attr('data-type') == 'Table')
                      {
                        inputParams[$(input).attr('data-name')] = $(input).attr('data-value');
                      }
                      else
                      {
                        inputParams[$(input).attr('data-name')] = $(input).val();
                      }
                      
                      encontro=true;

                    }

                  }

                }

              }
              else
              {   
                ingresar=false;
              }                                          
              
            });

            if(ingresar || encontro){

              params.push(inputParams);

            }                                

          }

        });

        $('.no-submit').prop("disabled",true); 
          
        json= JSON.stringify(params);
        $('#detallesmodel').val(json);

      }
      else{
        Dashmix.block('state_normal', '#block-datos-personales');
      }      
      
    });*/

  });

</script>

@endsection