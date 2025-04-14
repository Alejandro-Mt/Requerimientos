@component('mail::message')

Buen día **{{$datos->rtest->getFullnameAttribute()}}**,

Se informa que desarrollo ha concluido los ajustes del requerimiento con folio {{$datos->folio}}.

Gracias por su atención y cooperación en este asunto.

Saludos cordiales.
<br>
{{ config('app.name') }}
@endcomponent