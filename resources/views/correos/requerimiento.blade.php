@component('mail::message')

<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
<tr style="vertical-align: middle;">
<td style="padding-right: 10px;">
@if ($datos->id_estatus == 9)
@if ($datos->levantamiento->fecha_def == NULL)
<img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono rechazo" width="40" style="display: block;">
@else
<img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono" width="40" icon_docstyle="display: block;">
@endif
@elseif ($datos->levantamiento->fechaaut == NULL)
<img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono rechazo" width="40" icon_docstyle="display: block;">
@else
<img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono" width="40" icon_docstyle="display: block;">
@endif
</td>
<th style="text-align: left;">
<div style="font-size: 22px; font-weight: bold; line-height: 1.2;">
{{ $datos->folio }}<br>
{{ $datos->descripcion }}
</div>
</th>
</tr>
</table>
<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
<tr>
<td style="text-align: center; padding: 10px;">
@if ($datos->id_estatus == 9)
@if ($datos->levantamiento->fecha_def == NULL)
<p style="margin: 0;">El cliente ha rechazado la Definición de requerimiento, se recomienda contactar para mayor información.</p>
@else
<p style="margin: 0;">La definición ha sido autorizada por el cliente.</p>
@endif
@elseif ($datos->levantamiento->fechaaut == NULL)
<p style="margin: 0;">El cliente ha rechazado la propuesta de requerimiento, se recomienda contactar para mayor información.</p>
@else
<p style="margin: 0;">El requerimiento ha sido autorizado</p>
@endif
</td>
</tr>
<tr>
<th>
@if ($datos->id_estatus != 9)
<p>
Responsable de autorización:
{{ $datos->levantamiento->autorizador->getFullnameAttribute() }}
</p>
@endif
</th>
</tr>
</table>
@endcomponent