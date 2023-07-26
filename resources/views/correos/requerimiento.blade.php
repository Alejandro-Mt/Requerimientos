@component('mail::message')
# {{$datos->folio}} {{$datos->descripcion}} #
@if ($datos->id_estatus == 11)
    @if ($datos->fechades == NULL)
    El cliente ha rechazado la Definición de requerimiento, se recomienda contactar para mayor información. 
    @else
    La definición ha sido autorizada por el cliente.
    @endif
@elseif ($datos->fechaaut == NULL)
    El cliente ha rechazado la propuesta de requerimiento, se recomienda contactar para mayor información.   
    @else
    El requerimiento ha sido autorizado
    {{$datos->nombre_r}} {{$datos->apellidos}}
@endif

<br>
{{ config('app.name') }}
@endcomponent
