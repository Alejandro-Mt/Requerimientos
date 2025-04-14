@component('mail::message')

EL requerimiento **{{$datos->folio." ".$datos->descripcion}}**
ha cambiado su estatus a 
@if($estatus == '7')**CONSTRUCCIÓN**
@elseif($estatus == '8')**LIBERACIÓN**
@elseif($estatus == '2')**IMPLEMENTACIÓN**
@elseif($estatus == '18')**IMPLEMENTADO**
@elseif($estatus == '14')**CANCELADO**
@elseif($estatus == 'POSPUESTO')**POSPUESTO**
@elseif($estatus == 'REANUDAR')**REACTIVADO**
@endif
<br>
<<<<<<< HEAD
=======
<tr>
<td>
Acceda a SMART PLANNER en caso de ser necesario
        @component('mail::button', ['url' => route('Documentos',Crypt::encrypt($datos->folio))])
            SMART PLANNER 
        @endcomponent
</td>
</tr>
>>>>>>> versionprod
{{ config('app.name') }}
@endcomponent