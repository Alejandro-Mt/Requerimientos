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
  Buen día <strong>{{$destinatario->solicitante}}.</strong>,
  <br><br>
  Te compartimos la definición de requerimiento para tu solicitud'<strong>{{$datos->folio." ".$datos->descripcion}} </strong>' agradecemos nos puedas ayudar con su revisión y autorización, en caso de tener alguna observación ponte en contacto con tu coordinador o ejecutivo PIP asignado por medio de la plataforma Smart Planner o vía correo electrónico, recuerda que sin tu autorización no será posible proseguir con la construcción del desarrollo ni contar con los tiempos en proceso del mismo.
  <br><br>
  Recibe un cordial saludo!
</div>
{{-- BOTONES --}}
<table width="100%" style="text-align: center;">
<tr>
<td>@component('mail::button', ['url' => route('Rechazo', $datos->folio), 'color' => 'error'])Rechazar @endcomponent</td>
<td>@component('mail::button', ['url' => route('Respuesta', $datos->folio), 'color' => 'success'])Autorizar @endcomponent</td>
<td>@component('mail::button', ['url' => route('Documentos', Crypt::encrypt($datos->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icon-it.png', 'color' => 'sp'])Iniciar sesión @endcomponent</td>
</tr>
</table>
@endcomponent

