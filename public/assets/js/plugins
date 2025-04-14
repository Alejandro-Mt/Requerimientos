$(function () {
  "use strict";

  // Default
  $(".repeater-default").repeater();

  // Custom Show / Hide Configurations
  $(".file-repeater, .email-repeater").repeater({
    show: function () {
      $(this).slideDown();
    },
    hide: function (remove) {
      if (confirm("Are you sure you want to remove this item?")) {
        $(this).slideUp(remove);
      }
    },
  });
});




var room = 1;

function education_fields() {
  room++;
  var objTo = document.getElementById("education_fields");
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "mb-3 removeclass" + room);
  var rdiv = "removeclass" + room;
  divtest.innerHTML =
    '<form class="row"><div class="col-sm-3"><div class="form-group"><input type="text" class="form-control" id="Schoolname" name="Schoolname" placeholder="School Name"></div></div><div class="col-sm-2"> <div class="form-group"> <input type="text" class="form-control" id="Age" name="Age" placeholder="Age"> </div></div><div class="col-sm-2"> <div class="form-group"> <input type="text" class="form-control" id="Degree" name="Degree" placeholder="Degree"> </div></div><div class="col-sm-3"> <div class="form-group"> <select class="form-control" id="educationDate" name="educationDate"> <option>Date</option> <option value="2015">2015</option> <option value="2016">2016</option> <option value="2017">2017</option> <option value="2018">2018</option> </select> </div></div><div class="col-sm-2"> <div class="form-group"> <button class="btn btn-danger" type="button" onclick="remove_education_fields(' +
    room +
    ');"> <i class="fa fa-minus"></i> </button> </div></div></form>';

  objTo.appendChild(divtest);
}

function remove_education_fields(rid) {
  $(".removeclass" + rid).remove();
}

function excelToDate(excelDate) {
  // El número de días entre la fecha Excel (1900/01/01) y la fecha JavaScript (1970/01/01)
  var daysDifference = 25569;
  // El número de milisegundos en un día
  var millisecondsPerDay = 24 * 60 * 60 * 1000;
  // Convertir fecha Excel a milisegundos
  var excelMilliseconds = ((excelDate - daysDifference) * millisecondsPerDay);
  // Crear objeto de fecha JavaScript en UTC
  var jsDateUTC = new Date(excelMilliseconds);
  // Ajustar la fecha al huso horario local
  var jsDateLocal = new Date(jsDateUTC.getTime() + jsDateUTC.getTimezoneOffset() * 60 * 1000);
  var dia = ("0" + jsDateLocal.getDate()).slice(-2); // Formato de dos dígitos para el día
  var mes = ("0" + (jsDateLocal.getMonth() + 1)).slice(-2); // Formato de dos dígitos para el mes
  var año = jsDateLocal.getFullYear();
  var hora = ("0" + jsDateLocal.getHours()).slice(-2); // Formato de dos dígitos para la hora
  var minutos = ("0" + jsDateLocal.getMinutes()).slice(-2); // Formato de dos dígitos para los minutos
  // Formatear la fecha en español
  var fechaFormateada = dia + '-' + mes + '-' + año + ' ' + hora + ':' + minutos;
  return fechaFormateada;
}

