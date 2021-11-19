@component('mail::message')
@foreach ($datos as $dato)
# {{$dato->folio}} {{$dato->descripcion}}

El cliente ha rechazado la propuesta de requerimiento, se recomienda contactar para mayor información.
    
@endforeach


<br>
{{ config('app.name') }}
@endcomponent
