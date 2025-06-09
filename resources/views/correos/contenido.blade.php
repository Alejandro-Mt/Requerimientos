@component('mail::message')

{{-- CABECERA --}}
<table align="center" style="margin: 0 auto; font-family: Arial, sans-serif;width: 100%;">
  <tr>
    <td colspan="2" align="center">
      <table style="margin: 0 auto;">
        <tr>
          <td style="padding-right: 10px;">
            <img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono" width="40" style="display: block;">
          </td>
          <td>
            <h1 style="margin: 0; font-size: 18px; font-weight: bold;">
              {{ $formato->titulo() }}
            </h1>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size: 14px; padding-top: 4px;">
      Solicitud de requerimiento
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size: 12px;">
      Fecha de solicitud:
      {{ \Carbon\Carbon::parse($formato->levantamiento->created_at)->locale('es')->translatedFormat('d \d\e F \d\e\l Y') }}
    </td>
    <td></td> {{-- Celda vacía para mantener estructura --}}
  </tr>
</table>

<br>

{{-- SECCIÓN 1: Datos generales --}}
<table width="100%" style="font-size: 14px; background-color: #e5f6f5; border-radius: 10px; padding: 10px;">
<tr>
<th align="left">Área:</th>
<td>{{ $formato->area->area }}</td>
<th align="left">Solicitante:</th>
<td>{{ $formato->levantamiento->sol->getFullnameAttribute() }}</td>
</tr>
<tr>
<th align="left">Departamento:</th>
<td>{{ $formato->levantamiento->depto->departamento }}</td>
<th align="left">Quién autoriza:</th>
<td>{{ $formato->levantamiento->autorizador->getFullnameAttribute() }}</td>
</tr>
<tr>
<th align="left">Sistema:</th>
<td>{{ $formato->sistema->nombre_s }}</td>
<th align="left">Cliente:</th>
<td>{{ $formato->cliente->nombre_cl }}</td>
</tr>
</table>

<br>

{{-- SECCIÓN 2 --}}
<table width="100%" style="font-size: 14px; background-color: #e5f6f5; border-radius: 10px; padding: 15px;">

{{-- Desarrollo previo --}}
<tr>
<th align="left">
¿Existe desarrollo previo?
{{ $formato->previo == 1 ? 'Sí' : 'No' }}
</th>
{{--  <td>
{!! $formato->previo == 1 ? '☑ SÍ &nbsp;&nbsp; ⬜ NO' : '⬜ SÍ &nbsp;&nbsp; ☑ NO' !!}
</td> --}}
<th align="left">
Prioridad:
@php
$prioridad = $formato->levantamiento->prioridad;
$niveles = [3 => 'Alta', 2 => 'Media', 1 => 'Baja'];
@endphp
{{ $niveles[$prioridad] ?? 'Sin definir' }}
</th>
</tr>

{{-- Descripción del problema --}}
<tr>
<th align="left" colspan="2">Descripción del problema:</th>
</tr>
<tr>
<td colspan="2" style="background-color: white; padding: 10px; border-radius: 5px;">
<pre style="white-space: pre-wrap; font-family: inherit;">{{ $formato->levantamiento->problema }}</pre>
</td>
</tr>

{{-- Descripción general --}}
<tr>
<th align="left" colspan="2">Descripción general del requerimiento:</th>
</tr>
<tr>
<td colspan="2" style="background-color: white; padding: 10px; border-radius: 5px;">
<pre style="white-space: pre-wrap; font-family: inherit;">{{ $formato->levantamiento->general }}</pre>
</td>
</tr>

{{-- Descripción específica --}}
<tr>
<th align="left" colspan="2">Descripción específica del requerimiento:</th>
</tr>
<tr>
<td colspan="2" style="background-color: white; padding: 10px; border-radius: 5px;">
<pre style="white-space: pre-wrap; font-family: inherit;">{{ $formato->levantamiento->detalle }}</pre>
</td>
</tr>

{{-- Resultado esperado --}}
<tr>
<th align="left" colspan="2">Resultado esperado:</th>
</tr>
<tr>
<td colspan="2" style="background-color: white; padding: 10px; border-radius: 5px;">
{!! nl2br(e($formato->levantamiento->esperado)) !!}
</td>
</tr>

{{-- Sistemas relacionados --}}
@if (count($relaciones))
<tr><th align="left" colspan="2">Áreas o sistemas relacionados:</th></tr>
@foreach ($sistemas as $sistema)
@if (in_array($sistema->id_sistema, $relaciones))
<tr>
<td colspan="2" style="background-color: white; padding: 10px; border-radius: 5px;">
{{ $sistema->nombre_s }}
</td>
</tr>
@endif
@endforeach
@endif

{{-- Responsables involucrados --}}
@if (count($involucrados))
<tr><th align="left" colspan="2">Responsables del proceso actual y usuario funcional:</th></tr>
@foreach ($responsables as $resp)
@if (in_array($resp->id, $involucrados))
<tr>
<td colspan="2" style="background-color: white; padding: 10px; border-radius: 5px;">
{{ $resp->getFullnameAttribute() }}
</td>
</tr>
@endif
@endforeach
@endif

</table>

<br>

{{-- BOTONES --}}
<table width="100%" style="text-align: center;">
<tr>
</tr>
<tr>
@if ($formato->id_estatus == 10)
<td>@component('mail::button', ['url' => route('Rechazo', $formato->folio), 'color' => 'error'])Rechazar @endcomponent</td>
<td>@component('mail::button', ['url' => route('Respuesta', $formato->folio), 'color' => 'success'])Autorizar @endcomponent</td>
@else
<td>@component('mail::button', ['url' => route('Documentos', Crypt::encrypt($formato->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icon-it.png', 'color' => 'sp'])Iniciar sesión @endcomponent</td>
@endif
<td>@component('mail::button', ['url' => route('Archivo', Crypt::encrypt($formato->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icons/pdf.png', 'color' => 'pdf'])Ver PDF @endcomponent</td>
</tr>
</table>

Gracias,<br>
@endcomponent