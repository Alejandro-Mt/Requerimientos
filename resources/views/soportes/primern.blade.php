@extends('home')
@section('content')
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@if (session('alert'))
  <input class="d-none" id="folio" value={{ session('alert') }}>
  <script>
    $(document).ready(function(){
      toastr.success(
        "N° folio: " + $("#folio").val(),
        "¡Guardado!",                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
      );
    });
  </script>
@endif
<form method="POST" action="" class="mt-5">
  {{ csrf_field() }}
  <h3>Soportes</h3>
  <p>(*) Campos Obligatorios</p>
  <!--<div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Nombre Completo*</h5>
      <p class="card-text">
        <input type="text" class="text-capitalize required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Nombre Apellidos" required autofocus>
        @error('descripcion')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
              </span>
        @enderror
      </p>
    </div>
  </div>-->
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Atiende (Nivel 1)*</h5>
      <p class="card-text">
        <select class="form-select @error ('id_cliente') is-invalid @enderror" style="width: 100%; height:36px;" name="id_cliente" tabindex="-1" aria-hidden="true" required autofocus>
          <option value={{null}}>Selección</option>
            <option value={{1}}>MARISELA SANCHEZ ZUVIRI</option>
            <option value={{2}}>RAMÓN RAMOS GALEANA</option>
            <option value={{3}}>ROBERTO DE LA CRUZ HERNANDEZ</option>
            <option value={{4}}>JOSE RICARDO SANCHEZ NERIA</option>
            <option value={{5}}>MAURICIO ESPINOSA LOPEZ</option>
            <option value={{6}}>LIZBETH RIOS ORTA</option>
            <option value={{7}}>JOSUE DAMIAN VALDES ORTIZ</option>
            <option value={{8}}>MARIA FERNANDA BRAVO OLGUIN</option>
            <option value={{9}}>MIGUEL ANGEL SEBASTIAN SALINAS</option>
            <option value={{10}}>LUIS RAMON MEDINA RODRIGUEZ</option>
            <option value={{11}}>TEAM (NIVEL 2)</option>
          @error('id_cliente')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror                          
        </select>
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Tipificación de la incidencia*</h5>
      <p class="card-text">
        <select class="form-select @error('id_responsable') is-invalid  @enderror" style="width: 100%; height:36px;" name="id_responsable" tabindex="-1" aria-hidden="true" required autofocus>
          <option value={{null}}>Selección</option>
          <option value={{null}}>1 CONSULTA ESTATUS DE TICKET</option>
          <option value={{null}}>2 ERROR NO IDENTIFICADO</option>
          <option value={{null}}>TM 1 ASIGNACION DE TIENDAS</option>
          <option value={{null}}>TM 1 ACTIVACION DE USUARIO</option>
          <option value={{null}}>TM 1 EL REPORTE NO CORRESPONDE A UN SISTEMA DE TRIPLE I</option>
          <option value={{null}}>TM 1 CONFIGURACIÓN MÓVIL</option>
          <option value={{null}}>TM1 CONFIGURACIÓN DE FECHA Y HORA</option>
          <option value={{null}}>TM 1 SOLICITUD DE USUARIO</option>
          <option value={{null}}>TM 1 RUTA NO CORRESPONDE</option>
          <option value={{null}}>TM 1 VERSION TEAM</option>
          <option value={{null}}>TM 1 PROBLEMAS DE RED</option>
          <option value={{null}}>TM 1 DATOS MÓVILES</option>
          <option value={{null}}>TM 1 REVISIÓN DE REGISTROS</option>
          <option value={{null}}>TM 1 MIGRACIÓN</option>
          <option value={{null}}>TM 1 SINCRONIZACION</option>
          <option value={{null}}>TM 1 ENVÍO INFORMACIÓN</option>
          <option value={{null}}>TM 1 DESCARGAR INFORMACIÓN</option>
          <option value={{null}}>TM 1 GPS</option>
          <option value={{null}}>TM 1 y 2 FOLIO NO EXISTE</option>
          <option value={{null}}>TM 1 SONDEOS Y MÓDULOS EN BLANCO</option>
          <option value={{null}}>TM 1 y 2 NO SE MUESTRAN PRODUCTOS</option>
          <option value={{null}}>TM 1 TEAM SE DETUVO</option>
          <option value={{null}}>TM 1 END OF INPUT CARÁCTER OF 0</option>
          <option value={{null}}>TM 1 NO ES POSIBLE AUTENTICAR</option>
          <option value={{null}}>TM 1 SERVICIO DE ÚBICACION GPS</option>
          <option value={{null}}>TM 1 DATA BASE DISK</option>
          <option value={{null}}>TM 1 UNABLE TO RESOLVE HOST</option>
          <option value={{null}}>TM 1 TIENDAS PENDIENTES POR SINCRONIZAR</option>
          <option value={{null}}>TM 2 GET EXHIBICION CONFG</option>
          <option value={{null}}>TM 2 GET RUTAS</option>
          <option value={{null}}>TM 2 FOTO INSERT</option>
          <option value={{null}}>TM 2 ID USUARIO INSERT</option>
          <option value={{null}}>TM 2 ASISTENCIA SALIDA INSERT</option>
          <option value={{null}}>ST 1 EL CÓDIGO DE EMPLEADO NO ES VALIDO</option>
          <option value={{null}}>ST 1 RELACIÓN LABORAL NO TIENE DISPONIBILIDAD PARA EL MONTO DEL PRÉSTAMO SOLICITADO.</option>
          <option value={{null}}>ST 2 RFC NO ASOCIADO CON LA LOCALIDAD</option>
          <option value={{null}}>ST 2 ERROR 202 EN RECIBOS DE NOMINA</option>
          <option value={{null}}>ST 2 ERROR 515</option>
          <option value={{null}}>CA 1 CÓDIGO DE ESTADO 500</option>
          <option value={{null}}>CA 1 INFORMACIÓN DE ASISTENCIAS EN BLANCO</option>
          <option value={{null}}>CA 1 CONTRASEÑA</option>
          <option value={{null}}>CA 1 NETWORK</option>
          <option value={{null}}>CA 2 INGRESA UN CORREO ELECTRÓNICO VALIDO</option>
          <option value={{null}}>CA 2 CLIENTES: TYPEERROR: CANNOT READ PROPERTY ¨IDMARCA¨ OF UNDEFINED</option>
          <option value={{null}}>CA 1 ERROR 8152</option>
          <option value={{null}}>CA 1 SIN REGISTRO DE SALIDA DE UN DÍA ANTES</option>
          <option value={{null}}>MNT 1 NO FINALIZÓ JORNADA</option>
          <option value={{null}}>MNT 1 ASESORÍA USO DE PORTAL WEB</option>
          <option value={{null}}>MNT 1 PROBLEMAS DE RED</option>
          <option value={{null}}>MNT 1 DATOS MÓVILES</option>
          <option value={{null}}>MNT 1 ERROR \&quot;AMBIENTES&quot;\</option>
          <option value={{null}}>MNT 1 ACTUALIZACIÓN DE VERSIÓN APP</option>
          <option value={{null}}>MNT 2 CONTRASEÑA</option>
          <option value={{null}}>MNT 2 PROBLEMA PARA CARGA DE PLAN O GENERACIÓN DE RUTAS</option>
          <option value={{null}}>MNT 2 PROBLEMA PARA GENERAR RECOLECCIONES / PERIODOS</option>
          <option value={{null}}>MNT 2 SOLICITUD DE USUARIO</option>
          <option value={{null}}>MNT 1 Y 2 CARGA DE PLAN</option>
          <option value={{null}}>RHIN 2 CHECK LIST TEMPLATE</option>
          <option value={{null}}>RHIN 2 LA CADENA DE ENTRADA NO TIENE UN FORMATO COMPLETO</option>
          <option value={{null}}>RHIN 2 EL EMPLEADO YA TIENE UNA RELACIÓN LABORAL ACTIVA</option>
          <option value={{null}}>RHIN 2 NO PUEDEN VISUALIZAR LOS SECTORES</option>
          <option value={{null}}>RHIN 2 EL CÓDIGO DE EMPLEADO YA FUE ASIGNADO A OTRA RELACIÓN LABORAL EN EL PROYECTO</option>
          <option value={{null}}>RHIN 2 EL USUARIO NO TIENE PERMISOS A LA COMPAÑÍA SELECCIONADA MOVIMIENTO DUPLICADO</option>
          <option value={{null}}>RHIN 2 REPORTA EL EJECUTIVO DE CUENTA QUE NO APARECE EL EMPLEADO PARA PODER REALIZAR UNA CORRECCIÓN</option>
          <option value={{null}}>RHIN 2 LA COLONIA DE RESIDENCIA DEL EMPLEADO NO ES VALIDO</option>
          <option value={{null}}>RHIN 2 NO EXISTEN REGISTROS PARA LOS PARÁMETROS SELECCIONADOS</option>
          <option value={{null}}>RHIN 2 EL SDI APARECE ERRONEO</option>
          <option value={{null}}>RHIN 2 ACTIVACIÓN DE PERIODO DE NOMINA (INCIDENCIAS)</option>
          <option value={{null}}>RHIN 2 ASIGNACIÓN DE SECTOR, REGIÓN O GRUPO DE PAGO</option>
          <option value={{null}}>RHIN 2 ERROR EN CAMBIO DE CONTRASEÑA</option>
          <option value={{null}}>RHIN 2 CREACIÓN DE UN NUEVO SECTOR</option>
          <option value={{null}}>RHIN 2 PERMISOS PARA VISUALIZAR PANTALLAS</option>
          <option value={{null}}>BI 2 PROBLEMAS EN REPORTEADOR</option>
          <option value={{null}}>PREC 2 CONTRASEÑA</option>
          <option value={{null}}>PREC 2 NOT FOUND</option>
          <option value={{null}}>PREC 2 SIN ACCESO A LA PLATAFORMA</option>
          <option value={{null}}>PREC 2 ERROR 99999</option>
          <option value={{null}}>PREC 2 NO PUEDE ASIGNAR PERGUNTAS</option>
          <option value={{null}}>PREC 2 NO VISUALIZA LA VACANTE</option>
          <option value={{null}}>PREC 2 NO PUEDE VER LOS VIDEOS DE ENTREVISTA</option>
          <option value={{null}}>PREC 2 LA PLATAFORMA TARDA EN CARGA DE INFORMACIÓN</option>
          <option value={{null}}>PREC 1 NO SE VISUALIZA LA INFORMACIÓN COMPLETA</option>
          <option value={{null}}>PREC 1 NO PUEDO INGRESAR A LA PLATAFORMA</option>
          <option value={{null}}>PREC 1 NO PUEDO INGRESAR AL PROYECTO</option>
          <option value={{null}}>PREC 1 NO VISUALIZAN LAS SOLICITUDES</option>
          <option value={{null}}>PREC 2 NO PUEDO EDITAR EL PAQUETE DE COMPENSACIÓN PORQUE NO SE VE EN LA PLATAFORMA</option>
          <option value={{null}}>PREC 2 NO SE VISUALIZA EL PERFIL PARA PODER CAPTURAR LA SOLICITUD</option>
          <option value={{null}}>PREC 2 NO PUEDO EDITAR O CAPTURAR EL HORARIO</option>
          <option value={{null}}>PREC 2 NO VEO LOS VIDEOS DE LOS CANDIDATOS</option>
          <option value={{null}}>PREC 2 NO SE GUARDAN LAS RUTAS CAPTURADAS</option>
          <option value={{null}}>PREC 1 NO PUEDO VER MI SOLCITUD CREADA</option>
          <option value={{null}}>PREC 1 NO ME PERMITE MODIFICAR EL PUESTO</option>
          <option value={{null}}>PREC 1 NO VISUALIZO LA RUTA CAPTURADA</option>
          <option value={{null}}>PREC 1 NO PUEDO DESCARGAR EL CV DE LOS CANDIDATOS</option>
          <option value={{null}}>PREC 1 NO VISULIZO LOS REQUISITOS ADICIONALES INDIPENSABLES QUE CAPTURÉ</option>
          <option value={{null}}>PREC 2 NO VISUALIZO MI SOLICITUD CREADA</option>
          <option value={{null}}>PREC 2 PLATAFORMA</option>
          <option value={{null}}>PREC 2 MI RECLU</option>
          <option value={{null}}>PREC 2 NOTIFICACIONES</option>
        </select>
        @error('id_responsable')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </p>
    </div>
  </div>
  <!--<div class="card">
    <div class="card-body wizard-content">
      <p class="card-text">
        <div class="form-group row">
          <div class="col-md-8">
            <input type="radio" class="form-check-input" id="desfase" name="desfase" value="1" data-bs-toggle="collapse" data-bs-target="#Nivel1" data-parent="#accordion">
            <label class="form-check-label mb-0" for="customControlValidation1">RESUELTO</label>
          </div>
          <div class="col-md-8">
            <input type="radio" class="form-check-input" id="desfase" name="desfase" value="1" data-bs-toggle="collapse" data-bs-target="#Nivel2" data-parent="#accordion">
            <label class="form-check-label mb-0" for="customControlValidation1">CANALIZADO</label>
          </div>
        </div>
        <select class="form-select @error ('id_sistema') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_sistema" tabindex="-1" aria-hidden="true" required autofocus>
          <option value={{null}}>Selección</option>
          @foreach ($sistema as $valores):
            <option value={{$valores->id_sistema}}>{{$valores->nombre_s}}</option>;
          @endforeach;  
          @error('id_sistema')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror                        
        </select>
      </p>
    </div>
  </div>-->
  <!-- Segundo nivel -->
