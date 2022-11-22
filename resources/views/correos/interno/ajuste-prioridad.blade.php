@component('mail::message')
# SOLICITUD DE ACTUALIZACION A PRIORIDADES
{{$solicitante}} ha solicitado la actualizacion del un listado de prioridades para el cliente @foreach($cliente as $c) {{$c->nombre_cl}} @endforeach del sistema @foreach($sistema as $s) {{$s->nombre_s}} @endforeach.
Por favor verifica los datos.

<br>
{{ config('app.name') }}
@endcomponent