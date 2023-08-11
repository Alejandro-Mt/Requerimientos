@component('mail::message')
# {{$datos->folio}} {{$datos->descripcion}} #
@if ($datos->id_estatus == 9)
@if ($datos->fechades == NULL)
<p>El cliente ha rechazado la Definición de requerimiento, se recomienda contactar para mayor información.</p>
@else
<p>La definición ha sido autorizada por el cliente.</p>
@endif
@elseif ($datos->fechaaut == NULL)
<p>El cliente ha rechazado la propuesta de requerimiento, se recomienda contactar para mayor información.</p>
@else
<p>El requerimiento ha sido autorizado</p>
{{$datos->nombre_r}} {{$datos->apellidos}}
@endif

<br>
{{ config('app.name') }}
@endcomponent
