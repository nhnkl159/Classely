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
            left: ''
        },
        events: {
            url: '/api/routine_json',
            error: function() {
                swal('שגיאה', 'התרחשה שגיאה! פנה למנהל המערכת', 'error');
            },
            success: function(){
                //
            }
        },
        hiddenDays: [ 6 ],
        minTime: "07:00:00",
        maxTime: "21:00:00",
        defaultView: $(window).width() < 765 ? 'listWeek':'agendaWeek',
        height: 'auto'
    });

});
</script>