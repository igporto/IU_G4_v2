
<script>
$(document).ready(function() {
$('#calendar').fullCalendar({
    defaultView: 'agendaWeek',
    firstDay: 1,
    allDay: false,
    header:
        {
            left:   'title',
            center: 'agendaWeek, month',
            right:  'today prev,next'
        },
    events: [
        {
            title  : 'event1',
            start  : '2017-01-01',
        },
        {
            title  : 'event2',
            start  : '2017-01-05',
            end    : '2017-01-07',
            color: '#000000'

        },
        {
            title  : 'event3',
            start  : '2017-01-09T12:33:00',
            allDay : false // will make the time show
        },
    ]
});
}); 
</script>

<div class="" style="margin-top: 20px; margin-bottom: 20px">
		<div id='calendar' ></div>
</div>

