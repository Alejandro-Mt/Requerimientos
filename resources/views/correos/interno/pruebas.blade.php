@component('mail::message')
<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
  <tr style="vertical-align: middle;">
    <td style="padding-right: 10px;">
      <img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono" width="40" style="display: block;">
    </td>
  </tr>
</table>
<div style="color: #718096; font-size: 16px;">
  Buen día <strong>{{$datos->rpip->getFullnameAttribute()}}</strong>,
  <br><br>
  Espero que estés teniendo un buen día. Se informa que testing ha concluido las pruebasdel requerimiento con folio <strong>{{$datos->folio}}</strong>, por lo que es posible continual con el proceso.
  <br><br>
  Gracias por su atención y cooperación en este asunto.
  <br><br>
  Saludos cordiales.
</div>

@component('mail::button', ['url' => route('Documentos', Crypt::encrypt($datos->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icon-it.png', 'color' => 'sp'])Iniciar sesión @endcomponent
@endcomponent