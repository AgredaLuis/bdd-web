@component('mail::message')
	
# Saludos

Hola, estás recibiendo este correo porque hiciste una solicitud de recuperación de contraseña para tu cuenta de usuario de SIAEPUDO.

Te invitamos a ingresar y restablecerla.

@component('mail::button', ['url' =>route('password.reset', [$DataMail['Token'],$DataMail['Usuario']->id])])
Recuperar Contraseña
@endcomponent

Gracias, y que estés bien !<br>
{{ config('app.name') }}

{{-- Subcopy --}}

@component('mail::subcopy')

Si usted está teniendo problemas para hacer clic en el botón "Recuperar Contraseña" copie y pegue el siguiente URL en su navegador web:  {{ route('password.reset', [$DataMail['Token'],$DataMail['Usuario']->id]) }}

@endcomponent

@endcomponent