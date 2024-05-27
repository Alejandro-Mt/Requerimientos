@component('mail::message')

Buen dia equipo.

Se comparte la minuta de la reunión para el avance del requerimiento con folio {{$mesa->folio}}

Saludos cordiales.
<br>
{{ config('app.name') }}
@endcomponent