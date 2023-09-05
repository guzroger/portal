<?php 
$model = ApiData::BasicInfo();

$nombre = $model['nombre'];

$item = $model['item'];

$foto = $model['foto'];


?>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <a href="<?php echo $this->createUrl('admin'); ?>" class="btn btn-danger">Volver</a>
            <br><br>
            <div id="consultas"></div>
        </div>
    </div> <!-- end col -->
</div>  <!-- end row -->

<div id="modalRegister" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel">Registrar Consulta</h4>
            </div>
            <form action="<?php echo Yii::app()->createUrl('medical/registerConsultation',array('med'=>$_GET['med'])); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <br>
                            <label class="control-label">Atenci&oacute;n</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="reg_title" id="reg_title" value="Atenci&oacute;n M&eacute;dica" required>
                            </div><!-- input-group -->
                        </div>
                        <div class="col-lg-6">
                            <br>
                            <label class="control-label">Fecha Consulta</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="reg_date" id="reg_date" required readonly="readonly">
                                <input type="hidden" class="form-control" name="reg_dt" id="reg_dt" required readonly="readonly">
                            </div><!-- input-group -->
                        </div>
                        <div class="col-lg-3">
                            <br>
                            <label class="control-label">Hora Inicio</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="reg_time_start" id="reg_time_start" required readonly="readonly">
                                <input type="hidden" class="form-control" name="reg_start" id="reg_start" required readonly="readonly">
                            </div><!-- input-group -->
                        </div>
                        <div class="col-lg-3">
                            <br>
                            <label class="control-label">Hora Fin</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="reg_time_end" id="reg_time_end" required readonly="readonly">
                                <input type="hidden" class="form-control" name="reg_end" id="reg_end" required readonly="readonly">
                            </div><!-- input-group -->
                        </div>
                        <div class="col-lg-12">
                            <br>
                            <label class="control-label">Paciente</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="reg_name" id="reg_name" value="<?php echo $nombre; ?>" required readonly="readonly">
                                <input type="hidden" class="form-control" name="reg_id" id="reg_id" value="<?php echo $item; ?>" required>
                            </div><!-- input-group -->
                        </div>
                        <div class="col-lg-12">
                            <br>
                            <label class="control-label">Tipo de Atenci&oacute;n</label>
                            <select class="form-control" name="reg_consul" required>
                                <option value="">SELECCIONAR</option>
                                <?php foreach($scheduleType as $type){ ?>
                                    <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                    <button type="submit" name="btnReg" class="btn btn-danger waves-effect waves-light">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$modal = $('#event-modal'),
        this.$event = ('#external-events div.external-event'),
        this.$calendar = $('#consultas'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$categoryForm = $('#add-category form'),
        this.$extEvents = $('#external-events'),
        this.$calendarObj = null
    };


    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
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
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
    },
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
        var $this = this;
            var form = $("<form></form>");
            form.append("<label>Change event name</label>");
            form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>");
            $this.$modal.modal({
                backdrop: 'static'
            });
            $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
                $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                    return (ev._id == calEvent._id);
                });
                $this.$modal.modal('hide');
            });
            $this.$modal.find('form').on('submit', function () {
                calEvent.title = form.find("input[type=text]").val();
                $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                $this.$modal.modal('hide');
                return false;
            });
    },
    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, allDay) {
        var $this = this;
            $this.$modal.modal({
                backdrop: 'static'
            });
            var form = $("<form></form>");
            form.append("<div class='row'></div>");
            form.find(".row")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>")
                .find("select[name='category']")
                .append("<option value='bg-danger'>Danger</option>")
                .append("<option value='bg-success'>Success</option>")
                .append("<option value='bg-purple'>Purple</option>")
                .append("<option value='bg-primary'>Primary</option>")
                .append("<option value='bg-warning'>Warning</option></div></div>");
            $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                form.submit();
            });
            $this.$modal.find('form').on('submit', function () {
                var title = form.find("input[name='title']").val();
                var beginning = form.find("input[name='beginning']").val();
                var ending = form.find("input[name='ending']").val();
                var categoryClass = form.find("select[name='category'] option:checked").val();
                if (title !== null && title.length != 0) {
                    $this.$calendarObj.fullCalendar('renderEvent', {
                        title: title,
                        start:start,
                        end: end,
                        allDay: false,
                        className: categoryClass
                    }, true);  
                    $this.$modal.modal('hide');
                }
                else{
                    alert('You have to give a title to your event');
                }
                return false;
                
            });
            $this.$calendarObj.fullCalendar('unselect');
    },
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
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
        var today = new Date($.now());

        var defaultEvents =  [
            <?php foreach($schedule as $event){ ?>
                {
                    title: '<?php echo $event["patient_name"]; ?>',
                    start: '<?php echo $event["start"]; ?>',
                    end: '<?php echo $event["end"]; ?>',
                    description: '<?php echo $event["title"]; ?>',
                    color: '<?php echo $event["color"]; ?>',
                    fecha: '<?php echo date("d/m/Y", strtotime($event["date_consultation"])); ?>',
                    inicio: '<?php echo date("H:i", strtotime($event["start"])); ?>',
                    fin: '<?php echo date("H:i", strtotime($event["end"])); ?>',
                    item: '<?php echo $event["patient_item"]; ?>',
                    tipo: '<?php echo $event["patient_type"]; ?>',
                    estado: '<?php echo $event["patient_status"]; ?>',
                    relacion: '<?php echo $event["patient_relation"]; ?>',
                    identificador: '<?php echo $event["id"]; ?>',
                    typeCon: '<?php echo $event["typeCon"]; ?>',
                    stsCon: '<?php echo $event["stsCon"]; ?>',
                    stsConId: '<?php echo $event["stsConId"]; ?>',
                },
            <?php } ?>
        ];

        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:<?php echo $calendar->time; ?>:00', /* If we want to split day time each 15minutes */
            minTime: '<?php echo $calendar->start; ?>:00',
            maxTime: '<?php echo $calendar->end; ?>:00',   
            defaultView: 'agendaDay',  
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
            handleWindowResize: true,   
            height: $(window).height() - 200,   
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: defaultEvents,
            editable: false,
            eventDurationEditable : false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            drop: function(date) { $this.onDrop($(this), date); },
            select: function (start, end, allDay) { 
                
                date = start;

                if (!IsDateHasEvent(date)) {
                    $('#modalRegister #reg_date').val(moment(start).format('DD/MM/YYYY'));
                    $('#modalRegister #reg_time_start').val(moment(start).format('HH:mm'));
                    $('#modalRegister #reg_time_end').val(moment(end).format('HH:mm'));
                    $('#modalRegister #reg_start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#modalRegister #reg_end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#modalRegister #reg_dt').val(moment(end).format('YYYY-MM-DD'));
                    $('#modalRegister').modal('show');
                }

            },

            eventDrop: function(event, delta, revertFunc) { // si changement de position

                var evid = event.identificador;

                var dtstar = event.start.format('YYYY-MM-DD HH:mm:ss');

                var dtend = event.end.format('YYYY-MM-DD HH:mm:ss');

                $.ajax({
                url: "<?php echo Yii::app()->createUrl('diary/updateDrop',array('med'=>$_GET['med']));?>",
                type: "POST",
                data: {
                    evid:evid,
                    dtstar:dtstar,
                    dtend:dtend
                },
                success: function(rep) {
                    window.location.href = "index.php?r=diary/calendar&med=<?php echo $_GET['med']; ?>";
                    
                }
                });

            },

            eventMouseover: function(calEvent, jsEvent) {
                var tooltip = '<div class="tooltipevent" style="width:200px;height:auto;background:'+calEvent.color+';color:white;text-align: justify;margin: 5px;padding: 5px;position:absolute;z-index:10001;border-style: ridge;">Evento: '+calEvent.description+'<br>Paciente: ' + calEvent.title + '<br>ITEM: '+calEvent.item + '<br>Fecha: '+calEvent.fecha + '<br>Inicio: '+calEvent.inicio+'<br>Fin: '+calEvent.fin+'<br>Tipo: '+calEvent.typeCon+'<br>Estado: '+calEvent.stsCon+ '</div>';
                var $tooltip = $(tooltip).appendTo('body');

                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $tooltip.fadeIn('500');
                    $tooltip.fadeTo('10', 1.9);
                }).mousemove(function(e) {
                    $tooltip.css('top', e.pageY + 10);
                    $tooltip.css('left', e.pageX + 20);
                });
            },

            eventMouseout: function(calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltipevent').remove();
            },
            eventClick: function(calEvent, jsEvent, view) { 

                $('#modalUpdate #up_id').val(calEvent.identificador);
                $('#modalUpdate #up_id_reg').val(calEvent.identificador);
                $('#modalUpdate #up_name').val(calEvent.title);
                $('#modalUpdate #up_item').val(calEvent.item);
                $('#modalUpdate #up_status').val(calEvent.estado);
                $('#modalUpdate #up_type').val(calEvent.tipo);
                $('#modalUpdate #up_relation').val(calEvent.relacion);
                $('#modalUpdate #up_date').val(moment(calEvent.start).format('DD/MM/YYYY'));
                $('#modalUpdate #up_time_start').val(moment(calEvent.start).format('HH:mm'));
                $('#modalUpdate #up_time_end').val(moment(calEvent.end).format('HH:mm'));
                $('#modalUpdate #up_stsCon').val(calEvent.stsCon);
                $('#modalUpdate #up_typeCon').val(calEvent.typeCon);

                if(calEvent.stsConId == 1){
                    document.getElementById("buttonDelete").style.display = "block";
                    document.getElementById("formDelete").style.display = "none";
                }else{
                    document.getElementById("buttonDelete").style.display = "none";
                    document.getElementById("formDelete").style.display = "none";
                }
                $('#modalUpdate').modal('show');
            },

        });
    

         // check if this day has an event before
        function IsDateHasEvent(date) {
            var allEvents = [];
            allEvents = $('#consultas').fullCalendar('clientEvents');

            var suma = 0;
            var event = $.grep(allEvents, function (v) {

                if(+v.start === +date){
                    suma = suma + 1;
                }

                if(v.end === date){
                    suma = suma + 1;
                }

                if(v.start < date  && v.end > date){
                    suma = suma + 1;
                }

                 
                return suma;
            });
            return event.length > 0;
        }
        //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-move"></i>' + categoryName + '</div>')
                $this.enableDrag();
            }

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()
}(window.jQuery);

</script>

