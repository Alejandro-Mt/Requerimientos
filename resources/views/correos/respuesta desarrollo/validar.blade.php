@component('mail::message')
<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
  <tr style="vertical-align: middle;">
    <td style="padding-right: 10px;">
      <img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/icon_doc.png" alt="Ícono" width="40" style="display: block;">{{-- mingcute_classify-2-fill--}}
    </td>
    <th style="text-align: left;">
      <div style="font-size: 22px; font-weight: bold; line-height: 1.2;">
        {{$dato->folio}}
        <br>
        {{$dato->descripcion}}
      </div>
    </th>
  </tr>
</table>
<div style="font-size: 16px;">
  Buen dia.
  <br><br>
  El equipo de Desarrollo ha definido el requerimiento como un impacto:
  <br><br>
@switch($dato->levantamiento->impacto)
@case(3)
<h1>Alto</h1>
@break
@case(2)
<h1>Medio</h1>
@break
@default
<h1>bajo</h1>
@endswitch($dato->impacto == NULL)
</div>

@component('mail::button', ['url' => route('Documentos', Crypt::encrypt($dato->folio)),'icon' => 'https://requerimientos.tiii.mx/assets/images/icon-it.png', 'color' => 'sp'])Iniciar sesión @endcomponent
@endcomponent
