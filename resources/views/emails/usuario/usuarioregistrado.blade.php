@component('mail::message')

# Bienvenido

Hola, has sido registrado en SIAEPUDO

Tus credenciales son:

#Correo Electrónico: {{ $DataMail['Usuario']->email }}

#Contraseña: {{ $DataMail['Contrasena'] }}

Solo te falta activar tu cuenta de usuario. Te invitamos a ingresar y activarla.

@component('mail::button', ['url' =>route('userActivation', [$DataMail['Link']])])
Activar Cuenta de Usuario
@endcomponent

Saludos, y que estés bien !<br>
{{ config('app.name') }}

{{-- Subcopy --}}

@component('mail::subcopy')

Si usted está teniendo problemas para hacer clic en el botón "Activar Cuenta de Usuario" copie y pegue el siguiente URL en su navegador web:  {{ route('userActivation', [$DataMail['Link']]) }}

@endcomponent

@endcomponent
