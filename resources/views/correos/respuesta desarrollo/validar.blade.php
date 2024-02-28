@component('mail::message')
# {{$dato->folio}} {{$dato->descripcion}}
El equipo de Desarrollo ha definido el requerimiento como:
# {{$dato->clase}}
con un impacto
@switch($dato->impacto)
@case(3)
# Alto
@break
@case(2)
# Medio
@break
@default
# Bajo
@endswitch($dato->impacto == NULL)


<br>
{{ config('app.name') }}
@endcomponent
