@extends('home')
@section('content')
<!-- tabla de seleccion por partes-->
<!--<div class="col-12">
  <div class="card">
    <div class="border-bottom title-part-padding">
      <h4 class="card-title mb-0">Custom Design Example</h4>
    </div>
    <div class="card-body wizard-content">
      <h6 class="card-subtitle mb-3"></h6>
      <form action="#" class="tab-wizard wizard-circle">
        <!-- Step 1 --
        <h6>Personal Info</h6>
        <section>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="firstName1">First Name :</label>
                <input
                  type="text"
                  class="form-control"
                  id="firstName1"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="lastName1">Last Name :</label>
                <input
                  type="text"
                  class="form-control"
                  id="lastName1"
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="emailAddress1">Email Address :</label>
                <input
                  type="email"
                  class="form-control"
                  id="emailAddress1"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="phoneNumber1">Phone Number :</label>
                <input
                  type="tel"
                  class="form-control"
                  id="phoneNumber1"
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="location1">Select City :</label>
                <select
                  class="form-select"
                  id="location1"
                  name="location"
                >
                  <option value="">Select City</option>
                  <option value="Amsterdam">India</option>
                  <option value="Berlin">USA</option>
                  <option value="Frankfurt">Dubai</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="date1">Date of Birth :</label>
                <input
                  type="date"
                  class="form-control"
                  id="date1"
                />
              </div>
            </div>
          </div>
        </section>
        <!-- Step 2 --
        <h6>Job Status</h6>
        <section>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="jobTitle1">Job Title :</label>
                <input
                  type="text"
                  class="form-control"
                  id="jobTitle1"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="videoUrl1">Company Name :</label>
                <input
                  type="text"
                  class="form-control"
                  id="videoUrl1"
                />
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="shortDescription1"
                  >Job Description :</label
                >
                <textarea
                  name="shortDescription"
                  id="shortDescription1"
                  rows="6"
                  class="form-control"
                ></textarea>
              </div>
            </div>
          </div>
        </section>
        <!-- Step 3 --
        <h6>Interview</h6>
        <section>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="int1">Interview For :</label>
                <input type="text" class="form-control" id="int1" />
              </div>
              <div class="mb-3">
                <label for="intType1">Interview Type :</label>
                <select
                  class="form-select"
                  id="intType1"
                  data-placeholder="Type to search cities"
                  name="intType1"
                >
                  <option value="Banquet">Normal</option>
                  <option value="Fund Raiser">Difficult</option>
                  <option value="Dinner Party">Hard</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="Location1">Location :</label>
                <select
                  class="form-select"
                  id="Location1"
                  name="location"
                >
                  <option value="">Select City</option>
                  <option value="India">India</option>
                  <option value="USA">USA</option>
                  <option value="Dubai">Dubai</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="jobTitle2">Interview Date :</label>
                <input
                  type="date"
                  class="form-control"
                  id="jobTitle2"
                />
              </div>
              <div class="mb-3">
                <label>Requirements :</label>
                <div class="c-inputs-stacked">
                  <div class="form-check">
                    <input
                      type="radio"
                      id="customRadio6"
                      name="customRadio"
                      class="form-check-input"
                    />
                    <label
                      class="form-check-label"
                      for="customRadio6"
                      >Employee</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      type="radio"
                      id="customRadio7"
                      name="customRadio"
                      class="form-check-input"
                    />
                    <label
                      class="form-check-label"
                      for="customRadio7"
                      >Contract</label
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Step 4 --
        <h6>Remark</h6>
        <section>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="behName1">Behaviour :</label>
                <input
                  type="text"
                  class="form-control"
                  id="behName1"
                />
              </div>
              <div class="mb-3">
                <label for="participants1">Confidance</label>
                <input
                  type="text"
                  class="form-control"
                  id="participants1"
                />
              </div>
              <div class="mb-3">
                <label for="participants1">Result</label>
                <select
                  class="form-select"
                  id="participants1"
                  name="location"
                >
                  <option value="">Select Result</option>
                  <option value="Selected">Selected</option>
                  <option value="Rejected">Rejected</option>
                  <option value="Call Second-time">
                    Call Second-time
                  </option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="decisions1">Comments</label>
                <textarea
                  name="decisions"
                  id="decisions1"
                  rows="4"
                  class="form-control"
                ></textarea>
              </div>
              <div class="mb-3">
                <label>Rate Interviwer :</label>
                <div class="c-inputs-stacked">
                  <div class="form-check">
                    <input
                      type="radio"
                      id="customRadio1"
                      name="customRadio"
                      class="form-check-input"
                    />
                    <label
                      class="form-check-label"
                      for="customRadio1"
                      >1 star</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      type="radio"
                      id="customRadio2"
                      name="customRadio"
                      class="form-check-input"
                    />
                    <label
                      class="form-check-label"
                      for="customRadio2"
                      >2 star</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      type="radio"
                      id="customRadio3"
                      name="customRadio"
                      class="form-check-input"
                    />
                    <label
                      class="form-check-label"
                      for="customRadio3"
                      >3 star</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      type="radio"
                      id="customRadio4"
                      name="customRadio"
                      class="form-check-input"
                    />
                    <label
                      class="form-check-label"
                      for="customRadio4"
                      >4 star</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      type="radio"
                      id="customRadio5"
                      name="customRadio"
                      class="form-check-input"
                    />
                    <label
                      class="form-check-label"
                      for="customRadio5"
                      >5 star</label
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </form>
    </div>
  </div>
