@component('mail::message')

# Bienvenido

Hola, has restablecido exitosamente la contraseña en SIAEPUDO

Tus nuevas credenciales son:

#Correo Electrónico: {{ $DataMail['Usuario']->email }}

#Contraseña: {{ $DataMail['Contrasena'] }}

Ahora te invitamos a ingresar a SIAEPUDO.

@component('mail::button', ['url' =>route('login')])
Ingresar SIAEPUDO
@endcomponent

Saludos, y que estés bien !<br>
{{ config('app.name') }}

{{-- Subcopy --}}

@component('mail::subcopy')

Si usted está teniendo problemas para hacer clic en el botón "Ingresar SIAEPUDO" copie y pegue el siguiente URL en su navegador web:  {{ route('login') }}

@endcomponent

@endcomponent
