@component('mail::message')
Se ha actualizado el orden de prioridad en **{{$sistema->nombre_s}}**.
<br>
{{$usuario}} ha autorizado la actualizacion del orden de prioridad del cliente **{{$cliente->nombre_cl}}** 
<br>
A continuacion se enlista las nuevas prioridades 
<br>
<!--/* clinete, subgerencia, Arquitectos*/-->
<div>
<table>
<tr>
@foreach ($orden as $folio)
<td>{{$folio->folio}}</td>
<td>{{$folio->descripcion}}</td>
@endforeach
</tr>
</table>
</div>
<br>
Por favor verifica los datos.
<br>
{{ config('app.name') }}
@endcomponent