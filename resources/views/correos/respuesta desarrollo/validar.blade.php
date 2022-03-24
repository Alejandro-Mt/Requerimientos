@component('mail::message')
@foreach ($datos as $dato)
# {{$dato->folio}} {{$dato->descripcion}}

Se requiere confirmacion del cliente para continuar.
    
@endforeach


<br>
{{ config('app.name') }}
@endcomponent
