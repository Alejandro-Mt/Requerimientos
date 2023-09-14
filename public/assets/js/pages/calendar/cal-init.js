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
            this.enableDrag();
            /*  Initialize the calendar  */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            //var today = new Date($.now());
            var $this = this;
            $.ajax({
                url: '/rango.'+document.getElementsByName('folio')[0].value,
                type: 'get',
                success: function(response) {
                    console.log(response)
                    var validRange = {
                        start: response.start,
                    };
            $this.$calendarObj = $this.$calendar.fullCalendar({
                slotDuration: '00:15:00',
                /* If we want to split day time each 15minutes */
                minTime: '08:00:00',
                maxTime: '19:00:00',
                defaultView: 'agendaWeek',
                handleWindowResize: true,

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: {
                      url: '/show.'+document.getElementsByName('folio')[0].value,
                      type: 'get',
                      error: function() {
                        alert('¡Ha ocurrido un error al recuperar eventos!');
                      },
                      allDay:true,
                    },
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                validRange: validRange,
                drop: function(date) { 
                    $this.onDrop($(this), date);
                 },
                select: function(start, end, allDay) { 
                    $this.onSelect(start, end, allDay);
                 },
                eventResize: function(event) {
                    var start = event.start.format("DD-MM-YYYY HH:mm");
                    var back=event.backgroundColor;
                    var allDay=event.allDay;
                    if(event.end){
                      var fin = event.end.format("DD-MM-YYYY HH:mm");
                    }
                    switch(event.title){
                        case 'Definición de requerimientos':
                            document.getElementsByName('fechaCompReqR')[0].value=fin;
                            break;
                        case 'Análisis de requerimientos':
                            document.getElementsByName('fechaAutAn')[0].value=fin;
                            break;
                        case 'Construcción':
                            document.getElementsByName('fechaInConR')[0].value=fin;
                            break;
                        case 'Liberación':
                            document.getElementsByName('FechaLibR')[0].value=fin;
                            break;
                        case 'Implemantación':
                            document.getElementsByName('FechaImpP')[0].value=fin;
                            break;
                    }
                },
                eventDrop: function(event) {
                    var inicio = event.start.format("DD-MM-YYYY HH:mm");
                    if(event.end){
                        var fin = event.end.format("DD-MM-YYYY HH:mm");
                    }
                    else{
                        var fin=inicio;
                    }
                    switch(event.title){
                        case 'Definición de requerimientos':
                            document.getElementsByName('fechaCompReqC')[0].value=inicio;
                            document.getElementsByName('fechaCompReqR')[0].value=fin;
                            break;
                        case 'Análisis de requerimientos':
                            document.getElementsByName('fechaEnvAn')[0].value=inicio;
                            document.getElementsByName('fechaAutAn')[0].value=fin;
                            break;
                        case 'Construcción':
                            document.getElementsByName('fechaInConP')[0].value=inicio;
                            document.getElementsByName('fechaInConR')[0].value=fin;
                            break;
                        case 'Liberación':
                            document.getElementsByName('FechaLibP')[0].value=inicio;
                            document.getElementsByName('FechaLibR')[0].value=fin;
                            break;
                        case 'Implemantación':
                            document.getElementsByName('FechaImpP')[0].value=inicio;
                            //document.getElementsByName('FechaImpR')[0].value=inicio;
                            break;
                    }
                    var allDay=event.allDay;
                },
                eventClick: function(calEvent, jsEvent, view) {
                    $this.onEventClick(calEvent, jsEvent, view);
                }

            });
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

        //init CalendarApp
        $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

}(window.jQuery),

//initializing CalendarApp
$(window).on('load', function() {

    $.CalendarApp.init()
});