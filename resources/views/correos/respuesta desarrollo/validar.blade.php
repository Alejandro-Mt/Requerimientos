@component('mail::message')
@foreach ($datos as $dato)
# {{$dato->folio}} {{$dato->descripcion}}

Desarrollo ha definido el impacto de este requerimiento como:
@switch($dato->impacto)
@case(3)
#Alto
@break
@case(2)
$Medio
@break
@default
#Bajo
@endswitch($dato->impacto == NULL)
@endforeach


<br>
{{ config('app.name') }}
@endcomponent
