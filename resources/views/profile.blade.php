@extends('home')
@section('content')
    <div class="container-fluid">
      <!-- Start Row -->
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body little-profile text-center">
              @foreach ($data as $dato)
                <div class="my-3">
                  @if ($dato->avatar == NULL)
                    <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" width="128" class="rounded-circle shadow"/>    
                  @else
                    <img src="{{asset($dato->avatar)}}" alt="user" width="128" class="rounded-circle shadow"/>   
                  @endif
                </div>
                <h3 class="mb-0">{{$dato->nombre}} {{$dato->apaterno}}</h3>
                <h6 class="text-muted">{{$dato->puesto}}</h6>
                <ul class="list-inline social-icons mt-4">
                  <li class="list-inline-item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add-new-event">
                      <i class="ri-edit-2-fill"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="{{route('Ajustes')}}">
                      <i class="ri-user-settings-line"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="{{route('Seguir')}}">
                      <i class="ri-settings-5-line"></i>
                    </a>
                  </li>
                  <!--<li class="list-inline-item">
                    <a href="javascript:void(0)">
                      <i class="ri-google-fill"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="javascript:void(0)">
                      <i class="ri-youtube-fill"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="javascript:void(0)">
                      <i class="ri-instagram-line"></i>
                    </a>
                  </li>-->
                </ul>
              @endforeach
                <!-- BEGIN MODAL -->
                <div class="modal" id="add-new-event">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header d-flex align-items-center">
                            <h4 class="modal-title"><strong>Cambiar Imagen de Perfil</strong></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form class="dropzone" action="{{route('Actualiza')}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone">
                            {{csrf_field()}}
                            <div class="fallback">
                              <input type="file" name="avatar" id="avatar" accept="image/*">
                            </div>
                          </form>
                            <button type="submit" class="btn btn-success waves-effect waves-light text-white">
                              <a href="{{route('profile',Auth::user()->id)}}" style="color:white"> Guardar</a>
                            </button>
                            <button type="button" class="btn waves-effect" data-bs-dismiss="modal"> Cancelar</button>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- End Modal -->
            </div>
            <!--<div class="text-center bg-extra-light">
              <div class="row">
                <div class="col-6 p-3 border-right">
                  <h4 class="mb-0 font-weight-medium">1099</h4>
                  <small>Followers</small>
                </div>
                <div class="col-6 p-3">
                  <h4 class="mb-0 font-weight-medium">603</h4>
                  <small>Following</small>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              <a
                href="javascript:void(0)"
                class="
                  mt-2
                  mb-3
                  waves-effect waves-dark
                  btn btn-success btn-md btn-rounded
                "
                >Follow me</a
              >
            </div>-->
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="d-md-flex">
                <div>
                  <h4 class="card-title">
                    <span class="lstick d-inline-block align-middle"></span
                    >Proyectos del Bimestre
                  </h4>
                </div>
                <div class="ms-auto">
                  <select class="form-select">
                    <option selected="">Enero/Febrero</option>
                    <option value="1">Marzo/Abril</option>
                    <option value="2">Mayo/Junio</option>
                    <option value="3">Julio/Agosto</option>
                  </select>
                </div>
              </div>
              <div class="table-responsive mt-3">
                <table class="table v-middle no-wrap mb-0">
                  <thead>
                    <tr>
                      <th class="border-0" colspan="2">Ejecutivo</th>
                      <th class="border-0">Nombre</th>
                      <th class="border-0">Prioridad</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="width: 50px">
                        <span
                          ><img
                            src="../../assets/images/users/1.jpg"
                            alt="user"
                            width="50"
                            class="rounded-circle"
                        /></span>
                      </td>
                      <td>
                        <h6 class="mb-0 font-weight-medium">Sunil Joshi</h6>
                        <small class="text-muted">EJECUTIVO TI</small>
                      </td>
                      <td>EJEMPLO 1</td>
                      <td>
                        <span class="badge bg-success rounded-pill"
                          >Baja</span
                        >
                      </td>
                    </tr>
                    <tr class="active">
                      <td>
                        <span
                          ><img
                            src="../../assets/images/users/2.jpg"
                            alt="user"
                            width="50"
                            class="rounded-circle"
                        /></span>
                      </td>
                      <td>
                        <h6 class="mb-0 font-weight-medium">Andrew</h6>
                        <small class="text-muted">AUXILIAR TI</small>
                      </td>
                      <td>EJEMPLO 2</td>
                      <td>
                        <span class="badge bg-info rounded-pill"
                          >Media</span
                        >
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span
                          ><img
                            src="../../assets/images/users/3.jpg"
                            alt="user"
                            width="50"
                            class="rounded-circle"
                        /></span>
                      </td>
                      <td>
                        <h6 class="mb-0 font-weight-medium">
                          Bhavesh patel
                        </h6>
                        <small class="text-muted">DESARROLLO</small>
                      </td>
                      <td>EJEMPLO 3</td>
                      <td>
                        <span class="badge bg-primary rounded-pill"
                          >Alta</span
                        >
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span
                          ><img
                            src="../../assets/images/users/4.jpg"
                            alt="user"
                            width="50"
                            class="rounded-circle"
                        /></span>
                      </td>
                      <td>
                        <h6 class="mb-0 font-weight-medium">Nirav Joshi</h6>
                        <small class="text-muted">ANALISTA</small>
                      </td>
                      <td>EJEMPLO 5</td>
                      <td>
                        <span class="badge bg-danger rounded-pill"
                          >Critico</span
                        >
                      </td>
                    </tr>
                    <!--<tr>
                      <td>
                        <span
                          ><img
                            src="../../assets/images/users/5.jpg"
                            alt="user"
                            width="50"
                            class="rounded-circle"
                        /></span>
                      </td>
                      <td>
                        <h6 class="mb-0 font-weight-medium">Micheal Doe</h6>
                        <small class="text-muted">Content Writer</small>
                      </td>
                      <td>Helping Hands</td>
                      <td>
                        <span class="badge bg-success rounded-pill"
                          >High</span
                        >
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span
                          ><img
                            src="../../assets/images/users/6.jpg"
                            alt="user"
                            width="50"
                            class="rounded-circle"
                        /></span>
                      </td>
                      <td>
                        <h6 class="mb-0 font-weight-medium">Johnathan</h6>
                        <small class="text-muted">Graphic</small>
                      </td>
                      <td>Digital Agency</td>
                      <td>
                        <span class="badge bg-info rounded-pill">High</span>
                      </td>
                    </tr>-->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- Activity widget find scss into widget folder-->
        <!-- -------------------------------------------------------------- -->
      </div>
      <!-- End Row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="border-bottom title-part-padding">
              <h4 class="card-title mb-0">Excel</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="fechas" class="table table-striped table-bordered display text-nowrap" style="width: 100%">
                  <thead>
                    <tr>
                      <th class="header">FOLIO</th>
                      <th class="header">REQUERIMIENTO</th>
                      <th class="header">LEVANTAMIENTO</th>
                      <th class="header">CONSTRUCCIÓN</th>
                      <th class="header">LIBERACIÓN</th>
                      <th class="header">IMPLEMENTACIÓN</th>
                      <th class="header">TOTAL</th>
                      <th class="header">SOLICITANTE</th>
                      <th class="header">CLIENTE</th>
                      <th class="header">SISTEMA</th>
                      <th class="header">ESTATUS</th>
                      <th class="header">RESPONSABLE</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($fechas as $fecha)
                      <tr>
                        <td>{{$fecha->folio}}</td>
                        <td>{{$fecha->req}}</td>
                        <td>{{$fecha->levantamiento}}</td>
                        <td>{{$fecha->construccion}}</td>
                        <td>{{$fecha->liberacion}}</td>
                        <td>{{$fecha->implementacion}}</td>
                        <td>{{$fecha->total}}</td>
                        <td>{{$fecha->solicitante}}</td>
                        <td>{{$fecha->cliente}}</td>
                        <td>{{$fecha->sistema}}</td>
                        <td>{{$fecha->estatus}}</td>
                        <td>{{$fecha->responsable}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <th>FOLIO</th>
                    <th>REQUERIMIENTO</th>
                    <th>LEVANTAMIENTO</th>
                    <th>CONSTRUCCIÓN</th>
                    <th>LIBERACIÓN</th>
                    <th>IMPLEMENTACIÓN</th>
                    <th>TOTAL</th>
                    <th>SOLICITANTE</th>
                    <th>CLIENTE</th>
                    <th>SISTEMA</th>
                    <th>ESTATUS</th>
                    <th>RESPONSABLE</th>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Start row -->
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <h4 class="card-title">
                  <span class="lstick d-inline-block align-middle"></span>To
                  Do list
                </h4>
                <div class="ms-auto">
                  <button
                    class="btn btn-circle btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#myModal"
                  >
                    <i data-feather="plus" class="feather-sm"></i>
                  </button>
                </div>
              </div>

              <!-- -------------------------------------------------------------- -->
              <!-- To do list widgets -->
              <!-- -------------------------------------------------------------- -->
              <div
                class="to-do-widget mt-3 common-widget scrollable"
                style="height: 410px"
              >
                <!-- .modal for add task -->
                <div
                  class="modal fade"
                  id="myModal"
                  tabindex="-1"
                  role="dialog"
                  aria-hidden="true"
                >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header d-flex">
                        <h4 class="modal-title">Add Task</h4>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="mb-3">
                            <label>Task name</label>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Enter Task Name"
                            />
                          </div>
                          <div class="mb-3">
                            <label>Assign to</label>
                            <select class="form-select form-control">
                              <option selected="">Sachin</option>
                              <option value="1">Sehwag</option>
                            </select>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-dismiss="modal"
                        >
                          Close
                        </button>
                        <button
                          type="button"
                          class="btn btn-success"
                          data-bs-dismiss="modal"
                        >
                          Submit
                        </button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <ul
                  class="list-task todo-list list-group mb-0"
                  data-role="tasklist"
                >
                  <li
                    class="list-group-item border-0 mb-0 py-3 pe-3 ps-0"
                    data-role="task"
                  >
                    <div class="form-check form-check-inline w-100">
                      <input
                        type="checkbox"
                        class="form-check-input danger check-light-danger"
                        id="inputSchedule"
                        name="inputCheckboxesSchedule"
                      />
                      <label
                        for="inputSchedule"
                        class="form-check-label font-weight-medium"
                      >
                        <span>Schedule meeting with</span
                        ><span class="badge bg-danger badge-pill ms-1"
                          >Today</span
                        >
                      </label>
                    </div>
                    <ul
                      class="assignedto list-style-none m-0 ps-4 ms-1 mt-1"
                    >
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/1.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Steave"
                          class="rounded-circle"
                        />
                      </li>
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/2.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Jessica"
                          class="rounded-circle"
                        />
                      </li>
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/3.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Priyanka"
                          class="rounded-circle"
                        />
                      </li>
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/4.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Selina"
                          class="rounded-circle"
                        />
                      </li>
                    </ul>
                  </li>
                  <li
                    class="list-group-item border-0 mb-0 py-3 pe-3 ps-0"
                    data-role="task"
                  >
                    <div class="form-check form-check-inline w-100">
                      <input
                        type="checkbox"
                        id="inputCall"
                        class="form-check-input info check-light-info"
                        name="inputCheckboxesCall"
                      />
                      <label
                        for="inputCall"
                        class="form-check-label font-weight-medium"
                      >
                        <span>Give Purchase report to</span>
                        <span class="badge bg-info badge-pill ms-1"
                          >Yesterday</span
                        >
                      </label>
                    </div>
                    <ul class="assignedto m-0 ps-4 ms-1 mt-1">
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/3.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Priyanka"
                          class="rounded-circle"
                        />
                      </li>
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/4.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Selina"
                          class="rounded-circle"
                        />
                      </li>
                    </ul>
                  </li>
                  <li
                    class="list-group-item border-0 mb-0 py-3 pe-3 ps-0"
                    data-role="task"
                  >
                    <div class="form-check form-check-inline w-100">
                      <input
                        type="checkbox"
                        id="inputBook"
                        class="form-check-input primary check-light-primary"
                        name="inputCheckboxesBook"
                      />
                      <label
                        for="inputBook"
                        class="form-check-label font-weight-medium"
                      >
                        <span>Book flight for holiday</span
                        ><span class="badge bg-primary badge-pill ms-1"
                          >1 week</span
                        >
                      </label>
                    </div>
                    <div class="fs-2 ps-3 d-inline-block ms-2">
                      26 jun 2021
                    </div>
                  </li>
                  <li
                    class="list-group-item border-0 mb-0 py-3 pe-3 ps-0"
                    data-role="task"
                  >
                    <div class="form-check form-check-inline w-100">
                      <input
                        type="checkbox"
                        id="inputForward"
                        class="form-check-input warning check-light-warning"
                        name="inputCheckboxesForward"
                      />
                      <label
                        for="inputForward"
                        class="form-check-label font-weight-medium"
                      >
                        <span>Forward all tasks</span>
                        <span class="badge bg-warning badge-pill ms-1"
                          >2 weeks</span
                        >
                      </label>
                    </div>
                    <div class="fs-2 ps-3 d-inline-block ms-2">
                      26 jun 2021
                    </div>
                  </li>
                  <li
                    class="list-group-item border-0 mb-0 py-3 pe-3 ps-0"
                    data-role="task"
                  >
                    <div class="form-check form-check-inline w-100">
                      <input
                        type="checkbox"
                        id="inputRecieve"
                        class="form-check-input success check-light-success"
                        name="inputCheckboxesRecieve"
                      />
                      <label
                        for="inputRecieve"
                        class="form-check-label font-weight-medium"
                      >
                        <span>Recieve shipment</span
                        ><span class="badge bg-success badge-pill ms-1"
                          >2 weeks</span
                        >
                      </label>
                    </div>
                    <ul
                      class="assignedto list-style-none m-0 ps-4 ms-1 mt-1"
                    >
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/1.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Steave"
                          class="rounded-circle"
                        />
                      </li>
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/2.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Jessica"
                          class="rounded-circle"
                        />
                      </li>
                      <li class="d-inline-block border-0 me-1">
                        <img
                          src="../../assets/images/users/3.jpg"
                          alt="user"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title=""
                          data-original-title="Priyanka"
                          class="rounded-circle"
                        />
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <h4 class="card-title">
                  <span class="lstick d-inline-block align-middle"></span
                  >Activity
                </h4>
                <div class="dropdown ms-auto">
                  <a
                    href="#"
                    class="icon-options-vertical link"
                    id="dropdownMenuLink"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  ></a>
                  <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuLink"
                  >
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li>
                      <a class="dropdown-item" href="#">Another action</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#"
                        >Something else here</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div
              class="activity-box table-responsive scrollable"
              style="height: 514px"
            >
              <div class="card-body">
                <!-- Activity item-->
                <div class="activity-item mb-4 d-flex">
                  <div class="me-3">
                    <img
                      src="../../assets/images/users/2.jpg"
                      alt="user"
                      width="50"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="mt-2">
                    <h5 class="mb-0 font-weight-medium">
                      Mark Freeman
                      <span class="text-muted fs-3 ms-2"
                        >| &nbsp; 6:30 PM</span
                      >
                    </h5>
                    <h6 class="text-muted">uploaded this file</h6>
                    <div class="row">
                      <div class="col-4">
                        
                      </div>
                      <div class="col-8 d-flex align-items-center">
                        <div>
                          <h5 class="mb-0 font-weight-medium">
                            Homepage.zip
                          </h5>
                          <h6>54 MB</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Activity item-->
                <!-- Activity item-->
                <div class="activity-item mb-4 d-flex">
                  <div class="me-3">
                    <img
                      src="../../assets/images/users/3.jpg"
                      alt="user"
                      width="50"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="mt-2">
                    <h5 class="mb-1 font-weight-medium">
                      Emma Smith
                      <span class="text-muted fs-3 ms-2"
                        >| &nbsp; 6:30 PM</span
                      >
                    </h5>
                    <h6 class="text-muted">
                      joined projectname, and invited
                      <a href="javascript:void(0)"
                        >@maxcage, @maxcage, @maxcage,<br />
                        @maxcage, @maxcage,+3</a
                      >
                    </h6>
                    <span class="image-list mt-2">
                      <a
                        href="javascript:void(0)"
                        class="align-middle position-relative"
                      >
                        <img
                          src="../../assets/images/users/1.jpg"
                          class="rounded-circle"
                          alt="user"
                          width="40"
                        />
                      </a>
                      <a
                        href="javascript:void(0)"
                        class="align-middle position-relative"
                      >
                        <img
                          src="../../assets/images/users/4.jpg"
                          class="rounded-circle"
                          alt="user"
                          width="40"
                        />
                      </a>
                      <a
                        href="javascript:void(0)"
                        class="align-middle position-relative"
                      >
                        <span
                          class="
                            round
                            rounded-circle
                            text-white
                            d-inline-block
                            text-center
                            bg-warning
                          "
                          style="height: 40px; width: 40px"
                          >C</span
                        >
                      </a>
                      <a
                        href="javascript:void(0)"
                        class="align-middle position-relative"
                      >
                        <span
                          class="
                            round
                            rounded-circle
                            text-white
                            d-inline-block
                            text-center
                            bg-danger
                          "
                          style="height: 40px; width: 40px"
                          >S</span
                        >
                      </a>
                      <a
                        href="javascript:void(0)"
                        class="align-middle position-relative"
                        >+3</a
                      >
                    </span>
                  </div>
                </div>
                <!-- Activity item-->
                <!-- Activity item-->
                <div class="activity-item mb-4 d-flex">
                  <div class="me-3">
                    <img
                      src="../../assets/images/users/4.jpg"
                      alt="user"
                      width="50"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="mt-2">
                    <h5 class="mb-0 font-weight-medium">
                      David R. Jones
                      <span class="text-muted fs-3 ms-2"
                        >| &nbsp; 6:30 PM</span
                      >
                    </h5>
                    <h6 class="text-muted">uploaded this file</h6>
                    <span>
                      <a href="javascript:void(0)" class="me-2"
                        ><img
                          src="../../assets/images/big/img1.jpg"
                          alt="user"
                          width="60"
                      /></a>
                      <a href="javascript:void(0)" class="me-2"
                        ><img
                          src="../../assets/images/big/img2.jpg"
                          alt="user"
                          width="60"
                      /></a>
                    </span>
                  </div>
                </div>
                <!-- Activity item-->
                <!-- Activity item-->
                <div class="activity-item d-flex mb-2">
                  <div class="me-3">
                    <img
                      src="../../assets/images/users/6.jpg"
                      alt="user"
                      width="50"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="mt-2">
                    <h5 class="mb-1 font-weight-medium">
                      David R. Jones
                      <span class="text-muted fs-3 ms-2"
                        >| &nbsp; 6:30 PM</span
                      >
                    </h5>
                    <h6 class="text-muted">
                      Commented on<a href="javascript:void(0)"
                        >Test Project</a
                      >
                    </h6>
                    <p class="mb-0">
                      It has survived not only five centuries, but also the
                      leap into
                    </p>
                  </div>
                </div>
                <!-- Activity item-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End row -->
      <!-- Start row -->
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex">
                <h4 class="card-title">
                  <span class="lstick d-inline-block align-middle"></span>My
                  Contact
                </h4>
                <div class="dropdown ms-auto">
                  <a
                    href="#"
                    class="icon-options-vertical link"
                    id="dropdownMenuLink"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  ></a>
                  <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuLink"
                  >
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li>
                      <a class="dropdown-item" href="#">Another action</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#"
                        >Something else here</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <div class="mailbox">
                <div
                  class="
                    message-center
                    contact-widget
                    message-body
                    position-relative
                  "
                  style="height: 450px"
                >
                  <a
                    href="javascript:void(0)"
                    class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      p-3
                    "
                  >
                    <span class="user-img position-relative d-inline-block">
                      <img
                        src="../../assets/images/users/1.jpg"
                        alt="user"
                        class="rounded-circle w-100"
                      />
                      <span
                        class="profile-status rounded-circle online"
                      ></span>
                    </span>
                    <div class="w-75 d-inline-block v-middle ps-3">
                      <h5
                        class="message-title mb-0 mt-1 font-weight-medium"
                      >
                        Pavan kumar
                      </h5>
                      <span
                        class="
                          fs-2
                          text-nowrap
                          d-block
                          time
                          text-truncate text-bodycolor
                        "
                        >info@wrappixel.com</span
                      >
                    </div>
                  </a>
                  <!-- Message -->
                  <a
                    href="javascript:void(0)"
                    class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      p-3
                    "
                  >
                    <span class="user-img position-relative d-inline-block">
                      <img
                        src="../../assets/images/users/2.jpg"
                        alt="user"
                        class="rounded-circle w-100"
                      />
                      <span
                        class="profile-status rounded-circle busy"
                      ></span>
                    </span>
                    <div class="w-75 d-inline-block v-middle ps-3">
                      <h5
                        class="message-title mb-0 mt-1 font-weight-medium"
                      >
                        Sonu Nigam
                      </h5>
                      <span
                        class="
                          fs-2
                          text-nowrap
                          d-block
                          time
                          text-truncate text-bodycolor
                        "
                        >pamela1987@gmail.com</span
                      >
                    </div>
                  </a>
                  <!-- Message -->
                  <a
                    href="javascript:void(0)"
                    class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      p-3
                    "
                  >
                    <span class="user-img position-relative d-inline-block">
                      <img
                        src="../../assets/images/users/3.jpg"
                        alt="user"
                        class="rounded-circle w-100"
                      />
                      <span
                        class="profile-status rounded-circle away"
                      ></span>
                    </span>
                    <div class="w-75 d-inline-block v-middle ps-3">
                      <h5
                        class="message-title mb-0 mt-1 font-weight-medium"
                      >
                        Arijit Sinh
                      </h5>
                      <span
                        class="
                          fs-2
                          text-nowrap
                          d-block
                          time
                          text-truncate text-bodycolor
                        "
                        >cruise1298.fiplip@gmail.com</span
                      >
                    </div>
                  </a>
                  <!-- Message -->
                  <a
                    href="javascript:void(0)"
                    class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      p-3
                    "
                  >
                    <span class="user-img position-relative d-inline-block">
                      <img
                        src="../../assets/images/users/4.jpg"
                        alt="user"
                        class="rounded-circle w-100"
                      />
                      <span
                        class="profile-status rounded-circle offline"
                      ></span>
                    </span>
                    <div class="w-75 d-inline-block v-middle ps-3">
                      <h5
                        class="message-title mb-0 mt-1 font-weight-medium"
                      >
                        Pavan kumar
                      </h5>
                      <span
                        class="
                          fs-2
                          text-nowrap
                          d-block
                          time
                          text-truncate text-bodycolor
                        "
                        >kat@gmail.com</span
                      >
                    </div>
                  </a>
                  <!-- Message -->
                  <a
                    href="javascript:void(0)"
                    class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      p-3
                    "
                  >
                    <span class="user-img position-relative d-inline-block">
                      <img
                        src="../../assets/images/users/2.jpg"
                        alt="user"
                        class="rounded-circle w-100"
                      />
                      <span
                        class="profile-status rounded-circle busy"
                      ></span>
                    </span>
                    <div class="w-75 d-inline-block v-middle ps-3">
                      <h5
                        class="message-title mb-0 mt-1 font-weight-medium"
                      >
                        Sonu Nigam
                      </h5>
                      <span
                        class="
                          fs-2
                          text-nowrap
                          d-block
                          time
                          text-truncate text-bodycolor
                        "
                        >pamela1987@gmail.com</span
                      >
                    </div>
                  </a>
                  <!-- Message -->
                  <a
                    href="javascript:void(0)"
                    class="message-item d-flex align-items-center p-3"
                  >
                    <span class="user-img position-relative d-inline-block">
                      <img
                        src="../../assets/images/users/1.jpg"
                        alt="user"
                        class="rounded-circle w-100"
                      />
                      <span
                        class="profile-status rounded-circle online"
                      ></span>
                    </span>
                    <div class="w-75 d-inline-block v-middle ps-3">
                      <h5
                        class="message-title mb-0 mt-1 font-weight-medium"
                      >
                        Pavan kumar
                      </h5>
                      <span
                        class="
                          fs-2
                          text-nowrap
                          d-block
                          time
                          text-truncate text-bodycolor
                        "
                        >info@wrappixel.com</span
                      >
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Feeds</h4>
            </div>
            <ul class="feeds ps-0">
              <div class="feed-item mb-2 py-2 ps-4 pe-3">
                <div
                  class="
                    border-start border-2 border-info
                    d-md-flex
                    align-items-center
                  "
                >
                  <div class="d-flex align-items-center">
                    <a
                      href="javascript:void(0)"
                      class="
                        ms-3
                        btn btn-light-info
                        text-info
                        btn-circle
                        fs-5
                        d-flex
                        align-items-center
                        justify-content-center
                        flex-shrink-0
                      "
                      ><i data-feather="bell" class="feather-sm"></i
                    ></a>
                    <div class="ms-3 text-truncate">
                      <span class="text-dark font-weight-medium"
                        >You have 4 pending tasks.</span
                      >
                    </div>
                  </div>
                  <div
                    class="
                      justify-content-end
                      text-truncate
                      ms-5 ms-md-auto
                      ps-4 ps-md-0
                    "
                  >
                    <span class="fs-2 text-muted">Just Now</span>
                  </div>
                </div>
              </div>
              <div class="feed-item mb-2 py-2 ps-4 pe-3">
                <div
                  class="
                    border-start border-2 border-success
                    d-md-flex
                    align-items-center
                  "
                >
                  <div class="d-flex align-items-center">
                    <a
                      href="javascript:void(0)"
                      class="
                        ms-3
                        btn btn-light-success
                        text-success
                        btn-circle
                        fs-5
                        d-flex
                        align-items-center
                        justify-content-center
                        flex-shrink-0
                      "
                      ><i data-feather="database" class="feather-sm"></i
                    ></a>
                    <div class="ms-3 text-truncate">
                      <span class="text-dark font-weight-medium"
                        >Server #1 overloaded</span
                      >
                    </div>
                  </div>
                  <div
                    class="
                      justify-content-end
                      text-truncate
                      ms-5 ms-md-auto
                      ps-4 ps-md-0
                    "
                  >
                    <span class="fs-2 text-muted">2 Hours ago</span>
                  </div>
                </div>
              </div>
              <div class="feed-item mb-2 py-2 ps-4 pe-3">
                <div
                  class="
                    border-start border-2 border-warning
                    d-md-flex
                    align-items-center
                  "
                >
                  <div class="d-flex align-items-center">
                    <a
                      href="javascript:void(0)"
                      class="
                        ms-3
                        btn btn-light-warning
                        text-warning
                        btn-circle
                        fs-5
                        d-flex
                        align-items-center
                        justify-content-center
                        flex-shrink-0
                      "
                      ><i
                        data-feather="shopping-cart"
                        class="feather-sm"
                      ></i
                    ></a>
                    <div class="ms-3 text-truncate">
                      <span class="text-dark font-weight-medium"
                        >New order received.</span
                      >
                    </div>
                  </div>
                  <div
                    class="
                      justify-content-end
                      text-truncate
                      ms-5 ms-md-auto
                      ps-4 ps-md-0
                    "
                  >
                    <span class="fs-2 text-muted">31 May</span>
                  </div>
                </div>
              </div>
              <div class="feed-item mb-2 py-2 ps-4 pe-3">
                <div
                  class="
                    border-start border-2 border-danger
                    d-md-flex
                    align-items-center
                  "
                >
                  <div class="d-flex align-items-center">
                    <a
                      href="javascript:void(0)"
                      class="
                        ms-3
                        btn btn-light-danger
                        text-danger
                        btn-circle
                        fs-5
                        d-flex
                        align-items-center
                        justify-content-center
                        flex-shrink-0
                      "
                      ><i data-feather="users" class="feather-sm"></i
                    ></a>
                    <div class="ms-3 text-truncate">
                      <span class="text-dark font-weight-medium"
                        >New user registered.</span
                      >
                    </div>
                  </div>
                  <div
                    class="
                      justify-content-end
                      text-truncate
                      ms-5 ms-md-auto
                      ps-4 ps-md-0
                    "
                  >
                    <span class="fs-2 text-muted">30 May</span>
                  </div>
                </div>
              </div>
              <div class="feed-item mb-2 py-2 ps-4 pe-3">
                <div
                  class="
                    border-start border-2 border-primary
                    d-md-flex
                    align-items-center
                  "
                >
                  <div class="d-flex align-items-center">
                    <a
                      href="javascript:void(0)"
                      class="
                        ms-3
                        btn btn-light-primary
                        text-primary
                        btn-circle
                        fs-5
                        d-flex
                        align-items-center
                        justify-content-center
                        flex-shrink-0
                      "
                    >
                      <i data-feather="users" class="feather-sm"></i>
                    </a>
                    <div class="ms-3 text-truncate">
                      <span class="text-dark font-weight-medium"
                        >New Version just arrived.</span
                      >
                    </div>
                  </div>
                  <div
                    class="
                      justify-content-end
                      text-truncate
                      ms-5 ms-md-auto
                      ps-4 ps-md-0
                    "
                  >
                    <span class="fs-2 text-muted">27 May</span>
                  </div>
                </div>
              </div>
              <div class="feed-item mb-2 py-2 ps-4 pe-3">
                <div
                  class="
                    border-start border-2 border-info
                    d-md-flex
                    align-items-center
                  "
                >
                  <div class="d-flex align-items-center">
                    <a
                      href="javascript:void(0)"
                      class="
                        ms-3
                        btn btn-light-info
                        text-info
                        btn-circle
                        fs-5
                        d-flex
                        align-items-center
                        justify-content-center
                        flex-shrink-0
                      "
                    >
                      <i data-feather="bell" class="feather-sm"></i>
                    </a>
                    <div class="ms-3 text-truncate">
                      <span class="text-dark font-weight-medium"
                        >You have 4 pending tasks.</span
                      >
                    </div>
                  </div>
                  <div
                    class="
                      justify-content-end
                      text-truncate
                      ms-5 ms-md-auto
                      ps-4 ps-md-0
                    "
                  >
                    <span class="fs-2 text-muted">30 May</span>
                  </div>
                </div>
              </div>
              <div class="feed-item mb-2 py-2 ps-4 pe-3">
                <div
                  class="
                    border-start border-2 border-primary
                    d-md-flex
                    align-items-center
                  "
                >
                  <div class="d-flex align-items-center">
                    <a
                      href="javascript:void(0)"
                      class="
                        ms-3
                        btn btn-light-primary
                        text-primary
                        btn-circle
                        fs-5
                        d-flex
                        align-items-center
                        justify-content-center
                        flex-shrink-0
                      "
                    >
                      <i data-feather="users" class="feather-sm"></i>
                    </a>
                    <div class="ms-3 text-truncate">
                      <span class="text-dark font-weight-medium"
                        >New Version just arrived.</span
                      >
                    </div>
                  </div>
                  <div
                    class="
                      justify-content-end
                      text-truncate
                      ms-5 ms-md-auto
                      ps-4 ps-md-0
                    "
                  >
                    <span class="fs-2 text-muted">27 May</span>
                  </div>
                </div>
              </div>
            </ul>
          </div>
        </div>
      </div>
      <!-- End row -->
      <!-- Start row -->
      <div class="row">
        <div class="col-lg-4">
          <div class="card bg-info text-white">
            <div class="card-body">
              <div class="d-flex">
                <div class="stats">
                  <h1 class="text-white">3257+</h1>
                  <h6 class="text-white">Twitter Followers</h6>
                  <button
                    class="btn btn-rounded btn-outline btn-light mt-2 fs-3"
                  >
                    Check list
                  </button>
                </div>
                <div class="stats-icon text-end ms-auto">
                  <i class="ri-twitter-fill display-5 op-3 text-dark"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <div class="d-flex">
                <div class="stats">
                  <h1 class="text-white">6509+</h1>
                  <h6 class="text-white">Facebook Likes</h6>
                  <button
                    class="btn btn-rounded btn-outline btn-light mt-2 fs-3"
                  >
                    Check list
                  </button>
                </div>
                <div class="stats-icon text-end ms-auto">
                  <i class="ri-facebook-fill display-5 op-3 text-dark"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card bg-success text-white">
            <div class="card-body">
              <div class="d-flex">
                <div class="stats">
                  <h1 class="text-white">9062+</h1>
                  <h6 class="text-white">Subscribe</h6>
                  <button
                    class="btn btn-rounded btn-outline btn-light mt-2 fs-3"
                  >
                    Check list
                  </button>
                </div>
                <div class="stats-icon text-end ms-auto">
                  <i class="ri-mail-line display-5 op-3 text-dark"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Row -->
    </div>
    
    <link rel="stylesheet" type="text/css" href="../../assets/libs/dropzone/dist/min/dropzone.min.css"/>
    <script src="../../assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <!-- -------------------------------------------------------------- -->
    <!-- End Container fluid  -->
    <!-- -------------------------------------------------------------- -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      Dropzone.options.myAwesomeDropzone = {
        paramName: "avatar", // Las imágenes se van a usar bajo este nombre de parámetro
        maxFilesize: 3 // Tamaño máximo en MB
      };
    </script>
    <script>
      $(document).ready(function () {
        $('#fechas').DataTable({
          dom: "Bfrtip",
          buttons: ["copy", "csv", "excel", "pdf", "print"],
            scrollY: 200,
            scrollX: true,
        });
      $(
        ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
      ).addClass("btn btn-primary mr-1");
      });
    </script>
@endsection
