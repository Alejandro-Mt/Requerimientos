<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <title>SMART PLANNER</title>
    <!-- This Page CSS --> 
    <style>
      /*######################################### T-HEAD ##########################*/
      p,textarea{
        background-color: #ecfbfb;
        border:none;
      }
    </style>
  </head>
  <body class="u-body" align="center">
    <table align="center">
      <tr>
        <th style="vertical-align: top">
          <!--<img style="margin: 0px 10px 1Opx 0px;" src="{asset("assets/images/new_logo_3ti.png")}}" width="160" height="80"/>-->
        </th>
        <th width="350"><h2> Solicitud de Requerimientos</h2></th>
        <td width="150" style="vertical-align: bottom; text-align: right;">Fecha de Solicitud: {{date('d-m-20y',strtotime($formato->levantamiento->created_at))}}</tr>
      </tr>
    </table>
    <!-- Seccion 1 -->
    <table align="center" style="border: 2px solid;">
      <tr>
        <th align="right">Área:</th>
        <td align="left">{{$formato->area->area}}</td>
        <th align="right">Nombre de solicitante:</th>
        <td align="left">{{$formato->levantamiento->sol->getFullnameAttribute()}}</td>
        </tr>
      <tr>
        <th align="right">Departamento:</th>
        <td align="left">{{$formato->levantamiento->depto->departamento}}</td>
        <th align="right">Quién autoriza:</th>
        <td align="left">{{$formato->levantamiento->autorizador->getFullnameAttribute()}}</td>
      </tr>
      <tr>
        <th align="right">Sistema o aplicación:</th>
        <td align="left">{{$formato->sistema->nombre_s}}</td>
        <th align="right">Cliente:</th>
        <td align="left">{{$formato->cliente->nombre_cl}}</td>
      </tr>
      <!--<tr>
        <td></td>
        <td></td>
        <th align="right">Jefe del departamento:</th>
        <td align="left">{{$formato->j_dep}}</td>
      </tr>-->
    </table>
    <!-- seccion 2 -->
    <table width="660px" align="center">
      <tr>
      <th width="250" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="left">¿Existe desarrollo previo?:</th>
      <pre>
      @if ($formato->levantamiento->previo == 1)
        <td>SÍ</td>
        <td align="center">☑</td>
        <td>NO</td>
        <td align="center">⬜</td>
      @else
        <td>SÍ</td>
        <td align="center">⬜</td>
        <td>NO</td>
        <td align="center">☑</td>
        <td width="300"></td>
      @endif
      </pre>
      </tr>
    </table>

    <table width="660px" align="center">
      <thead>
        <tr>
          <th width="250" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="left">Descripción del problema:</th>
          <th width="240" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="right">Impacto en la operación:</th>
          @switch($formato->levantamiento->prioridad)
            @case(1)
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Alta</td>
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Media</td>
              <td width="5" align="right">☑</td>
              <td width="" align="left">Baja</td>
              @break
            @case(2)
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Alta</td>
              <td width="5" align="right">☑</td>
              <td width="" align="left">Media</td>
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Baja</td>
              @break
            @case(3)
              <td width="5" align="right">☑</td>
              <td width="" align="left">Alta</td>
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Media</td>
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Baja</td>
              @break
            @default
          @endswitch
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="660px" colspan="8" style="text-align: justify; border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px"><pre>{{$formato->levantamiento->problema}}</pre></td>
        </tr>
      </tbody>
    </table>

    <table width="660px" align="center">
      <thead>
        <tr>
          <th width="350" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="left">Descripción general del requerimiento:</th>
          <th width="140" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="right">Prioridad:</th>
          @switch($formato->levantamiento->impacto)
            @case(1)
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Alta</td>
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Media</td>
              <td width="5" align="right">☑</td>
              <td width="" align="left">Baja</td>
              @break
            @case(2)
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Alta</td>
              <td width="5" align="right">☑</td>
              <td width="" align="left">Media</td>
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Baja</td>
              @break
            @case(3)
              <td width="5" align="right">☑</td>
              <td width="" align="left">Alta</td>
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Media</td>
              <td width="5" align="right">⬜</td>
              <td width="" align="left">Baja</td>
              @break
            @default
          @endswitch
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="660px" colspan="8"  style="text-align: justify; border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px"><pre>{{$formato->levantamiento->general}}</pre></td>
        </tr>
      </tbody>
    </table>

    <table width="660px" align="center">
      <tr>
        <th width="660px" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="left">Descripción específica del requerimiento</th>
      </tr>
      <tr>
        <td width="660px" style="text-align: justify; border: 1px solid;background-color: #ecfbfb;border-radius: 50px;padding-right: 10px;padding-left: 10px"><pre>{{$formato->levantamiento->detalle}}</pre></td>
      </tr>

      <tr>
        <th width="660px" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="left">Resultado esperado</th>
      </tr>
      <tr>
        <td width="660px" style="text-align: justify; border: 1px solid;background-color: #ecfbfb;border-radius: 25px;padding: 10px">
            <pre>{{$formato->levantamiento->esperado}}</pre>
        </td>
      </tr>
      <tr>
      <th width="660px" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="left">Áreas o sistemas relacionados</th>
      </tr>
      @for ($i = 0; $i < count($relaciones); $i++)  
        @foreach ($sistemas as $sistema)
          @if ($relaciones[$i] == $sistema->id_sistema)
            <tr width="660px" style="background-color: #ecfbfb;border: 1px solid;border-radius: 50px;">
              <td style="text-align: justify;padding-right: 10px;padding-left: 10px"><pre>{{$sistema->nombre_s}}</pre></td>
            </tr>
          @endif 
        @endforeach
      @endfor 

      <tr>
        <th width="660px" style="border: 1px solid;background-color: #c3c4c4;padding-right: 10px;padding-left: 10px;" align="left">Responsables del proceso actual y usuario funcional:</th>
      </tr>
      @for ($i = 0; $i < count($involucrados); $i++)  
        @foreach ($responsables as $responsable)
          @if ($involucrados[$i] == $responsable->id)
            <tr width="660px" style="background-color: #ecfbfb;border: 1px solid;border-radius: 50px;">
              <td style="text-align: justify;padding-right: 10px;padding-left: 10px"><pre>{{$responsable->getFullnameAttribute()}}</pre></td>
            </tr>
          @endif 
        @endforeach
      @endfor
    </table>
    
    <h1 style="border-top: 5px solid"></h1><br>
    <h1 height="50"></h1>
    <!-- seccion final -->
    <table width="600" align="center" style="vertical-align: bottom;">
      <tr>
        <td width="150" align="center"></td>
        <td width="200" align="center" style="border-top: 1px solid;">Nombre y firma de quién Autoriza</td>
        <td width="150" align="center"></td>
      </tr>
      <tr>
        <td width="150" align="center" style="border-top: 1px solid;">Fecha de recepción por IT</td>
        <td width="200" align="center"></td>
        <td width="150" align="center" style="border-top: 1px solid;">Vo. Bo. IT</td>
      </tr>
      </table>
    <table>
    </body>
    <script>
      let area = document.querySelectorAll(".RE")
      
      window.addEventListener("DOMContentLoaded", () => {
        area.forEach((elemento) => {
          elemento.style.height = `${elemento.scrollHeight}px`
        })
      })    
  </script>
</html>