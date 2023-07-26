@component('mail::message')

**Hola {{$destinatario->solicitante}}.**

Te compartimos la definición de requerimiento para tu solicitud **{{$datos->folio." ".$datos->descripcion}}** agradecemos nos puedas ayudar con su revisión y autorización, en caso de tener alguna observación ponte en contacto con tu coordinador o ejecutivo PIP asignado por medio de la plataforma Smart Planner o vía correo electrónico, recuerda que sin tu autorización no será posible proseguir con la construcción del desarrollo ni contar con los tiempos en proceso del mismo.

Recibe un cordial saludo!
<br>

<table>
<td>@component('mail::button', ['url' => route('Rechazo',$datos->folio)])Rechazar @endcomponent</td>
<td>@component('mail::button', ['url' => route('Respuesta',$datos->folio)])Autorizar @endcomponent</td> 
</table>
$hora = levantamiento::findOrFail($folio);
{{ config('app.name') }}
@endcomponent