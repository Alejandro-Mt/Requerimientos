@component('mail::message')
<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
  <tr style="vertical-align: middle;">
    <td style="padding-right: 10px;">
      <img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono" width="40" style="display: block;">
    </td>
    <td style="text-align: left;">
      <div style="font-size: 22px; font-weight: bold; line-height: 1.2;">
        Definición de requerimiento
      </div>
    </td>
  </tr>
</table>
<div style="color: #718096; font-size: 16px;">
  Hola <strong>{{$datos->rtest->getFullnameAttribute()}}.</strong>,
  <br><br>
  Espero que estés teniendo un buen día. Se informa que se te ha asignado el requerimiento con folio <strong>{{$datos->folio ." ".$datos->descripcion}}</strong> para el proceso de testing.
  <br><br>
  Gracias por su atención y cooperación en este asunto.
  <br><br>
  Saludos cordiales.
</div>
{{-- BOTONES --}}
<table width="100%" style="text-align: center;">
<tr>
<td>@component('mail::button', ['url' => route('Documentos', Crypt::encrypt($datos->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icon-it.png', 'color' => 'sp'])Iniciar sesión @endcomponent</td>
</tr>
</table>
@endcomponent

