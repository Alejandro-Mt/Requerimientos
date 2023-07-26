@component('mail::message')

EL requerimiento **{{$datos->folio." ".$datos->descripcion}}**
ha cambiado su estatus a 
@if($estatus == '7')**CONSTRUCCIÓN**
@elseif($estatus == '8')**LIBERACIÓN**
@elseif($estatus == '2')**IMPLEMENTACIÓN**
@elseif($estatus == '14')**CANCELADO**
@elseif($estatus == 'POSPUESTO')**POSPUESTO**
@elseif($estatus == 'REANUDAR')**REACTIVADO**
@endif
<br>
{{ config('app.name') }}
@endcomponent