</div>-->
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
              
              <table id="file_export" class="table table-striped table-bordered display">
                <thead>
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
    <!-- Chart-1 -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Real Time Chart</h5>
            <div id="real-time" style="height: 400px; padding: 0px; position: relative;">
              <canvas class="flot-base" width="753" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 753px; height: 400px;"></canvas>
              <div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;">
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 25px; text-align: center;">0</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 93px; text-align: center;">10</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 165px; text-align: center;">20</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 237px; text-align: center;">30</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 309px; text-align: center;">40</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 382px; text-align: center;">50</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 454px; text-align: center;">60</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 526px; text-align: center;">70</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 598px; text-align: center;">80</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 670px; text-align: center;">90</div>
                </div>
                <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;">
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 368px; left: 9px; text-align: right;">70</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 306px; left: 9px; text-align: right;">75</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 245px; left: 9px; text-align: right;">80</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 9px; text-align: right;">85</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 123px; left: 9px; text-align: right;">90</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 9px; text-align: right;">95</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 2px; text-align: right;">100</div>
                </div>
              </div>
              <canvas class="flot-overlay" width="753" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 753px; height: 400px;"></canvas>
              </div>
            <p>
              Time between updates:
              <input id="updateInterval" type="text" value="" style="text-align: right; width: 5em">
              milliseconds
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- ENd chart-1 -->
    <!-- Chart-2 -->
    <!--<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Turning-series chart</h5>
            <div id="placeholder" style="height: 400px; padding: 0px; position: relative;"><canvas class="flot-base" width="1019" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1019px; height: 400px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 33px; text-align: center;">1988</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 140px; text-align: center;">1990</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 246px; text-align: center;">1992</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 353px; text-align: center;">1994</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 460px; text-align: center;">1996</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 566px; text-align: center;">1998</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 673px; text-align: center;">2000</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 780px; text-align: center;">2002</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 886px; text-align: center;">2004</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 101px; top: 381px; left: 993px; text-align: center;">2006</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 368px; left: 34px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 306px; left: 2px; text-align: right;">100000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 245px; left: 2px; text-align: right;">200000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 2px; text-align: right;">300000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 123px; left: 2px; text-align: right;">400000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 2px; text-align: right;">500000</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 2px; text-align: right;">600000</div></div></div><canvas class="flot-overlay" width="1019" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1019px; height: 400px;"></canvas><div class="legend"><div style="position: absolute; width: 65.9531px; height: 133px; top: 14px; right: 18px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:14px;right:18px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(72,140,19);overflow:hidden"></div></div></td><td class="legendLabel">USA</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(27,85,192);overflow:hidden"></div></div></td><td class="legendLabel">Russia</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(218,75,15);overflow:hidden"></div></div></td><td class="legendLabel">UK</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(233,177,4);overflow:hidden"></div></div></td><td class="legendLabel">Germany</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(174,60,12);overflow:hidden"></div></div></td><td class="legendLabel">Denmark</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(57,112,15);overflow:hidden"></div></div></td><td class="legendLabel">Sweden</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(21,68,153);overflow:hidden"></div></div></td><td class="legendLabel">Norway</td></tr></tbody></table></div></div>
            <p id="choices" class="mt-3"><input type="checkbox" name="usa" checked="checked" id="idusa"><label for="idusa">USA</label><input type="checkbox" name="russia" checked="checked" id="idrussia"><label for="idrussia">Russia</label><input type="checkbox" name="uk" checked="checked" id="iduk"><label for="iduk">UK</label><input type="checkbox" name="germany" checked="checked" id="idgermany"><label for="idgermany">Germany</label><input type="checkbox" name="denmark" checked="checked" id="iddenmark"><label for="iddenmark">Denmark</label><input type="checkbox" name="sweden" checked="checked" id="idsweden"><label for="idsweden">Sweden</label><input type="checkbox" name="norway" checked="checked" id="idnorway"><label for="idnorway">Norway</label></p>
          </div>
        </div>
      </div>
    </div>-->
    <!-- End Chart-2 -->
    <!-- Cards -->
    <!--<div class="row">
      <div class="col-md-3">
        <div class="card mt-0">
          <div class="row">
            <div class="col-md-6">
              <div class="peity_line_neutral left text-center mt-2">
                <span><span style="display: none;"><span style="display: none;"><span style="display: none"><span style="display: none;">10,15,8,14,13,10,10</span><canvas width="50" height="24"></canvas></span>
                  <canvas width="50" height="24"></canvas>
                </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
                <h6>10%</h6>
              </div>
            </div>
            <div class="col-md-6 border-left text-center pt-2">
              <h3 class="mb-0 fw-bold">150</h3>
              <span class="text-muted">New Users</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mt-0">
          <div class="row">
            <div class="col-md-6">
              <div class="peity_bar_bad left text-center mt-2">
                <span><span style="display: none;"><span style="display: none;"><span style="display: none"><span style="display: none;">3,5,6,16,8,10,6</span><canvas width="50" height="24"></canvas></span>
                  <canvas width="50" height="24"></canvas>
                </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
                <h6>-40%</h6>
              </div>
            </div>
            <div class="col-md-6 border-left text-center pt-2">
              <h3 class="mb-0 fw-bold">4560</h3>
              <span class="text-muted">Orders</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mt-0">
          <div class="row">
            <div class="col-md-6">
              <div class="peity_line_good left text-center mt-2">
                <span><span style="display: none;"><span style="display: none;"><span style="display: none"><span style="display: none;">12,6,9,23,14,10,17</span><canvas width="50" height="24"></canvas></span>
                  <canvas width="50" height="24"></canvas>
                </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
                <h6>+60%</h6>
              </div>
            </div>
            <div class="col-md-6 border-left text-center pt-2">
              <h3 class="mb-0">5672</h3>
              <span class="text-muted">Active Users</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mt-0">
          <div class="row">
            <div class="col-md-6">
              <div class="peity_bar_good left text-center mt-2">
                <span><span style="display: none;">12,6,9,23,14,10,13</span><canvas width="50" height="24"></canvas></span>
                <h6>+30%</h6>
              </div>
            </div>
            <div class="col-md-6 border-left text-center pt-2">
              <h3 class="mb-0 fw-bold">2560</h3>
              <span class="text-muted">Register</span>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <!-- End cards -->
    <!-- Chart-3 -->
    <!--<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bar Chart</h5>
            <div class="flot-chart">
              <div class="flot-chart-content" id="flot-line-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" width="1019" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1019px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 23px; text-align: center;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 105px; text-align: center;">1</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 187px; text-align: center;">2</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 269px; text-align: center;">3</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 351px; text-align: center;">4</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 433px; text-align: center;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 515px; text-align: center;">6</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 597px; text-align: center;">7</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 679px; text-align: center;">8</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 762px; text-align: center;">9</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 840px; text-align: center;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 283px; left: 923px; text-align: center;">11</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 247px; left: 0px; text-align: right;">-1.0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 191px; left: 0px; text-align: right;">-0.5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 135px; left: 4px; text-align: right;">0.0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 79px; left: 4px; text-align: right;">0.5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 23px; left: 4px; text-align: right;">1.0</div></div></div><canvas class="flot-overlay" width="1019" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1019px; height: 300px;"></canvas><div class="legend"><div style="position: absolute; width: 49.75px; height: 38px; top: 14px; right: 13px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:14px;right:13px;;font-size:smaller;color:#AFAFAF"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(238,121,81);overflow:hidden"></div></div></td><td class="legendLabel">sin(x)</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(79,185,240);overflow:hidden"></div></div></td><td class="legendLabel">cos(x)</td></tr></tbody></table></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <!-- End chart-3 -->
    <!-- Charts -->
    <!--<div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pie Chart</h5>
            <div class="pie" style="height: 400px; padding: 0px; position: relative;"><canvas class="flot-base" width="479" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 479.5px; height: 400px;"></canvas><canvas class="flot-overlay" width="479" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 479.5px; height: 400px;"></canvas><div class="legend"><div style="position: absolute; width: 57.5469px; height: 95px; top: 5px; right: 5px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:5px;right:5px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(72,140,19);overflow:hidden"></div></div></td><td class="legendLabel">Series1</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(27,85,192);overflow:hidden"></div></div></td><td class="legendLabel">Series2</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(218,75,15);overflow:hidden"></div></div></td><td class="legendLabel">Series3</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(233,177,4);overflow:hidden"></div></div></td><td class="legendLabel">Series4</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(174,60,12);overflow:hidden"></div></div></td><td class="legendLabel">Series5</td></tr></tbody></table></div><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 66px; left: 285.648px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 66px; left: 285.648px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series1<br>22%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 299px; left: 284.648px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 299px; left: 284.648px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series2<br>35%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 303px; left: 101.648px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 303px; left: 101.648px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series3<br>7%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 232px; left: 49.6484px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 232px; left: 49.6484px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series4<br>12%</div></span><div class="pieLabelBackground" style="position: absolute; width: 40.1563px; height: 36px; top: 74px; left: 86.6484px; background-color: rgb(0, 0, 0); opacity: 0.5;"> </div><span class="pieLabel" id="pieLabel4" style="position: absolute; top: 74px; left: 86.6484px;"><div style="font-size:8pt;text-align:center;padding:2px;color:white;">Series5<br>24%</div></span></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Line Chart</h5>
            <div class="bars" style="height: 400px; padding: 0px; position: relative;"><canvas class="flot-base" width="479" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 479.5px; height: 400px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 17px; text-align: center;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 104px; text-align: center;">2</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 190px; text-align: center;">4</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 277px; text-align: center;">6</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 364px; text-align: center;">8</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 68px; top: 381px; left: 448px; text-align: center;">10</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 368px; left: 8px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 306px; left: 8px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 245px; left: 2px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 2px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 123px; left: 2px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 2px; text-align: right;">25</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 2px; text-align: right;">30</div></div></div><canvas class="flot-overlay" width="479" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 479.5px; height: 400px;"></canvas></div>
          </div>
        </div>
      </div>
    </div>--
</div>-->
    <!--This page plugins -->
@endsection
