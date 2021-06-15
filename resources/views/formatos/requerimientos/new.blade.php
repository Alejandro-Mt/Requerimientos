@extends('home')
@section('content')

<body>
    <div class="card">
        <div class="card-body wizard-content">
            <h4 class="card-title">Nuevo</h4>
            <h6 class="card-subtitle"></h6>
            <form id="example-form" action="#" class="mt-5">
                <div>
                    <h3>Requerimiento</h3>
                    <section>
                        <p>(*) Campos Obligatorios</p>
                        <div class="form-group row">
                            <label for="ID"
                                class="col-sm-2 text-end control-label col-form-label">ID</label>
                            <div class="col-md-3">
                                <input type="text" class="required form-control" id="ID" 
                                    placeholder="Default" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="clave"
                                    class="col-sm-2 text-end control-label col-form-label">Clave</label>
                            <div class="col-sm-3">
                                <input type="text" class="required form-control" id="clave" 
                                    placeholder="Defailt" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descripcion"
                                class="col-sm-2 text-end control-label col-form-label">Descripción*</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control" id="descripcion"
                                    placeholder="descripcion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ejecutivo"
                                class="col-sm-2 text-end control-label col-form-label">Ejecutivo de Cuenta*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="0">Seleccion</option>
                                    <option value="1">AGUSTIN BRAYAN MICHELL MORALES PEREZ</option>
                                    <option value="2">ALEJANDRA GAONA SANTANA</option>
                                    <option value="3">ARACELI MIRANDA HEREDIA</option>
                                    <option value="4">EDUARDO ABIDAN MONROY SAINZ</option>
                                    <option value="5">ELESVAN SANCHEZ VILLAVICENCIO</option>
                                    <option value="6">ERANDI KARINA CAMPOS CONTRERAS</option>
                                    <option value="7">JESSICA CORNEJO MARTINEZ</option>
                                    <option value="8">JOAQUIN AGUILERA MARTINEZ</option>
                                    <option value="9">MARICELA RAMOS BARRERA</option>
                                    <option value="10">SAYRA MIROSLAVA JIMENEZ HERNANDEZ</option>                             
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Sistema"
                                class="col-sm-2 text-end control-label col-form-label">Sistema*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0"><?php echo $sistema -> sistema ?></option>
                                    <option value="1">ANÁLISIS Y MAQUETADO DE PROYECTOS</option>
                                    <option value="2">CONTROL DE ASISTENCIA</option>
                                    <option value="3">CONTROL DE GASTOS</option>
                                    <option value="4">CRM</option>
                                    <option value="5">E-LEARNING</option>
                                    <option value="6">MANIOBRAS</option>
                                    <option value="7">PLATAFORMA DE RECLUTAMIENTO</option>
                                    <option value="8">PORTAL DE CAMPAÑAS</option>
                                    <option value="9">REPARTO</option>
                                    <option value="10">REPORTE GSP BI</option>
                                    <option value="11">RHIN</option>
                                    <option value="12">SMART TEAMS</option>
                                    <option value="13">TEAM</option>
                                    <option value="14">TEAM SUPERVISIÓN</option>
                                    <option value="15">TRACKING</option>
                                    <option value="16">VISOR BI</option>                               
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Cliente"
                                class="col-sm-2 text-end control-label col-form-label">Cliente*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Seleccion</option>
                                    <option value="1">ABBOTT</option>
                                    <option value="2">CONTROL DE ASISTENCIA</option>
                                    <option value="3">CRM</option>
                                    <option value="4">DANONE</option>
                                    <option value="5">DEL MONTE</option>
                                    <option value="6">EGSA</option>
                                    <option value="7">ENERGIZER</option>
                                    <option value="8">FOOD SERVICE</option>
                                    <option value="9">GAP QUALITY INNOVATION</option>
                                    <option value="10">GENERAL</option>
                                    <option value="11">GOOD HEALTH</option>
                                    <option value="12">GRANVITA</option>
                                    <option value="13">GRUMA</option>
                                    <option value="14">HEARTLAND</option>
                                    <option value="15">IDEA MARKET SOLUTIONS</option>
                                    <option value="16">MARS</option>
                                    <option value="17">MARS CHOCOLATES</option>
                                    <option value="18">MARS FOS</option>
                                    <option value="19">MARS PETCARE</option>
                                    <option value="20">MÉDICOS DANONE</option>
                                    <option value="21">MISSION</option>
                                    <option value="22">NUTRIOLI</option>
                                    <option value="23">OIETAKO</option>
                                    <option value="24">PORTAL DE CAMPAÑAS</option>
                                    <option value="25">ECKITT BENCKISER HYNO (RB)</option>
                                    <option value="26">RECLUTAMEINTO</option>
                                    <option value="27">RHIN</option>
                                    <option value="28">SAMSUNG</option>
                                    <option value="29">SOLUGLOB</option>
                                    <option value="30">SOLUGLOB/RHEIN</option>
                                    <option value="31">SPLENDA</option>
                                    <option value="32">STAFF</option>
                                    <option value="33">TALENT GROUP</option>
                                    <option value="34">TALENT REAC</option>
                                    <option value="35">TRIPLE I</option>
                                    <option value="36">TUM</option>
                                    <option value="37">TURIN</option>
                                    <option value="38">UPFIELD</option>
                                    <option value="39">WHIRLPOOL</option>
                                    <option value="40">ZACATE PROMOTION</option>
                                    <option value="41">OTRA CUENTA</option>
                                    <option value="42">SIN ESPECIFICAR</option>                             
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Arquitecto"
                                class="col-sm-2 text-end control-label col-form-label">Arquitecto de Soluciones*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Seleccion</option>
                                    <option value='1'>ADRIAN MEZA</option>
                                    <option value='2'>ALDO MORENO</option>
                                    <option value='3'>ALEJANDRA MOYA</option>
                                    <option value='4'>ANA SILVIA CAMACHO</option>
                                    <option value='5'>ANDRÉS DELGADO</option>
                                    <option value='6'>ARELI CELIS</option>
                                    <option value='7'>AXAYACATL ISRAEL DURAN VELASCO</option>
                                    <option value='8'>BLANCA ALVARO</option>
                                    <option value='9'>CARLOS BÁRCENAS</option>
                                    <option value='10'>CARLOS MONTENEGRO</option>
                                    <option value='11'>CARLOS RAMO</option>
                                    <option value='12'>DANIEL DE LA LUZ</option>
                                    <option value='13'>EDGAR RODRIGUEZ</option>
                                    <option value='14'>EDUARDO CESAR RAMOS</option>
                                    <option value='15'>EMMANUEL MENDOZA</option>
                                    <option value='16'>ERIC RUBIO</option>
                                    <option value='17'>ERICK RICARDO PONCE</option>
                                    <option value='18'>ERNESTO CRUZ</option>
                                    <option value='19'>FERNANDO ERIC RAMIREZ PEREZ</option>
                                    <option value='20'>GILBERTO QUINTANA</option>
                                    <option value='21'>HUGO ELOIR MENDOZA</option>
                                    <option value='22'>JAIME BAUTISTA</option>
                                    <option value='23'>JAIRO DE LA CRUZ</option>
                                    <option value='24'>JESSICA RAMIREZ TAPIA</option>
                                    <option value='25'>JORGE FRANCISCO ANAYA MEZA</option>
                                    <option value='26'>JOSE LUIS MARTINEZ</option>
                                    <option value='27'>JUAN PABLO DIONICIO</option>
                                    <option value='28'>JULIO CESAR ORDAZ MARQUEZ</option>
                                    <option value='29'>LUCIO GARCIA</option>
                                    <option value='30'>LUIS D. CORONA MEZA</option>
                                    <option value='31'>LUIS FELIPE LOPEZ</option>
                                    <option value='32'>MARIA DOLORES CARDENAS</option>
                                    <option value='33'>MARIO ESQUIVEL</option>
                                    <option value='34'>PEDRO FELIPE ZAMBRANO</option>
                                    <option value='35'>PLACIDO HERMOSILLO</option>                               
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Prioridad"
                                class="col-sm-2 text-end control-label col-form-label">Prioridad*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Seleccion</option>
                                    <option value='1'>Baja</option>
                                    <option value='2'>Media</option>
                                    <option value='3'>Alta</option>
                                    <option value='4'>Critica</option>                         
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Fecha"
                            class="col-sm-2 text-end control-label col-form-label">Fecha*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose" placeholder="MM/DD/AAAA">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-success text-white">Guardar</button>
                            <label> </label> 
                            <button type="submit" class="btn btn-danger text-white">Cancelar</button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>

    <form class="form-horizontal" action="" method="post">
    <h5>*Campos obligatorios</h5>

</body>

@endsection 