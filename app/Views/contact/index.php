<link href='/libs/fullcalendar/lib/main.css' rel='stylesheet' />
<script src='/libs/fullcalendar/lib/main.js'></script>
<script src='/libs/fullcalendar/lib/locales-all.js'></script>

<script>
  function addingZero(number){
      if(number < 10){
          return `0${number}`
      }
      return number
  }
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale:"es",
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay listDay',
      },
      select: function(arg) {
        var title = prompt('Nombre del evento:');
        if (title) {
            let startDate = `${arg.start.getFullYear()}-${addingZero(arg.start.getMonth()+1)}-${addingZero(arg.start.getDate())} ${addingZero(arg.start.getHours())}:${addingZero(arg.start.getMinutes())}`
            let endDate = `${arg.end.getFullYear()}-${addingZero(arg.end.getMonth()+1)}-${addingZero(arg.end.getDate())} ${addingZero(arg.end.getHours())}:${addingZero(arg.end.getMinutes())}`
            location.href=`/contact/new/${title}/${startDate}/${endDate}`
        }
        calendar.unselect()
      },
      eventClick: function(arg) {
        $("#eventModalLabel").html(arg.event.title)
        
        let startDate = `${arg.event.start.getFullYear()}-${addingZero(arg.event.start.getMonth()+1)}-${addingZero(arg.event.start.getDate())} ${addingZero(arg.event.start.getHours())}:${addingZero(arg.event.start.getMinutes())}`
        let endDate = `${arg.event.end.getFullYear()}-${addingZero(arg.event.end.getMonth()+1)}-${addingZero(arg.event.end.getDate())} ${addingZero(arg.event.end.getHours())}:${addingZero(arg.event.end.getMinutes())}`
        let content = `<h4>${arg.event.extendedProps.description}</h4><ul>
        <li><span class='badge badge-info'>Inicio</span> ${startDate}</li>
        <li><span class='badge badge-info'>Final</span> ${endDate}</li>
        <li><span class='badge badge-info'>Cliente</span> ${arg.event.extendedProps.customer}</li>
        <li><span class='badge badge-info'>Tipo</span> ${arg.event.extendedProps.type}</li>
        <li><span class='badge badge-success'>Asesor</span> ${arg.event.extendedProps.user}</li>
        <li><span class='badge badge-success'>Pedido</span> ${arg.event.extendedProps.order??""}</li>
        </ul>`
        $("#eventContent").html(content)
        $("#eventEdit").attr("href",`/contact/edit/${arg.event.id}`)
        $("#eventModal").modal('show')
      },
      initialDate: "<?= date("Y-m-d") ?>",
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      dayMaxEvents: true, // allow "more" link when too many events
      selectable: true,
      selectMirror: true,
      events: [
          <?php
          if(!empty($contactList)){
            foreach ($contactList as $value) {
echo <<<AAA
    {
        id:{$value["id"]},
        title: '{$value["title"]}',
        start: '{$value["datetime_start"]}',
        end: '{$value["datetime_end"]}',
        type: '{$value["type"]}',
        customer: '{$value["customer"]}',
        description: '{$value["description"]}',
        user: '{$value["user"]}',
        order: '{$value["order_id"]}',
    },
AAA;
            }
          }
            ?>    
      ]
    });

    calendar.render();
  });

</script>

<div id='calendar'></div>
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="eventModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="eventContent" class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a id="eventEdit" href="#"  class="btn btn-primary">Editar</a>
      </div>
    </div>
  </div>
</div>