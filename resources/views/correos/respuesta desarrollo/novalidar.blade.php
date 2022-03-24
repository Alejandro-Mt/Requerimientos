@component('mail::message')
@foreach ($datos as $dato)
# {{$dato->folio}} {{$dato->descripcion}}

El desarrollo no requiere archivos adicionales.
    
@endforeach


<br>
{{ config('app.name') }}
@endcomponent
