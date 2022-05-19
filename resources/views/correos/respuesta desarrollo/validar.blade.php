@component('mail::message')
@foreach ($datos as $dato)
# {{$dato->folio}} {{$dato->descripcion}}

@if ($dato->fechades == NULL)
Se requiere confirmacion del cliente para continuar.
@else
El desarrollo no requiere archivos adicionales.
@endif
@endforeach


<br>
{{ config('app.name') }}
@endcomponent
