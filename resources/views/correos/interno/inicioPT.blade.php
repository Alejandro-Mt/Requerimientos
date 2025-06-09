@component('mail::message')
<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
  <tr style="vertical-align: middle;">
    <td style="padding-right: 10px;">
      <img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono" width="40" style="display: block;">
    </td>
  </tr>
</table>
<div style="color: #718096; font-size: 16px;">
  Buen día <strong>{{$datos->rtest->getFullnameAttribute()}}</strong>,
  <br><br>
  Se informa que desarrollo ha concluido los ajustes del requerimiento con folio <strong>{{$datos->folio}}</strong>, por lo que es necesario iniciar con las pruebas de los ajustes.
  <br><br>
  Gracias por su atención y cooperación en este asunto.
  <br><br>
  Saludos cordiales.
</div>

@component('mail::button', ['url' => route('Documentos', Crypt::encrypt($datos->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icon-it.png', 'color' => 'sp'])Iniciar sesión @endcomponent
@endcomponent