function support_data(data) {
  var objTo = document.getElementById("support_fields");
  var clientes = data.clientes; // Acceder al array de clientes
  var estatus = data.estatus; // Acceder al array de estatus
  var incidencias = data.incidencias; // Acceder al array de incidencias
  var localidades = data.localidades; // Acceder al array de localidades
  var sistemas = data.sistemas; // Acceder al array de sistemas
  var sos = data.sos; // Acceder al array de SOs
  var tickets = data.tickets;
  var users = data.users; // Acceder al array de users
  tickets.forEach(function(ticket) {
    if(ticket.fecha_soporte){ 
    // Agregar los campos al contenedor correspondiente
    room++;
      var jsDate = excelToDate(ticket.fecha_soporte + ticket.hora);
      var divtest = document.createElement("div");
      divtest.setAttribute("class", "mb-3 removeclass" + room);
      divtest.innerHTML += `
        <div class="row">
          <div class="col-sm-1 text-center">
            <label for="Placeholder">N°</label>
            <div class="row">
              <button class="btn btn-secondary" type="button" style="min-width: 100px;">
                ${room-1}
              </button>
            </div>
          </div>
          <div class="mb-3 col-md-2">
            <label for="time">Fecha y hora</label>
            <div class="input-group">
              <input id="datepicker-autoclose-${room}" type="text" class="form-control mydatepicker" required autofocus name="fecha_soporte[]" value="${jsDate}" autocomplete='off'>
              <div class="input-group-append">
                <span class="input-group-text h-100">
                  <i class="fa fa-calendar"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="mb-3 col-md-2">
            <label for="cliente">Cliente</label>
            <select class="form-control ${ticket.cliente && !clientes.some(cliente => cliente.nombre.toUpperCase() === ticket.cliente.toUpperCase()) ? 'is-invalid' : ''}" required autofocus id="cliente" name="cliente[]" autocomplete='off'>
              ${ticket.cliente && !clientes.some(cliente => cliente.nombre.toUpperCase() === ticket.cliente.toUpperCase()) ? `<option value="" selected>${ticket.cliente}</option>` : ''}
              ${clientes.map(cliente => `<option value="${cliente.id_cliente}" ${ticket.cliente && cliente.nombre.toUpperCase() === ticket.cliente.toUpperCase() ? 'selected' : ''}>${cliente.nombre}</option>`).join('')}
            </select>
          </div>
          <div class="mb-3 col-md-2">
            <label for="localidad">Localidad</label>
            <select class="form-control ${ticket.localidad && !localidades.some(localidad => localidad.nombre.toUpperCase() === ticket.localidad.toUpperCase()) ? 'is-invalid' : ''}" required autofocus id="localidad" name="localidad[]" autocomplete="off">
              ${ticket.localidad && !localidades.some(localidad => localidad.nombre.toUpperCase() === ticket.localidad.toUpperCase()) ? `<option value="" selected>${ticket.localidad}</option>` : ''}
              ${localidades.map(localidad => `<option value="${localidad.id_localidad}" ${ticket.localidad && localidad.nombre.toUpperCase() === ticket.localidad.toUpperCase() ? 'selected' : ''}>${localidad.nombre}</option>`).join('')}
            </select>
          </div>
          <div class="mb-3 col-md-2">
            <label for="sistema">Sistema</label>
            <select class="form-control ${ticket.sistema && !sistemas.some(sistema => sistema.nombre.toUpperCase() === ticket.sistema.toUpperCase()) ? 'is-invalid' : ''}" required autofocus id="sistema" name="sistema[]" autocomplete="off">
              ${ticket.sistema && !sistemas.some(sistema => sistema.nombre.toUpperCase() === ticket.sistema.toUpperCase()) ? `<option value="" selected>${ticket.sistema}</option>` : ''}
              ${sistemas.map(sistema => `<option value="${sistema.id_sistema}" ${ticket.sistema && sistema.nombre.toUpperCase() === ticket.sistema.toUpperCase() ? 'selected' : ''}>${sistema.nombre}</option>`).join('')}
            </select>
          </div>
          <div class="mb-3 col-md-2">
            <label for="Sop">Sistema Operativo</label>
            <select class="form-control ${ticket.s_op && !sos.some(sop => sop.nombre.toUpperCase() === ticket.s_op.toUpperCase()) ? 'is-invalid' : ''}" required autofocus id="sop" name="sop[]" autocomplete="off">
              ${ticket.s_op && !sos.some(sop => sop.nombre.toUpperCase() === ticket.s_op.toUpperCase()) ? `<option value="" selected>${ticket.s_op}</option>` : ''}
              ${sos.map(sop => `<option value="${sop.id_so}" ${ticket.s_op && sop.nombre.toUpperCase() === ticket.s_op.toUpperCase() ? 'selected' : ''}>${sop.nombre}</option>`).join('')}
            </select>
          </div>
          <div class="mb-3 col-md-2">
            <label for="Incidencia">Incidencia</label>
            <select class="form-control ${ticket.incidencia && !incidencias.some(incidencia => incidencia.nombre.toUpperCase() === ticket.incidencia.toUpperCase()) ? 'is-invalid' : ''}" required autofocus id="incidencia" name="incidencia[]" autocomplete="off">
              ${ticket.incidencia && !incidencias.some(incidencia => incidencia.nombre.toUpperCase() === ticket.incidencia.toUpperCase()) ? `<option value="" selected>${ticket.incidencia}</option>` : ''}
              ${incidencias.map(incidencia => `<option value="${incidencia.id_incidencia}" ${ticket.incidencia && incidencia.nombre.toUpperCase() === ticket.incidencia.toUpperCase() ? 'selected' : ''}>${incidencia.nombre}</option>`).join('')}
            </select>
          </div>
          <div class="mb-3 col-md-2">
            <label for="Solicitante">Solicitante</label>
            <select class="form-control select2 ${ticket.solicitante && !users.some(user => user.email.toLowerCase() === ticket.solicitante.toLowerCase()) ? 'is-invalid' : ''}" required autofocus id="email" name="email[]" autocomplete="off">
              ${ticket.solicitante && !users.some(user => user.email.toLowerCase() === ticket.solicitante.toLowerCase()) ? `<option value="" selected>${ticket.solicitante}</option>` : ''}
              ${users.map(user =>`<option value="${user.id_user}" ${ticket.solicitante && user.email.toLowerCase() === ticket.solicitante.toLowerCase() ? 'selected' : ''}>${user.email}</option>`).join('')}
            </select>
          </div>
          <div class="mb-3 col-md-2">
            <label for="Comentario">Comentario</label>
            <input id="Comentario" type="text" class="form-control" value="${ticket.comentario}" name="comentario[]" required autofocus autocomplete='off'>
          </div>
          <div class="mb-3 col-md-2">
            <label for="estatus">Estatus</label>
            <select class="form-control ${ticket.estatus && !estatus.some(estado => estado.nombre.toUpperCase() === ticket.estatus.toUpperCase()) ? 'is-invalid' : ''}" required autofocus id="email" name="estatus[]" autocomplete="off">
              ${ticket.estatus && !estatus.some(estado => estado.nombre.toUpperCase() === ticket.estatus.toUpperCase()) ? `<option value="" selected>${ticket.estatus}</option>` : ''}
              ${estatus.map(estado => `<option value="${estado.id_estatus}" ${ticket.estatus && estado.nombre.toUpperCase() === ticket.estatus.toUpperCase() ? 'selected' : ''}>${estado.nombre}</option>`).join('')}
            </select>
          </div>
          <div class="mb-3 col-md-2">
            <label for="Placeholder">&nbsp;</label>
            <div class="form-group">
              <button class="btn btn-danger" type="button" onclick="remove_support_fields(${room});">
                <i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
        </div>`;
    }
  objTo.appendChild(divtest);
  });

  // Inicializar Select2 para el nuevo campo de solicitante
  $('.select2').select2({
    tags: true,
    tokenSeparators: [',', ' '],
    createTag: function(params) {
      return {
        id: params.term,
        text: params.term,
        newOption: true
      };
    }
  });
}

