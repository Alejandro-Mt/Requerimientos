@component('mail::message')

Estimado {{$destinatario->solicitante}}.,

Espero que estén teniendo un buen día. Les informamos que hemos subido con éxito el archivo 'Definición de requerimiento' a la plataforma y lo hemos enviado al cliente para su revisión y autorización. Este archivo es crucial para nuestro proceso, y agradeceríamos que lo verifiquen.

Gracias por su atención y cooperación en este asunto.

Saludos cordiales.
<br>
{{ config('app.name') }}
@endcomponent