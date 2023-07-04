@component('mail::message')
Buen día {{$usuario}}<br>

**A continuacion se enlistan los folios que se encuentran abiertos**
  <table>
    <thead>
      <tr>
        <th align="center">FOLIO</th>
        <th align="center">TITULO</th>
        <th align="center">ESTATUS</th>
        <th align="center">DIAS ACTIVO</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($registros as $folio)
        <tr>
          <td align="center">{{$folio->folio}}</th>
          <td align="center">{{$folio->descripcion}}</th>
          @if($folio->posicion < 6)
            <td align="center">LEVANTAMIENTO</th>
          @elseif($folio->posicion < 9)
            <td align="center">CONSTRUCCIÓN</th>
          @elseif($folio->posicion == 9)
            <td align="center">LIBERACION</th>
          @elseif($folio->posicion == 10)
            <td align="center">IMPLEMENTACION</th>
          @endif
          <td align="center">{{$folio->dias}}</th>
        </tr>
      @endforeach
    </tbody>
  </table>
<br>
{{ config('app.name') }}
@endcomponent