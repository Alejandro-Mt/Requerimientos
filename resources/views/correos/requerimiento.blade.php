@component('mail::message')
@foreach ($datos as $dato)
# {{$dato->folio}} {{$dato->descripcion}}
@if ($dato->fechaaut == NULL)
El cliente ha rechazado la propuesta de requerimiento, se recomienda contactar para mayor información.   
@else
El requerimiento ha sido autorizado

{{$dato->nombre_r}} {{$dato->apellidos}}
@endif
@endforeach

<br>
{{ config('app.name') }}
@endcomponent
