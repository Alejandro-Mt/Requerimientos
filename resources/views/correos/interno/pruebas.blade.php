@component('mail::message')

Buen día **{{$datos->rpip->getFullnameAttribute()}}**,

Espero que estés teniendo un buen día. Se informa que testing ha concluido las pruebas.

Gracias por su atención y cooperación en este asunto.

Saludos cordiales.
<br>
{{ config('app.name') }}
@endcomponent