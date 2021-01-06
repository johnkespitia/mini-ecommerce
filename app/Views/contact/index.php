<link href='/libs/fullcalendar/lib/main.css' rel='stylesheet' />
<script src='/libs/fullcalendar/lib/main.js'></script>
<script src='/libs/fullcalendar/lib/locales-all.js'></script>

<script>
  
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
            
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end
          })
          location.href=`/contact/new/${title}/${arg.start}/${arg.end}`
        }
        calendar.unselect()
      },
      eventClick: function(arg) {
        if (confirm('Desea editar este evento?')) {
          location.href=`/contact/edit/${arg.event.id}`
        }
      },
      initialDate: "<?= date("Y-m-d") ?>",
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      selectable: true,
      selectMirror: true,
      events: [
        {
          id:12,
          title: 'All Day Event',
          start: '2021-01-01',
          description: 'Preventa'
        },        
        {
          id:13,
          title: 'All Day Event',
          start: '2021-02-01',
          description: 'Postventa'
        },        
      ]
    });

    calendar.render();
  });

</script>

<div id='calendar'></div>