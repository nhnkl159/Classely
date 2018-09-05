<script>
$(document).ready(function()
{
    var _current_view = '';
    jQuery('.js-calendar').fullCalendar({
        editable: false,
        droppable: false,
        locale: 'he',
        header: {
            right: '',
            center: 'title',
            left: $(window).width() < 765 ? '' : 'month,agendaWeek'
        },
        events: {
            url: '/api/exams_schedule_json',
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
        viewRender: function(view, element)
        {
            _current_view = view.name;
        },
        eventAfterAllRender: function (view)
        {
            if(_current_view == 'month')
            {
                $(document).find(".fc-event").css("line-height", '3.3');
            }
            else
            {
                $(document).find(".fc-event").css("line-height", '1.3');
            }
        },
        defaultView: $(window).width() < 765 ? 'listWeek':'agendaWeek',
        height: 'auto'
    });
});
</script>