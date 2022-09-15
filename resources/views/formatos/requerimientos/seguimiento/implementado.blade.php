<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">Folio</th>
        <th class="text-center">Estatus</th>
        <th class="text-center">Cliente</th>
        <th class="text-center">Sistema</th>
        <th class="text-center">Acción</th>
      </tr>
    </thead>
    <tbody id="searchable">
      @foreach ($implementado as $registro)
        <tr id="{{$registro->folio}}"
          @if (Auth::user()->id_puesto < 6)
            @if (Auth::user()->id_area == 11)
                @if ($registro->folio[0] == 'A')
                    class="collapse show"
                @else
                    class="collapse"
                @endif
            @else
                @if ($registro->folio[0] == 'P')
                    class="collapse show"
                @else
                    class="collapse"
                @endif
            @endif 
          @else
            class="collapse show" 
          @endif
          onmousemove="lock('play{{$loop->iteration}}','btn{{$loop->iteration}}')">
          <!-- Folio -->
          <td class="col-md-2 text-center">
            <div class="form-group row">
              <div class="col-md-13" >
                <a href="{{route('Avance',$registro->folio)}}" style="color:rgb(85, 85, 85)">{{$registro->folio}}</a>
              </div>
            </div>
          </td>
          <!-- Titulo -->
          <td class="estatus col-md-3 text-center">
            <button type="button" class="w-100 btn btn-rounded text-dark">
              {{$registro->titulo}}
            </button>
          </td>
          <!-- cliente -->
          <td class="clientes text-center">{{$registro->nombre_cl}}</td>
          <!-- Sistema -->
          <td class="sistemas col-md-3 text-center">
            @foreach ($sistemas as $sistema) 
              @if ($registro->id_sistema == $sistema->id_sistema)
                {{$sistema->nombre_s}}
              @endif
            @endforeach
          </td>
          <!-- Accion -->
            <td class="col-md-2">
              <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-success text-white w-100" >
                <a href="#" style="color:white">Implementado</a>
              </button>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>