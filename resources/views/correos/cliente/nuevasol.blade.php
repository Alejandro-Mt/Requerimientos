@component('mail::message')

<table align="center" role="presentation" style="margin: 0 auto 20px auto;">
  <tr style="vertical-align: middle;">
    <td style="padding-right: 10px;">
      <img src="https://requerimientos.tiii.mx/storage/PIP-108-24/COMPLEMENTOS/ico-001.png" alt="Ícono" width="40" style="display: block;">
    </td>
    <td style="text-align: left;">
      <div style="font-size: 22px; font-weight: bold; line-height: 1.2;">
        {{ $dato->folio }}<br>
        {{ $dato->descripcion }}
      </div>
    </td>
  </tr>
</table>

<div style="color: #718096; font-size: 16px;">
  Se ha solicitado un nuevo requerimiento por:  <br><br>
  <strong>{{ $dato->solicitante }}</strong><br><br>

  {{ $dato->planteamiento }}
</div>
<table align="center" role="presentation" style="margin: 30px auto;">
  <tr>
    <td align="center" bgcolor="#101b5f" style="border-radius: 5px;">
      <!--<a href="{ route('Documentos', Crypt::encrypt($dato->folior)) }}"-->
        <a href="{{  route('Admsol')  }}"
         target="_blank"
         style="display: inline-block; padding: 12px 24px; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 5px;">
         <img src="https://requerimientos.tiii.mx/assets/images/icon-it.png"
              alt="icono"
              width="25"
              height="25"
              style="margin-right: 10px; display: inline-block; vertical-align: middle;">
         Iniciar Sesión
      </a>
    </td>
  </tr>
</table>
@endcomponent
