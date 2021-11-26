@component('mail::message')
<!-- Encabezado de correo -->
@foreach($formato as $dato)
<table>
<tr><th></th><th>{{$dato->folio}} {{$dato->descripcion}}</th><th></th></tr>
<tr>
<img style="margin: 0px 10px 1Opx 0px;" src="{{asset("assets/images/new_logo_3ti.png")}}" alt="logo" width="150" height="60"/>
<th width="300">Solicitud de requerimientos</th>
<td width="50">Fecha de solicitud:{{$dato->fsol}}</tr>
<div></div>
</tr>
</table>
_____________________________________________________
<!-- Seccion 1 -->
<table>
<tr>
<th align="left">Área:</th>
<td>{{$dato->area}}</td>
<th align="left">Nombre de solicitante:</th>
<td>{{$dato->solicitante}}</td>
</tr>
<tr>
<th align="left">Departamento:</th>
<td>{{$dato->departamento}}</td>
<th align="left">Jefe de departamento:</th>
<td>{{$dato->j_dep}}</td>
</tr>
<tr>
<th align="left">Sistema o aplicación:</th>
<td>{{$dato->nombre_s}}</td>
<th align="left">Cliente:</th>
<td>{{$dato->nombre_cl}}</td>
</tr>
<tr>
<td></td>
<td></td>
<th align="left">Quién autoriza:</th>
<td>{{$dato->autorizo}}</td>
</tr>
</table>
_____________________________________________________
<!-- seccion 2 -->
<table>
<tr>
<th align="left">¿Existe desarrollo previo?</th>
@if ($dato->previo == 1)
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
@switch($dato->impacto)
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
<td colspan="8" style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px">{{$dato->problema}}</td>
</tr>
</tbody>
</table>

<table width="500">
<thead>
<tr>
<th align="left">Descripción general del requerimiento:</th>
<th align="left">Prioridad:</th>
@switch($dato->impacto)
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
<td colspan="8"  style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px">{{$dato->general}}</td>
</tr>
</tbody>
</table>

<table width="500">
<tr>
<th align="left">Descripción específica del requerimiento</th>
</tr>
<tr>
<td style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px">{{$dato->detalle}}</td>
</tr>

<tr>
<th align="left">Resultado esperado</th>
</tr>
<tr>
<td style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px">
<textarea width="660px" style="text-align: justify; border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px" class="summernote">
{{$dato->esperado}}
</textarea>
</td>
</tr>

<tr>
<th align="left">Áreas o sistemas relacionados</th>
</tr>
@for ($i = 0; $i < count($relaciones); $i++)  
@foreach ($sistemas as $sistema)
@if ($relaciones[$i] == $sistema->id_sistema)
<tr style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px">
<td>{{$sistema->nombre_s}}</td>
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
<tr style="text-align: justify;border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px">
<td>
{{$responsable->nombre_r}}
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
<tr align="right">@component('mail::button', ['url' => route('Archivo',$dato->folio)])Ver PDF @endcomponent</tr>
<tr>
<td>@component('mail::button', ['url' => route('Rechazo',$dato->folio)])Rechazar @endcomponent</td>
<td>@component('mail::button', ['url' => route('Respuesta',$dato->folio)])Autorizar @endcomponent</td> 
</tr>
</table>
@endforeach
Thanks,<br>
{{ config('app.name') }}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css"/>
<link rel="stylesheet" type="text/css" href="{{("assets/extra-libs/summernote/summernote-lite.min.css")}}"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script src="{{("assets/extra-libs/summernote/summernote-lite.min.js")}}"></script>
<script>
/************************************/
//default editor
/************************************/
$('.summernote').summernote({
height: 150, // set editor height
//codemirror: { theme:'spacelab'}, // codemirror options
//minHeight: null, // set minimum height of editor
//maxHeight: null, // set maximum height of editor
//focus: false, // set focus to editable area after initializing summernote
});
</script>

@endcomponent
