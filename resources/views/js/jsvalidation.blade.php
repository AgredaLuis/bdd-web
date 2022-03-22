
<!-- Page JS Helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Ion Range Slider + Masked Inputs plugins) -->
<script>

    jQuery(function(){ 

        Dashmix.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'rangeslider', 'masked-inputs', 'table-tools-sections']); 

        $('.row-js-dataTable [data-toggle="tooltip"]').tooltip();
        $("#input-cuenta").mask("9999-9999-99-9999999999");

    });
    
</script>

<script type="text/javascript">

     // Se agrega nueva regla para los Select
     $.validator.addMethod("valueNotEquals", function(value, element, arg){
      return arg !== value;
     }, "Por favor, seleccione un registro");
      
    jQuery(".js-validation").validate({

        ignore: ".ignore",errorClass:"invalid-feedback animated fadeIn",
        errorElement:"div",
        errorPlacement:function(e,r){
            jQuery(r).addClass("is-invalid"),
            jQuery(r).parents(".form-group").
            append(e)},
        highlight:function(e){
            jQuery(e).parents(".form-group").find(".is-invalid").removeClass("is-invalid").addClass("is-invalid")},
        success:function(e){ 
            jQuery(e).parents(".form-group").find(".is-invalid").removeClass("is-invalid"),jQuery(e).remove()},
        rules:{"val-username":{required:!0,minlength:3},
                "email":{required:!0,email:!0},
                "password":{required:!0,minlength:8,maxlength:15},
                "password_confirmation":{required:!0,equalTo:"#password"},
                "val-suggestions":{required:!0,minlength:5},
                "val-skill":{required:!0},
                "val-currency":{required:!0,currency:["$",!0]},
                "val-website":{required:!0,url:!0},
                "val-phoneus":{required:!0,phoneUS:!0},
                "val-digits":{required:!0,digits:!0},
                "input-cedula":{required:!0,number:!0},
                "val-range":{required:!0,range:[1,5]},
                "val-terms":{required:!0},
                "val-select2":{required:!0},
                "val-select2-multiple":{required:!0,minlength:2}
            },
        messages:{
            "val-username":{
                required:"Please enter a username",
                minlength:"Your username must consist of at least 3 characters"
            },
            "input-cedula":{
                required:"Por favor, ingrese un numero de cedula",
                number:"Por favor, ingrese solo numeros"
            },
            "email":"Por favor, introduzca una dirección de correo electrónico válida",
            "password":{
                required:"Por favor, proporcione una contraseña",
                minlength:"Su contraseña debe tener al menos 8 caracteres",
                maxlength:"Su contraseña debe tener un maximo de 15 caracteres"
            },
            "password_confirmation":{
                required:"Por favor, confirme su contraseña",
                minlength:"Su contraseña debe tener al menos 8 caracteres",
                maxlength:"Su contraseña debe tener un maximo de 15 caracteres",
                equalTo:"Por favor, ingrese la misma contraseña"
            },
            "val-select2":"Please select a value!",
            "val-select2-multiple":"Please select at least 2 values!",
            "val-suggestions":"What can we do to become better?",
            "val-skill":"Please select a skill!",
            "val-currency":"Please enter a price!",
            "val-website":"Please enter your website!",
            "val-phoneus":"Please enter a US phone!",
            "val-digits":"Please enter only digits!",
            "val-range":"Please enter a number between 1 and 5!",
            "val-terms":"You must agree to the service terms!",
            }
    });

    $.validator.addClassRules = function (className, rules) {

        if (className.constructor === String) {
            var obj = {};
            obj[className] = rules;
            className = obj;
        }

        $.each(className, function (n, r) {
            $("." + n).each(function (i, e) {
                var self = $(e)
                self.rules('add', r);
            });
        });

    }

    $.validator.addClassRules({
        'required-form': {
            required: true,
            messages: {
                required: "Por favor, ingrese este campo"
            }
        },
        'required-title': {
            required: true,
            messages: {
                required: "Por favor, debe registrar su información académica"
            }
        },
        'form-check-cedula': {
            notEqualTo:"#check-cedula",
            messages: {
                notEqualTo:"Cédula ya registrada. Por favor, ingrese otra"
            }
        },
        'select-required-form': {
            valueNotEquals: "default",
            messages: {
                required: "Por favor, seleccione un registro"
            }
        }
    });

    $.validator.messages.required = "Por favor, ingrese este campo";

</script>