function support_fields(data) {
  room++;
  var objTo = document.getElementById("support_fields");
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "mb-3 removeclass" + room);
  var rdiv = "removeclass" + room;
  var clientes = data.clientes; // Acceder al array de clientes
  var localidades = data.localidades; // Acceder al array de localidades
  var sistemas = data.sistemas; // Acceder al array de sistemas
  var sos = data.sos; // Acceder al array de SOs
  var incidencias = data.incidencias; // Acceder al array de incidencias
  var users = data.users; // Acceder al array de users
  var estatus = data.estatus; // Acceder al array de users
  
  divtest.innerHTML = `
    <div class="row">
      <div class="col-sm-1 text-center">
        <label for="Placeholder">N°</label>
        <div class="row">
          <button class="btn btn-secondary" type="button" style="min-width: 100px;">
            ${room-1}
          </button>
        </div>
      </div>
      <div class="mb-3 col-md-2">
        <label for="time">Fecha y hora</label>
        <div class="input-group">
          <input id="datepicker-autoclose-${room}" type="text" class="form-control mydatepicker" required autofocus name="fecha_soporte[]" placeholder="DD/MM/AAAA" value="" autocomplete='off'>
          <div class="input-group-append">
            <span class="input-group-text h-100">
              <i class="fa fa-calendar"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="mb-3 col-md-2">
        <label for="Cliente">Cliente</label>
        <select class="form-control" id="Cliente" name="cliente[]" required autofocus>
          <option value="">SELECCIONAR</option>
          ${clientes.map(cliente => `<option value="${cliente.id_cliente}">${cliente.nombre}</option>`).join('')}
        </select>
      </div>
      <div class="mb-3 col-md-2">
        <label for="Localidad">Localidad</label>
        <select class="form-control" required autofocus id="Localidad" name="localidad[]">
          <option value="">SELECCIONAR</option>
          ${localidades.map(localidad => `<option value="${localidad.id_localidad}">${localidad.nombre}</option>`).join('')}
          </select>
      </div>
      <div class="mb-3 col-md-2">
        <label for="Sistema">Sistema</label>
        <select class="form-control" required autofocus id="Sistema" name="sistema[]">
          <option value="">SELECCIONAR</option>
          ${sistemas.map(sistema => `<option value="${sistema.id_sistema}">${sistema.nombre}</option>`).join('')}
        </select>
      </div>
      <div class="mb-3 col-md-2">
        <label for="Sop">Sistema Operativo</label>
        <select class="form-control" required autofocus id="Sop" name="sop[]">
          <option value="">SELECCIONAR</option>
          ${sos.map(sop => `<option value="${sop.id_sop}">${sop.nombre}</option>`).join('')}
        </select>
      </div>
      <div class="mb-3 col-md-2">
        <label for="Incidencia">Incidencia</label>
        <select class="form-control" required autofocus id="incidencia" name="incidencia[]">
          <option value="">SELECCIONAR</option>
          ${incidencias.map(incidencia => `<option value="${incidencia.id_incidencia}">${incidencia.nombre}</option>`).join('')}
        </select>
      </div>
      <div class="mb-3 col-md-2">
        <label for="Solicitante">Solicitante</label>
        <select class="form-control select2" required autofocus id="email" name="email[]">
          <option value="">SELECCIONAR</option>
          ${users.map(user => `<option value="${user.id_user}">${user.email}</option>`).join('')}
        </select>
      </div>
      <div class="mb-3 col-md-2">
        <label for="Comentario">Comentario</label>
        <input id="Comentario" type="text" class="form-control" placeholder="Comentario" name="comentario[]" required autofocus autocomplete='off'>
      </div>
      <div class="mb-3 col-md-2">
        <label for="estatus">Estatus</label>
        <select class="form-control" required autofocus {{ Auth::user()->usrdata->id_rol == 3 ? 'disabled' : '' }} id="estatus" name="estatus[]">
          <option value="">SELECCIONAR</option>
          ${estatus.map(estado => `<option value="${estado.id_estatus}">${estado.nombre}</option>`).join('')}
        </select>
      </div>
      <div class="mb-3 col-md-2">
        <label for="Placeholder">&nbsp;</label>
        <div class="form-group">
          <button class="btn btn-danger" type="button" onclick="remove_support_fields(${room});">
            <i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
    </div>`;

  objTo.appendChild(divtest);

  $('.select2').select2({
    tags: true,
    tokenSeparators: [',', ' '],
    createTag: function(params) {
      return {
        id: params.term,
        text: params.term,
        newOption: true
      };
    }
  }).on('change', function() {
    var selectedEmail = $(this).val();
    $('#noEmail').val(selectedEmail);
  });

  // Evento change para el campo de correo electrónico
  $('#email').change(function() {
    var selectedEmail = $(this).val();
    if (selectedEmail === "") {
      $('#noEmail').prop('disabled', false).focus();
    } else {
      $('#noEmail').prop('disabled', true);
    }
  });
  
// Configuración del datetimepicker
  jQuery.datetimepicker.setLocale('es');
  $('.mydatepicker').datetimepicker({
    theme: 'dark',
    language: 'es',
    format: 'd-m-Y H:i',
    step: 15,
  });
}

function remove_support_fields(rid) { 
  $(".removeclass" + rid).remove();
}

