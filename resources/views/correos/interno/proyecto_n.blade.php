@component('mail::message')
<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
  <tr style="vertical-align: middle;">
    <td style="padding-right: 10px;">
      <img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono" width="40" style="display: block;">
    </td>
    <td style="text-align: left;">
      <div style="font-size: 22px; font-weight: bold; line-height: 1.2;">
        NUEVO PROYECTO<br>
        {{ $dato->descripcion }}
      </div>
    </td>
  </tr>
</table>
<div style="color: #718096; font-size: 16px;">
  Buen dia <strong>{{ $destinatario }}.</strong>
  <br><br>
  Se ha generado un nuevo proyecto en la plataforma.
  <br><br>
  <strong>{{ $dato->solicitante }}</strong>
</div>

@component('mail::button', ['url' => route('Documentos', Crypt::encrypt($formato->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icon-it.png', 'color' => 'sp'])Iniciar sesión @endcomponent
@endcomponent
