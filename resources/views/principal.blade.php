@extends('home')
@section('content')

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="border-bottom title-part-padding">
            <h4 class="card-title mb-0">Excel</h4>
          </div>
          <div class="card-body">
            <!-- <h6 class="card-subtitle mb-3">
              Exporting data from a table can often be a key part of a
              complex application. The Buttons extension for DataTables
              provides three plug-ins that provide overlapping
              functionality for data export. You can refer full
              documentation from here
              <a href="https://datatables.net/">Datatables</a>
            </h6>-->
            <div class="table-responsive">
              
              <table id="file_export" class="table table-striped table-bordered display text-nowrap" style="width: 100%">
                <thead>
                  <tr>
                    <th class="header">*ID REQUERIMIENTO</th>
                    <th class="header">DESCRIPCIÓN</th>
                    <th class="header">*SUBPROCESO</th>
                    <th class="header">*SISTEMA</th>
                    <th class="header">*RESPONSABLE DESARROLLO</th>
                    <th class="header">*CLIENTE</th>
                    <th class="header">*RESPONSABLE PIP</th>
                    <th class="header">*TITULO COMPLETO EN BITRIX</th>
                    <th class="header">*PRIORIDAD</th>
                    <th class="header">NUMERO DE PRIORIDAD</th>
                    <th class="header">FECHA DE SOLICITUD DEL CLIENTE</th>
                    <th class="header">FECHA DE CREACIÓN DE FORMATO DE REQUERIMIENTO (PIP A CLIENTE)</th>
                    <th class="header">*DÍAS (SOLICITUD DEL CLIENTE - CREACIÓN DE FORMATO DE REQUERIMIENTO)</th>
                    <th class="header">FECHA DE AUTORIZACIÓN DE SOLICITUD CLIENTE</th>
                    <th class="header">*DÍAS (CREACIÓN DE FORMATO DE REQUERIMIENTO (PIP A CLIENTE) - AUTORIZACIÓN DE SOLICITUD CLIENTE)</th>
                    <th class="header">FECHA DE SOLICITUD A DESARROLLO</th>
                    <th class="header">EVIDENCIA DE SOLICITUD (FORMATO)</th>
                    <th class="header">*DÍAS (AUTORIZACIÓN DE SOLICITUD CLIENTE - SOLICITUD DESARROLLO)</th>
                    <th class="header">FECHA DE CONFIRMACIÓN DE ENTRGA DE FECHA PARA DEFINICIÓN DE REQUERIMIENTOS</th>
                    <th class="header">*DÍAS (SOLICITUD A DESARROLLO - CONFIRMACIÓN DE ENTREGA DE FECHA PARA DEFINICIÓN DE REQUERIMIENTOS)</th>
                    <th class="header">FECHA COMPROMISO ENTREGA DE DEFINICIÓN REQUERIMIENTO</th>
                    <th class="header">LINK DE EVIDENCIA/CORREO</th>
                    <th class="header">FECHA REAL DE ENTREGA DE DEFINICIÓN DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS (COMPROMISO ENTREGA DE DEFINICIÓN REQUERIMIENTO - REAL DE ENTREGA DE DEFINICIÓN DE REQUERIMIENTO)</th>
                    <th class="header">MOTIVO DE DESFASE EN ENTREGA DE DEFINICIÓN</th>
                    <th class="header">SI EL MOTIVO DE DESFASE = PAUSADO FECHA DE PAUSA</th>
                    <th class="header">EVIDENCIA DE PAUSA</th>
                    <th class="header">FECHA DE REACTIVACIÓN</th>
                    <th class="header">FECHA DE ENVÍO DE ANÁLISIS DE DEFINICION DE PIP A CLIENTE</th>
                    <th class="header">MOTIVO DE RETRASO EN ENVÍO DE ANÁLISIS</th>
                    <th class="header">*DÍAS (REAL DE ENTREGA DE DEFINICIÓN DE REQUERIMIENTO - ENVÍO DE ANÁLISIS DE DEFINICION DE PIP A CLIENTE)</th>
                    <th class="header">FECHA DE AUTORIZACIÓN CLIENTE DE ANÁLISIS PARA INICIAR CONSTRUCCIÓN</th>
                    <th class="header">*DÍAS (ENVÍO DE ANÁLISIS DE DEFINICION DE PIP A CLIENTE - AUTORIZACIÓN CLIENTE DE ANÁLISIS PARA INICIAR CONSTRUCCIÓN)</th>
                    <th class="header">FECHA DE INICIO CONSTRUCCIÓN DESARROLLO</th>
                    <th class="header">MOTIVOS DE DESFASE EN CONSTRUCCIÓN</th>
                    <th class="header">FECHA DE SOLICITUD DE INFORMACIÓN A PIP</th>
                    <th class="header">FECHA DE SOLICITUD DE INFORMACIÓN CLIENTE</th>
                    <th class="header">FECHA DE ENTREGA DE INFORMACIÓN DEL CLIENTE</th>
                    <th class="header">MOTIVO DE RETRASO EN ENTREGA DE INFORMACIÓN</th>
                    <th class="header">*DÍAS (SOLICITUD DE INFORMACIÓN CLIENTE - ENTREGA DE INFORMACIÓN DEL CLIENTE)</th>
                    <th class="header">FECHA DE LIBERACIÓN (AMBIENTE PIP)</th>
                    <th class="header">DESARROLLO	FECHA DE LIBERACIÓN REAL QA DESARROLLO</th>
                    <th class="header">*DÍAS (LIBERACIÓN (AMBIENTE PIP) DESARROLLO - LIBERACIÓN REAL QA DESARROLLO)</th>
                    <th class="header">FECHA DE INICIO DE PRUEBAS (AMBIENTE PIP)</th>
                    <th class="header">*DÍAS (LIBERACIÓN REAL QA DESARROLLO - INICIO DE PRUEBAS PIP (AMBIENTE PIP))</th>
                    <th class="header">FECHA DE LIBERACIÓN PRUEBAS QA</th>
                    <th class="header">*DÍAS (INICIO DE PRUEBAS (AMBIENTE PIP) - LIBERACIÓN A PRUEBAS QA)</th>
                    <th class="header">TOTAL DE PRUEBAS REALIZADAS</th>
                    <th class="header">EVIDENCIA DE PRUEBAS</th>
                    <th class="header">CRONOGRAMA DE IMPLEMENTACIÓN</th>
                    <th class="header">LINK CRONOGRAMA</th>
                    <th class="header">FECHA DE IMPLEMENTACIÓN</th>
                    <th class="header">*ESTATUS GENERAL</th>
                    <th class="header">*ESTATUS FUNCIONALIDAD EN PRODUCCIÓN</th>
                    <th class="header">SEGUIMIENTO</th>
                    <th class="header">COMENTARIOS</th>
          					<th class="header">*DURACIÓN TOTAL DEL PROYECTO</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tabla as $registro)
                    <tr>
                      <td>{{$registro->folio}}</td>
                      <td>{{$registro->descripcion}}</td>
                      <td>{{$registro->subproceso}}</td>
                      <td>{{$registro->nombre_s}}</td>
                      <td>{{$registro->Arquitecto}}</td>
                      <td>{{$registro->nombre_cl}}</td>
                      <td>{{$registro->nombre_r}}</td>
                      <td>{{$registro->Bitrix}}</td>
                      <th>{{'no-data'}}</th>
                      <th>{{'no-data'}}</th>
                      <td>@if($registro->solicitud <> null) {{date('d-m-20y',strtotime($registro->solicitud))}} @endif</td>
                      <td>@if($registro->formato <> null) {{date('d-m-20y',strtotime($registro->formato))}} @endif</td>
                      <td>{{$registro->Dif}}</td>
                      <td>@if($registro->Autorizacion <> null) {{date('d-m-20y',strtotime($registro->Autorizacion))}} @endif</td>
                      <td>{{$registro->difAut}}</td>
                      <td>@if($registro->Autorizacion <> null) {{date('d-m-20y',strtotime($registro->Autorizacion))}} @endif</td><!-- fechades-->
                      <td>{{'link'}}</td>
                      <td>{{$registro->difdes}}</td>
                      <td>{{'no-data'}}</td>
                      <td>{{'no-data'}}</td>
                      <td>@if($registro->fechaCompReqC <> null) {{date('d-m-20y',strtotime($registro->fechaCompReqC))}} @endif</td>
                      <td>{{$registro->evidencia}}</td>
                      <td>@if($registro->fechaCompReqR <> null) {{date('d-m-20y',strtotime($registro->fechaCompReqR))}} @endif</td>
                      <td>{{$registro->diascomp}}</td>
                      <th>{{$registro->motivo}}</th>
                      <th>{{$registro->motivopausa}}</th>
                      <th>{{$registro->evPausa}}</th>
                      <th>@if($registro->fechaReact <> null) {{date('d-m-20y',strtotime($registro->fechaReact))}} @endif</th>
                      <th>@if($registro->envioAnalisis <> null) {{date('d-m-20y',strtotime($registro->envioAnalisis))}} @endif</th>
                      <th>{{$registro->motivodesfase}}</th>
                      <th>{{$registro->diasAn}}</th>
                      <th>@if($registro->autCl <> null) {{date('d-m-20y',strtotime($registro->autCl))}} @endif</th>
                      <th>{{$registro->diasAut}}</th>
                      <th>@if($registro->fechaConst <> null) {{date('d-m-20y',strtotime($registro->fechaConst))}} @endif</th>
                      <th>{{$registro->motivoDC}}</th>
                      <th>@if($registro->solInfopip <> null) {{date('d-m-20y',strtotime($registro->solInfopip))}} @endif</th>
                      <th>@if($registro->solInfoC <> null) {{date('d-m-20y',strtotime($registro->solInfoC))}} @endif</th>
                      <th>@if($registro->respuesta <> null) {{date('d-m-20y',strtotime($registro->respuesta))}} @endif</th>
                      <th>{{$registro->mri}}</th>
                      <th>{{$registro->diasInfo}}</th>
                      <th>@if($registro->fecha_lib_a <> null) {{date('d-m-20y',strtotime($registro->fecha_lib_a))}} @endif</th>
                      <th>@if($registro->fecha_lib_r <> null) {{date('d-m-20y',strtotime($registro->fecha_lib_r))}} @endif</th>
                      <th>{{$registro->diasL}}</th>
                      <th>@if($registro->inicio_lib <> null) {{date('d-m-20y',strtotime($registro->inicio_lib))}} @endif</th>
                      <th>{{$registro->diasInicioL}}</th>
                      <th>@if($registro->inicio_p_r <> null) {{date('d-m-20y',strtotime($registro->inicio_p_r))}} @endif</th>
                      <th>{{$registro->diasPL}}</th>
                      <th>{{$registro->t_pruebas}}</th>
                      <th>{{$registro->evidencia_p}}</th>
                      <th>{{$registro->cronograma}}</th>
                      <th>{{$registro->link_c}}</th>
                      <th>@if($registro->f_implementacion <> null) {{date('d-m-20y',strtotime($registro->f_implementacion))}} @endif</th>
                      <th>{{$registro->titulo}}</th>
                      <th>{{$registro->estatus_f}}</th>
                      <th>{{$registro->seguimiento}}</th>
                      <th>{{$registro->comentarios}}</th>
                      <th>{{$registro->duracion}}</th>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>*ID REQUERIMIENTO</th>
                    <th>DESCRIPCIÓN</th>
                    <th>*SUBPROCESO</th>
                    <th>*SISTEMA</th>
                    <th>*RESPONSABLE DESARROLLO</th>
                    <th>*CLIENTE</th>
                    <th>*RESPONSABLE PIP</th>
                    <th>*TITULO COMPLETO EN BITRIX</th>
                    <th>*PRIORIDAD</th>
                    <th>NUMERO DE PRIORIDAD</th>
                    <th>FECHA DE SOLICITUD DEL CLIENTE</th>
                    <th>FECHA DE CREACIÓN DE FORMATO DE REQUERIMIENTO (PIP A CLIENTE)</th>
                    <th>*DÍAS (SOLICITUD DEL CLIENTE - CREACIÓN DE FORMATO DE REQUERIMIENTO)</th>
                    <th>FECHA DE AUTORIZACIÓN DE SOLICITUD CLIENTE</th>
                    <th>*DÍAS (CREACIÓN DE FORMATO DE REQUERIMIENTO (PIP A CLIENTE) - AUTORIZACIÓN DE SOLICITUD CLIENTE)</th>
                    <th>FECHA DE SOLICITUD A DESARROLLO</th>
                    <th>EVIDENCIA DE SOLICITUD (FORMATO)</th>
                    <th>*DÍAS (AUTORIZACIÓN DE SOLICITUD CLIENTE - SOLICITUD DESARROLLO)</th>
                    <th>FECHA DE CONFIRMACIÓN DE ENTRGA DE FECHA PARA DEFINICIÓN DE REQUERIMIENTOS</th>
                    <th>*DÍAS (SOLICITUD A DESARROLLO - CONFIRMACIÓN DE ENTREGA DE FECHA PARA DEFINICIÓN DE REQUERIMIENTOS)</th>
                    <th>FECHA COMPROMISO ENTREGA DE DEFINICIÓN REQUERIMIENTO</th>
                    <th>LINK DE EVIDENCIA/CORREO</th>
                    <th>FECHA REAL DE ENTREGA DE DEFINICIÓN DE REQUERIMIENTO</th>
                    <th>*DÍAS (COMPROMISO ENTREGA DE DEFINICIÓN REQUERIMIENTO - REAL DE ENTREGA DE DEFINICIÓN DE REQUERIMIENTO)</th>
                    <th>MOTIVO DE DESFASE EN ENTREGA DE DEFINICIÓN</th>
                    <th>SI EL MOTIVO DE DESFASE = PAUSADO FECHA DE PAUSA</th>
                    <th>EVIDENCIA DE PAUSA</th>
                    <th>FECHA DE REACTIVACIÓN</th>
                    <th>FECHA DE ENVÍO DE ANÁLISIS DE DEFINICION DE PIP A CLIENTE</th>
                    <th>MOTIVO DE RETRASO EN ENVÍO DE ANÁLISIS</th>
                    <th>*DÍAS (REAL DE ENTREGA DE DEFINICIÓN DE REQUERIMIENTO - ENVÍO DE ANÁLISIS DE DEFINICION DE PIP A CLIENTE)</th>
                    <th>FECHA DE AUTORIZACIÓN CLIENTE DE ANÁLISIS PARA INICIAR CONSTRUCCIÓN</th>
                    <th>*DÍAS (ENVÍO DE ANÁLISIS DE DEFINICION DE PIP A CLIENTE - AUTORIZACIÓN CLIENTE DE ANÁLISIS PARA INICIAR CONSTRUCCIÓN)</th>
                    <th>FECHA DE INICIO CONSTRUCCIÓN DESARROLLO</th>
                    <th>MOTIVOS DE DESFASE EN CONSTRUCCIÓN</th>
                    <th>FECHA DE SOLICITUD DE INFORMACIÓN A PIP</th>
                    <th>FECHA DE SOLICITUD DE INFORMACIÓN CLIENTE</th>
                    <th>FECHA DE ENTREGA DE INFORMACIÓN DEL CLIENTE</th>
                    <th>MOTIVO DE RETRASO EN ENTREGA DE INFORMACIÓN</th>
                    <th>*DÍAS (SOLICITUD DE INFORMACIÓN CLIENTE - ENTREGA DE INFORMACIÓN DEL CLIENTE)</th>
                    <th>FECHA DE LIBERACIÓN (AMBIENTE PIP)</th>
                    <th>DESARROLLO	FECHA DE LIBERACIÓN REAL QA DESARROLLO</th>
                    <th>*DÍAS (LIBERACIÓN (AMBIENTE PIP) DESARROLLO - LIBERACIÓN REAL QA DESARROLLO)</th>
                    <th>FECHA DE INICIO DE PRUEBAS (AMBIENTE PIP)</th>
                    <th>*DÍAS (LIBERACIÓN REAL QA DESARROLLO - INICIO DE PRUEBAS PIP (AMBIENTE PIP))</th>
                    <th>FECHA DE LIBERACIÓN PRUEBAS QA</th>
                    <th>*DÍAS (INICIO DE PRUEBAS (AMBIENTE PIP) - LIBERACIÓN A PRUEBAS QA)</th>
                    <th>TOTAL DE PRUEBAS REALIZADAS</th>
                    <th>EVIDENCIA DE PRUEBAS</th>
                    <th>CRONOGRAMA DE IMPLEMENTACIÓN</th>
                    <th>LINK CRONOGRAMA</th>
                    <th>FECHA DE IMPLEMENTACIÓN</th>
                    <th>*ESTATUS GENERAL</th>
                    <th>*ESTATUS FUNCIONALIDAD EN PRODUCCIÓN</th>
                    <th>SEGUIMIENTO</th>
                    <th>COMENTARIOS</th>
          					<th>*DURACIÓN TOTAL DEL PROYECTO</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection
