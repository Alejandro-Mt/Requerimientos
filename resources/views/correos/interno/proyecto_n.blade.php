@component('mail::message')
@if ($estatus == NULL)
# NUEVO PROYECTO
Buen dia {{$destinatario}}.
<br>
Se ha generado un nuevo proyecto en la plataforma.
<br>
**{{$titulo}}** 
@else
# Actualizacion de proyecto
Buen dia {{$destinatario}}.
<br>
Se ha consedido el acceso al proyecto **{{$titulo->descripcion}}**
@endif
<br>
{{ config('app.name') }}
@endcomponent