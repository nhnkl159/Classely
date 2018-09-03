<script>
$(document).ready(function()
{
    jQuery('.js-calendar').fullCalendar({
        editable: false,
        droppable: false,
        locale: 'he',
        header: {
            right: '',
            center: 'title',
            left: 'next,prev today'
        },
        events: [{
            title:"My repeating event",
            start: '10:00', // a start time (10am in this example)
            end: '14:00', // an end time (2pm in this example)
            dow: [ 1, 4 ], // Repeat monday and thursday
        }],
        defaultView: 'month'
    });
});
</script>