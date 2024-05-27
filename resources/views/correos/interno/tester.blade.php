@component('mail::message')

Buen día **{{$datos->rtest->getFullnameAttribute()}}**,

Espero que estés teniendo un buen día. Se informa que se te ha asignado el requerimiento con folio {{$datos->folio}} para el proceso de testing.

Gracias por su atención y cooperación en este asunto.

Saludos cordiales.
<br>
{{ config('app.name') }}
@endcomponent