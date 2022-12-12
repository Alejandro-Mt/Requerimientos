@component('mail::message')
# Se ha actualizado el orden de prioridad en **{{$sistema->nombre_s}}**
{{$usuario}} ha actualizado el orden de prioridad de los clientes 
en **{{$sistema->nombre_s}}** 
Por favor verifica los datos.

<br>
{{ config('app.name') }}
@endcomponent