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
        events: {
            url: '/api/attendance_json',
            error: function() {
                swal('שגיאה', 'התרחשה שגיאה! פנה למנהל המערכת', 'error');
            },
            success: function(){
                //
            }
        },
        eventRender: function (event, element, view)
        {
            if(event.status == 1)
            {
                var dateString = event.start.format("YYYY-MM-DD");
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-image', 'linear-gradient(to top, #0ba360 0%, #3cba92 100%)');
            }
            else if(event.status == 2)
            {
                var dateString = event.start.format("YYYY-MM-DD");
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-image', 'linear-gradient(to top, #ff0844 0%, #d65757 100%)');
            }
        },
        eventAfterAllRender: function (view)
        {
            $(document).find('.fc-day-grid-event').removeClass();
        },
        defaultView: 'month'
    });
});
</script>