@component('mail::message')
Buen día  **{{$datos->rpip->getFullnameAttribute()}}**,

El requerimiento:
# {{$datos->folio}} {{$datos->descripcion}}

Ha sido {{ $respuesta == 1 ? 'autorizado' : 'rechazado'}} por desarrollo 
<br>
{{ config('app.name') }}
@endcomponent