<div id="accordion">
  <div class="card">
    <div class="card-body wizard-content" id="headingOne">
      <h5 class="card-title">Estatus de la atención*</h5>
      <div class="col-md-8">
        <input type="radio" class="form-check-input" id="desfase" name="desfase" value="1" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <label class="form-check-label mb-0" for="customControlValidation1">RESUELTO</label>
      </div>
    </div>
    <div class="card-body wizard-content" id="headingTwo">
      <div class="col-md-8">
        <input type="radio" class="form-check-input" id="desfase" name="desfase" value="1" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <label class="form-check-label mb-0" for="customControlValidation1">CANALIZADO</label>
      </div>
    </div>
  </div>
  <div class="card">
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion"></div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
      <div class="card">
        <div class="card-body wizard-content">
          <h5 class="card-title">Selecciona la entrada de la atención*</h5>
          <p class="card-text">
            <div class="col-md-8">
              <!--<div class="form-check">-->
              <input type="radio" class="form-check-input" id="customControlValidation1" name="previo" required>
              <label class="form-check-label mb-0" for="customControlValidation1">LLAMADA TELEFONICA</label>
            </div>
            @error('id_responsable')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </p>
          <p class="card-text">
            <div class="col-md-8">
              <!--<div class="form-check">-->
              <input type="radio" class="form-check-input" id="customControlValidation2" name="previo" required>
              <label class="form-check-label mb-0" for="customControlValidation1">WHATSAPP</label>
            </div>
          </p>
          <p class="card-text">
            <div class="col-md-8">
              <!--<div class="form-check">-->
              <input type="radio" class="form-check-input" id="customControlValidation2" name="previo" required>
              <label class="form-check-label mb-0" for="customControlValidation1">CORREO ELECTRÓNICO</label>
            </div>  
          </p>  
        </div>
      </div>
      <div class="card">
        <div class="card-body wizard-content">
          <h5 class="card-title">Ingresa el ticket generado para esta atención*</h5>
          <p class="card-text">
            <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Example" required autofocus>
            @error('descripcion')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                  </span>
            @enderror
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body wizard-content">
          <h5 class="card-title">En caso de que la llamada solo haya sido para seguimiento a ticket colócalo aquí</h5>
          <h6 class="card-subtitle mb-2 text-muted">Solo aplica para usuarios MARS</h6>
          <p class="card-text">
            <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Example" required autofocus>
            @error('descripcion')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                  </span>
            @enderror
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body wizard-content">
          <h5 class="card-title">Comentarios de la atención*</h5>
          <div class="row media">
            <div class="col-md-6">
              <h6 class="card-subtitle mb-2 text-muted">A que numero se contactara para seguimiento de folio*</h6>
              <p class="card-text">
                <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="(55)-5555-5555" required autofocus>
                @error('descripcion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </p>
            </div>
            <div class="col-md-6">
              <h6 class="card-subtitle mb-2 text-muted">En caso de contar con un número alternativo ingresalo aquí</h6>
              <div class="mb-3 text-center">
                <p class="card-text">
                  <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="(55)-5555-5555" required autofocus>
                  @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                        </span>
                  @enderror
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>



<h5>*Campos obligatorios</h5>
<script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
<script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>


@endsection 

