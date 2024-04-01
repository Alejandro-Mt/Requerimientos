@component('mail::message')
<!-- Encabezado de correo -->
<table>
<tr><th></th><th>{{$formato->titulo()}}</th><th></th></tr>
<tr>
<img style="margin: 0px 10px 1Opx 0px;" src="{{asset("assets/images/new_logo_3ti.png")}}" alt="logo" width="150" height="60"/>
<th width="300">Solicitud de requerimientos</th>
<td width="50">Fecha de solicitud:{{$formato->levantamiento->created_at}}</tr>
<div></div>
</tr>
</table>
_____________________________________________________
<!-- Seccion 1 -->
<table>
<tr>
<th align="left">Área:</th>
<td>{{$formato->area->area}}</td>
<th align="left">Nombre de solicitante:</th>
<td>{{$formato->levantamiento->sol->nombreCompleto()}}</td>
</tr>
<tr>
<th align="left">Departamento:</th>
<td>{{$formato->levantamiento->depto->departamento}}</td>
<th align="left">Quién autoriza:</th>
<td>{{$formato->levantamiento->autorizador->nombreCompleto()}}</td>
</tr>
<tr>
<th align="left">Sistema o aplicación:</th>
<td>{{$formato->sistema->nombre_s}}</td>
<th align="left">Cliente:</th>
<td>{{$formato->cliente->nombre_cl}}</td>
</tr>
<!--<<tr>
<td></td>
<td></td>
th align="left">Jefe de departamento:</th>
<td>{{$formato->j_dep}}</td>
</tr>-->
</table>
_____________________________________________________
<!-- seccion 2 -->
<table>
<tr>
<th align="left">¿Existe desarrollo previo?</th>
@if ($formato->previo == 1)
<td>SÍ</td>
<h5>☑&nbsp;&nbsp;</h5>
<td>NO</td>
<h5>⬜&nbsp;&nbsp;</h5>
@else
<td>SÍ</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>NO</td>
<h5>☑&nbsp;&nbsp;</h5>
@endif
</tr>
</table>

<table width="500">
<thead>
<tr>
<th align="left">Descripción del problema:</th>
<th align="left">Impacto en la operación:</th>
@switch($formato->levantamiento->impacto)
@case(1)
<h5>⬜&nbsp;&nbsp;</h5>
<td>Alta</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>Media</td>
<h5>☑&nbsp;&nbsp;</h5>
<td>Baja</td>
@break
@case(2)
<h5>⬜&nbsp;&nbsp;</h5>
<td>Alta</td>
<h5>☑&nbsp;&nbsp;</h5>
<td>Media</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>Baja</td>
@break
@case(3)
<h5>☑&nbsp;&nbsp;</h5>
<td>Alta</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>Media</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>Baja</td>
@break
@default
@endswitch
</tr>
</thead>
<tbody>
<tr>
<td colspan="8" style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px"><pre>{{$formato->levantamiento->problema}}</pre></td>
</tr>
</tbody>
</table>

<table width="500">
<thead>
<tr>
<th align="left">Descripción general del requerimiento:</th>
<th align="left">Prioridad:</th>
@switch($formato->levantamiento->prioridad)
@case(1)
<h5>⬜&nbsp;&nbsp;</h5>
<td>Alta</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>Media</td>
<h5>☑&nbsp;&nbsp;</h5>
<td>Baja</td>
@break
@case(2)
<h5>⬜&nbsp;&nbsp;</h5>
<td>Alta</td>
<h5>☑&nbsp;&nbsp;</h5>
<td>Media</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>Baja</td>
@break
@case(3)
<h5>☑&nbsp;&nbsp;</h5>
<td>Alta</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>Media</td>
<h5>⬜&nbsp;&nbsp;</h5>
<td>Baja</td>
@break
@default
@endswitch
</tr>
</thead>
<tbody>
<tr>
<td colspan="8"  style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px"><pre>{{$formato->levantamiento->general}}</pre></td>
</tr>
</tbody>
</table>

<table width="500">
<tr>
<th align="left">Descripción específica del requerimiento</th>
</tr>
<tr>
<td style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px"><pre>{{$formato->levantamiento->detalle}}</pre></td>
</tr>

<tr>
<th align="left">Resultado esperado</th>
</tr>
<tr>
<td width="660px" style="border: 1px solid;background-color: #ecfbfb;border-radius: 25px;padding: 10px">
{!! nl2br(e($formato->levantamiento->esperado)) !!}
</td>
</tr>
<tr>
<th align="left">Áreas o sistemas relacionados</th>
</tr>
@for ($i = 0; $i < count($relaciones); $i++)  
@foreach ($sistemas as $sistema)
@if ($relaciones[$i] == $sistema->id_sistema)
<tr>
<td style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius:25px;padding-right: 10px;padding-left: 10px">
{{$sistema->nombre_s}}
</td>
</tr>
@endif 
@endforeach
@endfor
<tr>
<th align="left">Responsables del proceso actual y usuario funcional:</th>
</tr>
@for ($i = 0; $i < count($involucrados); $i++)  
@foreach ($responsables as $responsable)
@if ($involucrados[$i] == $responsable->id_responsable)
<tr>
<td style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 25px;padding-right: 10px;padding-left: 10px">
{{$responsable->nombreCompleto()}}
</td>
</tr>
@endif
@endforeach
@endfor
</table>
<br>
<!-- seccion final -->
<table>
<tr>
<td></td>
<td align="center" style="border-top: 1px solid;">Nombre y firma de quién autoriza</td>
<td></td>
</tr>
<tr>
<td align="center" style="border-top: 1px solid;">Fecha de recepción por IT</td>
<td></td>
<td align="center" style="border-top: 1px solid;">Vo. Bo. IT</td>
</tr>
</table>
<table>
<tr align="right">@component('mail::button', ['url' => route('Archivo',Crypt::encrypt($formato->folio))])Ver PDF @endcomponent</tr>
@if ($formato->id_estatus == 10)
<tr>
<td>@component('mail::button', ['url' => route('Rechazo',$formato->folio)])Rechazar @endcomponent</td>
<td>@component('mail::button', ['url' => route('Respuesta',$formato->folio)])Autorizar @endcomponent</td> 
</tr> 
@else
<tr><th align="center">Acceda a SMART PLANNER para definir un tipo de desarrollo</th></tr>
<tr><td>@component('mail::button', ['url' => route('Documentos',Crypt::encrypt($formato->folio))])SMART PLANNER @endcomponent</td></tr>
@endif
</table>
Gracias,<br>
{{ config('app.name') }}

@endcomponent
