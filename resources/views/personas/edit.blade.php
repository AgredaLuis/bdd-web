@extends('plantillas.privada')
@section('content')

<div class="bg-gray-light">
  <div class="content content-full pt-4 pb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="block-title text-uppercase font-w700 pt-1 vertical-align">
        <i class="fa fa-address-card fa-fw text-black-50"></i>
        <span class="ml-2 font-size-md text-black">Mis Datos Personales</span>
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item text-black text-uppercase breadcrumb-item-font">SIAEPUDO</li>
          <li class="breadcrumb-item text-black-75 text-uppercase active breadcrumb-item-font-active" aria-current="page">Mis Datos Personales</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="content mb-3">
  <h2 class="content-heading pt-0 mb-0 pb-0 border-bottom font-note text-uppercase">Ingrese toda la información solicitada</h2>
    <!-- FORMULARIO -->
    {{ Form::model($Persona, ['action' => ['PersonaController@update', $Persona->id>0?$Persona->id:-1,'edit', $pluck["ubicacion"]!="Crear"?$Persona->id:0], 'id' => 'PersonaEditForm','method' => 'put','enctype'=>'multipart/form-data', 'role'=>'form','class'=>'form-horizontal js-validation','data-smk-icon' => 'glyphicon-remove-sign']) }}
      {{ Form::hidden('nacionalidad',null,['id'=>'nacionalidad'])}}
      {{ Form::hidden('detallesmodel',null,['id'=>'detallesmodel'])}}
      <!-- Elements -->
      <div class="block block-rounded block-bordered mt-4 block-mode-loading-refresh" id="block-datos-personales">       
        <div class="block-header block-header-default bg-white text-left pt-2 pb-2">
            <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom mt-2">Información Personal</h5>
        </div>    
        <div class="block-content">
          <div class="row push">
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Cédula</label>
                <div class="input-group">
                  <div class="btn-group mr-1 mb-2" role="group">                      
                    <button type="button" class="btn btn-outline-secondary btn-form-disabled btn-nacionalidad active" name="btn-nacionalidad" data-info="V">V</button>
                    <button type="button" class="btn btn-outline-secondary btn-form-disabled btn-nacionalidad" name="btn-nacionalidad" data-info="E">E</button>
                  </div>                        
                  {{
                    Form::text(
                      'ci',
                       null,
                      [
                        'class'=>'form-control text-uppercase font-size-input input-readonly numero required-form form-check-cedula',
                        'id'=>'ci',
                        'required'=>true,
                      ]
                    )
                  }}
                  {{ Form::hidden('check-cedula',null,['id'=>'check-cedula','class'=>'no-submit'])}}
                </div>                    
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Nombres</label>
                {{
                  Form::text(
                    'nombre',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly required-form',
                      'id'=>'nombre',
                      'required'=>true,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Apellidos</label>
                {{
                  Form::text(
                    'apellido',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly required-form',
                      'id'=>'apellido',
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
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Genero</label>
                {{
                  Form::select(
                    'genero',
                    ['default' => 'Seleccione...','M' => 'Masculino','F' => 'Femenino'],
                    $Persona->id>0?null:$Persona->genero,
                    [
                      'class'=>'form-control custom-select text-uppercase font-size-input select-disabled select-required-form',
                      'required'=>true,
                      'id'=>'genero',
                      'empty'=>false,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Estado Civil</label>
                {{
                  Form::select(
                    'estatus_civil',
                    ['default' => 'Seleccione...','S' => 'Soltero','C' => 'Casado','D' => 'Divorciado','V' => 'Viudo'],
                    $Persona->id>0?null:$Persona->estatus_civil,
                    [
                      'class'=>'form-control custom-select text-uppercase font-size-input select-disabled select-required-form',
                      'required'=>true,
                      'id'=>'estatus_civil',
                      'empty'=>false,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Fecha de Nacimiento (DD/MM/YYYY)</label>
                {{
                  Form::text(
                    'fecha_nacimiento',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly datepicker required-form',
                      'id'=>'fecha_nacimiento',
                      'required'=>true,
                    ]
                  )
                }}
              </div>
            </div>
          </div>
          <div class="row push">
            <div class="col-md-12">
              <div class="form-group">            
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Discapacidad</label>            
                <div class="input-group">
                  <div class="btn-group mr-1  mb-2" role="group">              
                    <button type="button" class="btn btn-outline-secondary active btn-form-disabled btn-discapacidad" name="btn-discapacidad" data-info="NO">NO</button>                 
                    <button type="button" class="btn btn-outline-secondary btn-form-disabled btn-discapacidad" name="btn-discapacidad" data-info="SI">SI</button>
                  </div>            
                  {{
                    Form::text(
                      'discapacidad',
                       null,
                      [
                        'class'=>(isset($Persona->discapacidad) && $Persona->discapacidad != '')?'form-control text-uppercase font-size-input input-readonly required-form':'form-control text-uppercase font-size-input input-readonly',
                        'id'=>'discapacidad',
                        'data-info'=>(isset($Persona->discapacidad) && $Persona->discapacidad != '')?'SI':'NO',
                        'readonly'=>(isset($Persona->discapacidad) && $Persona->discapacidad != '')?false:true,
                        'required'=>(isset($Persona->discapacidad) && $Persona->discapacidad != '')?true:false,
                      ]
                    )
                  }}
                </div>
              </div>
            </div>
          </div>
          <!-- END Basic Elements -->
        </div>
        <div class="block-header block-header-default bg-white text-left pt-4 pb-2">
            <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom">Información de Contacto</h5>
        </div>
        <div class="block-content">
          <div class="row push">
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Correo Electronico</label>
                {{
                  Form::text(
                    'email',
                     auth()->user()->email,
                    [
                      'class'=>'form-control text-uppercase font-size-input required-form',
                      'id'=>'email',
                      'required'=>true,
                      'readonly'=>true,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Telefono Celular</label>
                {{
                  Form::text(
                    'telefono_movil',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly required-form',
                      'id'=>'telefono_movil',
                      'required'=>true,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Telefono de Habitacion</label>
                {{
                  Form::text(
                    'telefono_local',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly required-form',
                      'id'=>'telefono_local',
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
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Estado</label>
                {{
                  Form::select(
                    'estado',
                    $pluck["Estados"],
                    $Persona->id>0?$Persona->parroquia->municipio->estado->id:null,
                    [
                      'class'=>'js-select2 form-control custom-select text-uppercase font-size-input select-disabled no-submit select-required-form',
                      'required'=>true,
                      'id'=>'estado',
                      'empty'=>false,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Municipio</label>
                {{
                  Form::select(
                    'municipio',
                    array(),
                    null,
                    [
                      'class'=>'js-select2 form-control custom-select text-uppercase font-size-input select-disabled no-submit select-required-form',
                      'required'=>true,
                      'id'=>'municipio',
                      'empty'=>false,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Parroquia</label>
                {{
                  Form::select(
                    'id_parroquia',
                    array(),
                    null,
                    [
                      'class'=>'js-select2 form-control custom-select text-uppercase font-size-input select-disabled select-required-form',
                      'required'=>true,
                      'id'=>'id_parroquia',
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
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Ciudad</label>
                {{
                  Form::text(
                    'ciudad',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly required-form',
                      'id'=>'ciudad',
                      'required'=>true,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-8">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Direccion</label>
                {{
                  Form::text(
                    'direccion',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly required-form',
                      'id'=>'direccion',
                      'required'=>true,
                    ]
                  )
                }}
              </div>
            </div>
          </div>
        </div>
        <div class="block-header block-header-default bg-white text-left pt-4 pb-2">
            <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom">Información Laboral</h5>
        </div>
        <div class="block-content">
          <div class="row push">
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Empresa</label>
                {{
                  Form::text(
                    'trabajo_empresa',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly',
                      'id'=>'trabajo_empresa',
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Cargo</label>
                {{
                  Form::text(
                    'trabajo_cargo',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly',
                      'id'=>'cargo_empresa',
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Tiempo Servicio</label>
                {{
                  Form::text(
                    'trabajo_tiempo_servicio',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly numero',
                      'id'=>'trabajo_tiempo_servicio',
                    ]
                  )
                }}
              </div>
            </div>
          </div>
        </div>
        <div class="block-header block-header-default bg-white text-left pt-4 pb-2">
            <h5 class="block-title text-uppercase font-w700 font-size-sm text-black-75 border-bottom">Información Academica</h5>
        </div>
        <div class="block-content">
          <div class="row push">
            <div class="col-2">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Tipo</label>
                {{
                  Form::select(
                    'tipo',
                    $pluck["TiposTitulos"],
                    null,
                    [
                      'class'=>'form-control custom-select text-uppercase font-size-input select-disabled no-submit',
                      'id'=>'tipo',
                      'empty'=>false,
                    ]
                  )
                }}
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Universidad</label>
                {{
                  Form::select(
                    'universidad',
                    $pluck["Universidades"],
                    null,
                    [
                      'class'=>'form-control custom-select text-uppercase font-size-input select-disabled no-submit',
                      'id'=>'universidad',
                      'empty'=>false,
                    ]
                  )
                }}
              </div>
            </div> 
            <div class="col-5">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Titulo</label>
                {{
                  Form::text(
                    'titulo',
                     null,
                    [
                      'class'=>'form-control text-uppercase font-size-input input-readonly no-submit',
                      'id'=>'titulo',
                    ]
                  )
                }}
              </div>
            </div>        
            <div class="col-1">
              <div class="form-group">
                <label for="example-text-input text" class="text-uppercase font-label-form font-w700">Agregar</label>
                <button type="button" class="btn btn-dark btn-block btn-form-disabled" id="btn-titulo">                          
                  <i class="fa fa-check mr-1"></i>                        
                  </button>
              </div>
            </div>         
          </div>
          <div class="row push d-none" id="row-informacion-academica-error">
            <div class="col-12">
              <div id="informacion-academica-error" class="invalid-feedback animated fadeIn text-center mt-0" style="display: block;">
                Por favor, debe ingresar todos los campos solicitados de la información académica
              </div>
            </div>
          </div>
          <div class="row push d-none" id="row-informacion-academica-repeat">
            <div class="col-12">
              <div id="informacion-academica-error" class="invalid-feedback animated fadeIn text-center mt-0" style="display: block;">
                La información académica que ingreso ya fue registrada
              </div>
            </div>
          </div>     
          <div class="row push">
            <div class="col-12"> 
              <div class="block block-rounded js-appear-enabled animated fadeIn bg-gray-lighter" data-toggle="appear">
                <div class="block-content block-content-full border-left border-3x border-dark">             
                  <p class="text-muted mb-0 mt-0 font-size-details text-uppercase font-w700 text-center">
                    Informacion correspondiente a sus titulos de pregrado y postgrado.
                  </p>
                </div>
              </div>                          
              <div class="table-responsive">            
                <table class="table table-bordered table-hover table-striped table-vcenter" id="table-titulo">              
                  <thead>              
                    <tr>                  
                      <th class="text-center text-uppercase font-w700 font-size-sm">Titulo</th>
                      <th class="text-center text-uppercase font-w700 font-size-sm">Tipo</th>
                      <th class="text-center text-uppercase font-w700 font-size-sm">Acción</th>                
                    </tr>              
                  </thead>              
                  <tbody id="tbody-table-titulo" class="tbody-font">
                  @foreach ($Persona->titulos as $titulo)
                    <tr class="row-details">
                      <td>
                        <p class="font-w700 mb-1 text-uppercase text-xwork-light" data-value="{{$titulo->titulo}}" data-role="Titulo" data-type="Table" data-name="titulo">{{ $titulo->titulo }}</p>
                        <p class="text-muted mb-0 text-uppercase" data-value="{{$titulo->id_universidad}}" data-role="Titulo" data-type="Table" data-name="id_universidad">{{ $titulo->universidad->nombre }}</p>
                      </td>
                      <td class="text-center text-uppercase text-muted" data-value="{{$titulo->id_tipotitulo}}" data-role="Titulo" data-type="Table" data-name="id_tipotitulo">{{ $titulo->tipotitulo->nombre }}</td>
                      <td class="text-center">
                        <i class="i-titulo i-font-table" aria-hidden="true"></i>
                      </td>
                      {{ Form::hidden('__id_persona',$Persona->id,
                        [
                          'data-name'=>'__id_persona',
                          'data-role'=>'Titulo',
                          'class'=>'no-submit'
                        ])
                      }}
                    </tr>
                  @endforeach
                    <tr id="table-empty">            
                      <td colspan="3">
                        <h2 class="pt-0 mb-0 pb-0 text-uppercase text-center text-muted">No hay informacion academica registrada</h2> 
                      </td>
                    </tr>                             
                  </tbody>              
                </table>          
              </div>
              <div class="form-group text-center">
                {{ Form::hidden('check-titulos',null,['id'=>'check-titulos','class'=>'no-submit required-title','required'=>true])}}
              </div>          
            </div>
          </div>
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

    $('#estado').on('change',onSelectEstadoChange);
    $('#municipio').on('change',onSelectMunicipioChange);

    $('#btn-titulo').on('click',onBtnTituloClick);
    $('#table-titulo').on('click',".btn-delete", onBtnDeleteClick);

    $('.btn-nacionalidad').on('click',onBtnNacionalidadClick);
    $('.btn-discapacidad').on('click',onBtnDiscapacidadClick);

    $('#ci').on('focusout',onCedulaFocusout);

    var AuxNacionalidad = $("button[name='btn-nacionalidad'].active").attr("data-info");
    var AuxFechaNAcimiento = null;

    $("#telefono_movil").mask("(9999) 999-9999");
    $("#telefono_local").mask("(9999) 999-9999");

    $('.datepicker').datepicker({
      language: 'es',
      format: "dd/mm/yyyy",
      autoclose: true,
    });

    @if ($Persona->id > 0)
      
      AuxNacionalidad = "{{ $Persona->nacionalidad }}";
      AuxFechaNAcimiento = "{{ $Persona->fecha_nacimiento }}";

      $('.datepicker').datepicker("setDate", moment(AuxFechaNAcimiento).format('DD/MM/YYYY'));
     
      $("button[name='btn-nacionalidad']").removeClass("active");    
      $("button[name='btn-discapacidad']").removeClass("active");
      $('#fecha_nacimiento').val(moment(AuxFechaNAcimiento).format('DD/MM/YYYY'));
      $("#estado").change(); 

      @if (count($Persona->titulos) >0)
        $("#table-empty").addClass("d-none");
        $("#check-titulos").val("{{count($Persona->titulos)}}");
      @endif

      @if ($Persona->confirmado)
                           
        $("button[name='btn-nacionalidad']").removeClass("btn-outline-secondary");
        $("button[data-info='{{ $Persona->nacionalidad }}']").addClass('btn-secondary');
        $("button[name='btn-discapacidad']").removeClass("btn-outline-secondary");
        $("button[data-info='"+ $("#discapacidad").attr("data-info") +"']").addClass("btn-secondary");  
        $(".i-titulo").addClass('si si-check text-success'); 
        $(".i-titulo").attr("title",'Confirmado');
        $(".btn-form-disabled").attr("disabled",true);
        $(".select-disabled").attr("disabled",true);
        $(".input-readonly").attr("readonly",true);        

      @else

        $("button[data-info='{{ $Persona->nacionalidad }}']").addClass("active");
        $("button[data-info='"+ $("#discapacidad").attr("data-info") +"']").addClass("active");  
        $(".i-titulo").addClass('si si-close text-danger btn-delete'); 
        $(".i-titulo").attr("title",'Eliminar');

      @endif

    @else
      
      $('#municipio').html('<option value="default" selected>'+'Seleccione...'+'</option>');
      $('#municipio').attr("disabled",true);  
      $('#id_parroquia').html('<option value="default" selected>'+'Seleccione...'+'</option>');          
      $('#id_parroquia').attr("disabled",true);  
     
    @endif

    $("#nacionalidad").val(AuxNacionalidad);

    var AuxFechaSeparar = "";

    $("#PersonaEditForm").submit(function( event ) {

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
      
    });

  });

  function onCedulaFocusout(){

    //AJAX
    $.ajax({
      url:"{{ url('ConsultarPersona') }}",
      async: false,
      type:"GET",
      data: {'ci': $("#ci").val()},
      dataType:'json',
      success: function(data){
       
        $("#check-cedula").val(data.ci);

      },
      error: function(){

      }

    });

  }

  function onBtnDiscapacidadClick(){

    $("button[name='btn-discapacidad']").removeClass("active");
    $(this).addClass("active");

    if($.trim($(this).text()) === "NO"){
      $("#discapacidad").val('');
      $("#discapacidad").attr("readonly",true);
      $('#discapacidad').removeAttr("required");
      $("#discapacidad").removeClass("required-form");
      $("#discapacidad").removeClass("is-invalid");
      $("#discapacidad").addClass("ignore");
    }
    else
    {
      $("#discapacidad").val("{{ (isset($Persona->discapacidad) && $Persona->discapacidad != '')?$Persona->discapacidad:'' }}");
      $("#discapacidad").attr("readonly",false); 
      $('#discapacidad').prop("required", true);
      $("#discapacidad").removeClass("ignore");      
      $("#discapacidad").addClass("required-form");
    }

  }

  function onBtnNacionalidadClick(){

    $("button[name='btn-nacionalidad']").removeClass("active");
    $(this).addClass("active");
    $("#nacionalidad").val($(this).attr("data-info"));

  }

  var nFilas = 0;
  var html_tbody = "";

  function onBtnTituloClick(){

    var AuxTitulo="";
    var AuxUniversidad="";
    var AuxTipo="";
    var AuxEncontro=false;

    $("#row-informacion-academica-error").addClass("d-none");
    $("#row-informacion-academica-repeat").addClass("d-none");  

    if($("#universidad option:selected").val() === "default" || $("#tipo option:selected").val() === "default" || $('#titulo').val() === '')
    {

      $("#row-informacion-academica-error").removeClass("d-none"); 
      return;

    }

    $(".row-details").each(function(){

      AuxTitulo=$(this).find("[data-name='titulo']").attr("data-value");
      AuxUniversidad=$(this).find("[data-name='id_universidad']").attr("data-value");
      AuxTipo=$(this).find("[data-name='id_tipotitulo']").attr("data-value");
      
      if($("#universidad option:selected").val() === AuxUniversidad && $("#tipo option:selected").val() === AuxTipo && $('#titulo').val() === AuxTitulo)
      {
        
        $("#row-informacion-academica-repeat").removeClass("d-none"); 
        AuxEncontro=true;
        return;

      }

    });

    if(AuxEncontro)
    {
      return;
    }

    nFilas = $("#tbody-table-titulo tr").length;

    if(nFilas == 1 ){
      $('#table-empty').addClass('d-none');
    }

    html_tbody = "<tr class='row-details'>";
    html_tbody += "<td>";
    html_tbody += "<p class='font-w700 mb-1 text-uppercase text-xwork-light' data-value='" + $('#titulo').val() + "' data-role='Titulo' data-type='Table' data-name='titulo'>" + $('#titulo').val() + "</p>";
    html_tbody += "<p class='text-muted mb-0 text-uppercase' data-value='" + $("#universidad option:selected").val() + "' data-role='Titulo' data-type='Table' data-name='id_universidad'>" + $("#universidad option:selected").text() + "</p>";
    html_tbody += "</td>";
    html_tbody += "<td class='text-center text-uppercase text-muted' data-value='" + $("#tipo option:selected").val() + "' data-role='Titulo' data-type='Table' data-name='id_tipotitulo'>"+ $("#tipo option:selected").text() +"</td>";
    html_tbody += "<td class='text-center'><i class='si si-close text-danger btn-delete i-font-table' aria-hidden='true' title='Eliminar'></i></td>";
    html_tbody += "<input data-name='__id_persona' data-role='Titulo' class='no-submit' name='__id_persona' type='hidden' value='0'>";
    html_tbody += "</tr>"; 

    $("#tbody-table-titulo").append(html_tbody);
    $("#check-titulos").val(nFilas);

    $("#tipo option[value='default']").prop("selected",true);
    $("#universidad option[value='default").prop("selected",true);
    $("#titulo").val('');

  }

  function onBtnDeleteClick(){

    $(this).closest("tr").remove();  

    nFilas = $("#tbody-table-titulo tr").length;

    if(nFilas == 1 ){
      $('#table-empty').removeClass('d-none');
      $("#check-titulos").val(null);
    }
    
  }

  var html_select = "";
  var load_select = false;

  function onSelectEstadoChange(){

    if($(this).val() === 'default'){

      $('#municipio').html('<option value="default" selected>'+'Seleccione...'+'</option>');
      $('#municipio').attr("disabled",true);  
      $('#id_parroquia').html('<option value="default" selected>'+'Seleccione...'+'</option>');          
      $('#id_parroquia').attr("disabled",true);  
      return;

    }

    //AJAX
    $.ajax({
      url:"{{ url('MunicipioEstado') }}",
      type:"GET",
      data: {'id_estado': $(this).val()},
      dataType:'json',
      success: function(data){

        $('#id_parroquia').html('<option value="default" selected>'+'Seleccione...'+'</option>');          
        $('#municipio').attr("disabled",false);            
        $('#id_parroquia').attr("disabled",true);   

        html_select = '<option value="default" selected>Seleccione...</option>';

        if(Object.keys(data).length == 0){}
        else{

          $.each(data, function(index,accountObj){
            html_select += '<option value="'+accountObj.id+'">'+accountObj.nombre+'</option>';
          });

        }

        $('#municipio').html(html_select);

        //SELECCIONA EL MUNICIPIO GUARDADO
        @if ($Persona->id > 0)
          //SE CONFIRMA SI YA SE CARGO EL SELECT CON LOS DATOS GUARDADOS
          if(!load_select){

            $("#municipio option[value='{{ $Persona->id>0?$Persona->parroquia->municipio->id:'default' }}']").prop("selected",true);
            $("#municipio").change();

          }    

          @if ($Persona->confirmado)  
            $(".select-disabled").attr("disabled",true);
          @endif 

        @endif        

      },
      error: function(){

      }

    });

  }

  function onSelectMunicipioChange(){

    if($(this).val() === 'default'){

      $('#id_parroquia').html('<option value="default" selected>'+'Seleccione...'+'</option>');          
      $('#id_parroquia').attr("disabled",true);  
      return;

    }

    //AJAX
    $.ajax({
      url:"{{ url('ParroquiaMunicipio') }}",
      type:"GET",
      data: {'id_municipio': $(this).val()},
      dataType:'json',
      success: function(data){

        $('#id_parroquia').attr("disabled",false);   

        html_select = '<option value="default" selected>Seleccione...</option>';

        if(Object.keys(data).length == 0){}
        else{

          $.each(data, function(index,accountObj){
            html_select += '<option value="'+accountObj.id+'">'+accountObj.nombre+'</option>';
          });

        }

        $('#id_parroquia').html(html_select);

        //SELECCIONA LA PARROQUIA GUARDADA
        @if ($Persona->id > 0)
          //SE CONFIRMA SI YA SE CARGO EL SELECT CON LOS DATOS GUARDADOS
          if(!load_select){

            $("#id_parroquia option[value='{{ $Persona->id>0?$Persona->id_parroquia:'default' }}']").prop("selected",true);
            load_select = true;
            
          }

          @if ($Persona->confirmado)  
            $(".select-disabled").attr("disabled",true);
          @endif      

        @endif       

      },
      error: function(){

      }

    });

  }

</script>

@endsection