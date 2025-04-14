@component('mail::message')

Buen día **{{$datos->rpip->getFullnameAttribute()}}**,

<<<<<<< HEAD
Espero que estés teniendo un buen día. Se informa que hemos subido con éxito el archivo 'Definición de requerimiento' a la plataforma y lo hemos enviado al cliente para su revisión y autorización. Este archivo es crucial para nuestro proceso, y agradeceríamos que lo verifiquen.
=======
Espero que estés teniendo un buen día. Se informa que hemos subido con éxito el archivo 'Definición de requerimiento' a la plataforma. Este archivo es crucial para nuestro proceso, y agradeceríamos que lo verifiquen.
>>>>>>> versionprod

Gracias por su atención y cooperación en este asunto.

Saludos cordiales.
<br>
{{ config('app.name') }}
@endcomponent