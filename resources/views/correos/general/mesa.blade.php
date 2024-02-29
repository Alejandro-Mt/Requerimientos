@component('mail::message')

Buen dia equipo.

Se comparte la minita de la reunion para el avance del requerimiento con folio {{$mesa->folio}}

Saludos cordiales.
<br>
{{ config('app.name') }}
@endcomponent