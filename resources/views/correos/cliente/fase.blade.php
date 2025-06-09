@component('mail::message')
<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
  <tr style="vertical-align: middle;">
    <td style="padding-right: 10px;">
      <img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/{{ $fase['icono'] }}.png" alt="Ícono" width="40" style="display: block;">
    </td>
    <td style="text-align: left;">
      <div style="font-size: 22px; font-weight: bold; line-height: 1.2;">
        {{ $fase['nombre'] }}<br>
      </div>
    </td>
  </tr>
</table>
<div style="color: #718096; font-size: 16px;">
  Buen dia.
  <br><br>
  EL requerimiento <strong>{{$datos->folio." ".$datos->descripcion}}</strong> ha cambiado su estatus a:
  <br><br>
  <strong>{{ $fase['nombre'] }}</strong>
</div>

@component('mail::button', ['url' => route('Documentos', Crypt::encrypt($datos->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icon-it.png', 'color' => 'sp'])Iniciar sesión @endcomponent
@endcomponent
