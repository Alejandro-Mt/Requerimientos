! function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
            this.$event = ('#calendar-events div.calendar-events'),
            this.$categoryForm = $('#add-new-event form'),
            this.$extEvents = $('#calendar-events'),
            this.$modal = $('#my-event'),
            this.$saveCategoryBtn = $('.save-category'),
            this.$calendarObj = null
    };


    /* Funcion de eventos Registrados  */
    CalendarApp.prototype.onDrop = function(eventObj, date) {
            var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            
            var titulo = copiedEventObject.title;
            var color = copiedEventObject.className['0'];
            var inicio = copiedEventObject.start.format("DD-MM-YYYY HH:mm");
            var fin = copiedEventObject.start.format("DD-MM-YYYY HH:mm");
            var crsfToken = null;
            switch(titulo){
                case 'Definición de requerimientos':
                    document.getElementsByName('fechaCompReqC')[0].value=inicio;
                    document.getElementsByName('fechaCompReqR')[0].value=inicio;
                    break;
                case 'Análisis de requerimientos':
                    document.getElementsByName('fechaEnvAn')[0].value=inicio;
                    document.getElementsByName('fechaAutAn')[0].value=inicio;
                    break;
                case 'Construcción':
                    document.getElementsByName('fechaInConP')[0].value=inicio;
                    document.getElementsByName('fechaInConR')[0].value=inicio;
                    break;
                case 'Liberación':
                    document.getElementsByName('FechaLibP')[0].value=inicio;
                    document.getElementsByName('FechaLibR')[0].value=inicio;
                    break;
                case 'Implementación':
                    document.getElementsByName('FechaImpP')[0].value=inicio;
                    //document.getElementsByName('FechaImpR')[0].value=inicio;
                    break;
            }
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
    },
    /* Eventos al hacer click */
    CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
        var $this = this;
        var form = $("<form></form>");
        form.append("<label>Cambiar Título</label>");
        form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light' style='Color: white'><i class='fa fa-check'></i> Guardar</button></span></div>");
        $this.$modal.show();
            $('.bckdrop').addClass('show');
        $('.bckdrop').removeClass('hide');
        $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function() {
            $this.$calendarObj.fullCalendar('removeEvents', function(ev) {
                return (ev._id == calEvent._id);
            });
            $this.$modal.hide('hide');
            $('.bckdrop').addClass('hide');
            $('.bckdrop').removeClass('show');
        });
        $this.$modal.find('form').on('submit', function() {
            calEvent.title = form.find("input[type=text]").val();
            $this.$calendarObj.fullCalendar('updateEvent', calEvent);
            $this.$modal.hide('hide');
            $('.bckdrop').addClass('hide');
        $('.bckdrop').removeClass('show');
            return false;
        });
    },
    /* Editar Evento */
    CalendarApp.prototype.onSelect = function(start, end, allDay) {
        var $this = this;
        $this.$modal.show();
        $('.bckdrop').addClass('show');
        $('.bckdrop').removeClass('hide');
        var form = $("<form></form>");
        form.append("<div class='row'></div>");
        form.find(".row")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Titilo de Evento</label><input class='form-control' placeholder='Titulo' type='text' name='title'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Color</label><select class='form-select' name='category'></select></div></div>")
            .find("select[name='category']")
            .append("<option selected value=''>Seleccione</option>")
            .append("<option value='bg-danger'>Rojo</option>")
            .append("<option value='bg-success'>Verde</option>")
            .append("<option value='bg-primary'>Cian</option>")
            .append("<option value='bg-info'>Azul</option>")
            .append("<option value='bg-warning'>Amarillo</option></div></div>");
        $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
            form.submit();
            $('.bckdrop').addClass('hide');
            $('.bckdrop').removeClass('show');
            $('body').removeClass('modal-open');
        });
        $this.$modal.find('.close-dialog').click(function() {
            $this.$modal.hide('hide');
            $('.bckdrop').addClass('hide');
        $('.bckdrop').removeClass('show');
        $('body').removeClass('modal-open')
        $('body').removeAttr('style');
        });
        $('body').addClass('modal-open');
        $this.$modal.find('form').on('submit', function() {
            var title = form.find("input[name='title']").val();
            var beginning = form.find("input[name='beginning']").val();
            var ending = form.find("input[name='ending']").val();
            var categoryClass = form.find("select[name='category'] option:checked").val();
            if (title !== null && title.length != 0) {
                $this.$calendarObj.fullCalendar('renderEvent', {
                    title: title,
                    start: start,
                    end: end,
                    allDay: false,
                    className: categoryClass
                }, true);
                $this.$modal.hide('hide');
                $('.bckdrop').addClass('hide');
                $('.bckdrop').removeClass('show');
            } else {
                alert('No haz otorgado un Titulo al Evento');
            }
            return false;

        });
        $this.$calendarObj.fullCalendar('unselect');
    },
    CalendarApp.prototype.enableDrag = function() {
        //Crear evento de arrastre
        $(this.$event).each(function() {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) //Titutlo predefinido
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });
        });
    }
    /* Initializing */
    CalendarApp.prototype.init = function() {
        var $this = this;
        $.ajax({
            url: '/start.'+document.getElementsByName('folio')[0].value,
            type: 'get',
            success: function(response) {
                var validRange = {
                    start: response,
                };
                var defaultDate = response;
                console.log("Fecha de inicio:", response);
                // Initialize the calendar
                $this.$calendarObj = new FullCalendar.Calendar($this.$calendar[0],{
                    // plugins: [ 'timeline' ],
                    slotDuration: '00:15:00',
                    initialView: 'dayGridMonth',
                    businessHours: {
                        // days of week. an array of zero-based day of week integers (0=Sunday)
                        daysOfWeek: [ 1, 2, 3, 4, 5], // Monday - Thursday
                      
                        startTime: '09:00', // a start time (10am in this example)
                        endTime: '19:00', // an end time (6pm in this example)
                      },
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    initialDate: defaultDate,
                    themeSystem: 'bootstrap',
                    events: {
                        url: '/show.'+document.getElementsByName('folio')[0].value,
                        method: 'get',
                        failure: function() {
                            alert('¡Ha ocurrido un error al recuperar eventos!');
                        },
                        allDay:true,
                        },
                    editable: false,
                    locale: 'es',
                    droppable: false, // this allows things to be dropped onto the calendar !!!
                    // eventLimit: true, // allow "more" link when too many events
                    selectable: false,
                    validRange: validRange,
                    eventDrop: function(info) {
                        var start = info.event.start.toISOString();
                        var end = info.event.end ? info.event.end.toISOString() : start;
                        
                        switch (info.event.title) {
                            case 'Definición de requerimientos':
                                document.getElementsByName('fechaCompReqC')[0].value = start;
                                document.getElementsByName('fechaCompReqR')[0].value = end;
                                break;
                            case 'Análisis de requerimientos':
                                document.getElementsByName('fechaEnvAn')[0].value = start;
                                document.getElementsByName('fechaAutAn')[0].value = end;
                                break;
                            case 'Construcción':
                                document.getElementsByName('fechaInConP')[0].value = start;
                                document.getElementsByName('fechaInConR')[0].value = end;
                                break;
                            case 'Liberación':
                                document.getElementsByName('FechaLibP')[0].value = start;
                                document.getElementsByName('FechaLibR')[0].value = end;
                                break;
                            case 'Implemantación':
                                document.getElementsByName('FechaImpP')[0].value = start;
                                break;
                        }
                    },
                    eventResize: function(info) {
                        var end = info.event.end ? info.event.end.toISOString() : info.event.start.toISOString();

                        switch (info.event.title) {
                            case 'Definición de requerimientos':
                                document.getElementsByName('fechaCompReqR')[0].value = end;
                                break;
                            case 'Análisis de requerimientos':
                                document.getElementsByName('fechaAutAn')[0].value = end;
                                break;
                            case 'Construcción':
                                document.getElementsByName('fechaInConR')[0].value = end;
                                break;
                            case 'Liberación':
                                document.getElementsByName('FechaLibR')[0].value = end;
                                break;
                            case 'Implemantación':
                                document.getElementsByName('FechaImpP')[0].value = end;
                                break;
                        }
                    },
                    dateClick: function(info) {
                        $this.onDateClick(info);
                    },
                    eventClick: function(info) {
                        $this.onEventClick(info.event, info.jsEvent, info.view);
                    }
                });
                $this.$calendarObj.render();
            }
        });

        // Nueva Categoria BTN
        this.$saveCategoryBtn.on('click', function() {
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="calendar-events mb-3" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-circle text-' + categoryColor + ' me-2" ></i>' + categoryName + '</div>')
                $this.enableDrag();
            }

        });
    },

    // Initialize CalendarApp
    $.CalendarApp = new CalendarApp();
    $.CalendarApp.Constructor = CalendarApp;

}(window.jQuery),

//initializing CalendarApp
$(window).on('load', function() {

    $.CalendarApp.init()
});