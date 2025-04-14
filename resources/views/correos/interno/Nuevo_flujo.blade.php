@component('mail::message')

Buen día **{{$datos->rdes->getFullnameAttribute()}}**,

Se informa que PIP ha adjuntado el nuevo flujo del requerimiento con folio {{$datos->folio}}.

Gracias por su atención y cooperación en este asunto.

Saludos cordiales.
<br>
{{ config('app.name') }}
@endcomponent