@component('mail::message')
@foreach ($datos as $dato)
# {{$dato->folio}}

Se ha solicitado un nuevo requerimiento por: #{{$dato->solicitante}}

{{$dato->descripcion}}
    
@endforeach

<br>
{{ config('app.name') }}
@endcomponent
