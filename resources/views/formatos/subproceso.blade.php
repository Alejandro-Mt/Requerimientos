@extends('home')
@section('content')

    <div class="card">
        <div class="card-body wizard-content">
            <h3>Subproceso</h3>
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Sub')}}" class="mt-5">
                {{ csrf_field() }}
                <div>
                    <section>
                        <div class="form-group row">
                            <label for="Folio"
                                    class="col-sm-2 text-end control-label col-form-label">Folio</label>
                            <div class="col-sm-3">
                                @foreach ($registros as $registro)
                                    
                                    <input type="text" class="required form-control" name="folio" value="{{$registro->folio}}" readonly="readonly">
                            
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subproceso"
                                    class="col-sm-2 text-end control-label col-form-label">Subproceso</label>
                            <div class="col-sm-3">
                                @foreach ($registros as $registro)
                                        @if ($vacio == 0)
                                            <input type="text" class="required form-control" name="subproceso" value="{{$registro->folio}}-1" readonly="readonly">
                                        @else   
                                            <input type="text" class="required form-control" name="subproceso" value="{{$registro->folio}}-{{$vacio+1}}" readonly="readonly">
                                        @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="previsto"
                                class="col-sm-2 text-end control-label col-form-label">Fecha Prevista de Entrega*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input name="previsto" type="text" class="form-control mydatepicker" placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                        <!--<div class="d-none"> 
                                <input type="text" name="id_estatus" value="9" visible="false">
                        </div>-->
                        </div>
                        <div class="card-body text-center">
                            <button type="submit" name="estatus" value="pendiente" class="btn btn-success text-white">Guardar</button>
                            <label> </label> 
                            <button type="reset" value="reset" class="btn btn-danger"><a href="{{('formatos.requerimientos.edit') }}" style="color:white">Cancelar</a></button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>

    <form class="form-horizontal" action="" method="post">
    <h5>*Campos obligatorios</h5>

    

@endsection 