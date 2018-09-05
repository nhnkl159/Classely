<script>
//global
var current_page_number = 1;
var total_page_number = 0;

//functions
function showPage(page_num)
{
    var _csrf = $("input[name='_token']").val();
    $.ajax({
        url: '/api/noticeboard_json',
        type: 'POST',
        headers: { 
            'X-CSRF-TOKEN': _csrf,
        },
        data: {
            page_number: page_num
        },
        error: function()
        {
            swal('נמצאה בעיה', 'שגיאה לא ידועה' ,'error');
        },
        success: function(data) 
        {
            $('#notices').html(data);
        }
    });
}

function getTotalPages()
{
    var _csrf = $("input[name='_token']").val();
    $.ajax({
        url: '/api/noticeboard_json',
        type: 'POST',
        headers: { 
            'X-CSRF-TOKEN': _csrf,
        },
        data: {
            totalpage: 1
        },
        error: function()
        {
            swal('נמצאה בעיה', 'שגיאה לא ידועה' ,'error');
        },
        success: function(data) 
        {
            total_page_number = parseInt(data);
            $('#maxpages').text(total_page_number);

            if(current_page_number == total_page_number)
            {
                $('#nextBTN').prop('disabled', true);
            }
        }
    });
}

$(document).on('click','#noticeboard_read',function()
{
    var _id = $(this).data("id");
    var _csrf = $("input[name='_token']").val();

    $('#loader').show();

    $.ajax({
        url: '/api/notice_json',
        type: 'POST',
        headers: { 
            'X-CSRF-TOKEN': _csrf,
        },
        data: {
            id: _id
        },
        error: function()
        {
            swal('נמצאה בעיה', 'שגיאה לא ידועה' ,'error');
        },
        success: function(data) 
        {
            if(data.status == true)
            {
                var _html = '';
                
                _html += '<div class="col-xs-12 col-md-6">';
                _html += '<a href="#"><h3 class="h4 font-w700 text-uppercase mb-5">'+ data.title +'</h3></a>';
                _html += '</div>';
    
    
                _html += '<div class="col-xs-12 col-md-6 text-left">';
                _html += '<div class="text-muted mb-10">';
                _html += '<span class="mr-5">';
                _html += '<i class="fa fa-fw fa-calendar mr-5"></i>' + data.created_at;
                _html += '</span>';
                _html += '<span class="text-muted mr-5">';
                _html += '<i class="fa fa-fw fa-user mr-5"></i>' + data.by;
                _html += '</span>';
                _html += '</div>';
                _html += '</div>';

                _html += '<div class="container">';
                _html += '<p>'+ data.body +'</p>';
                _html += '</div>';
                $('#loader').hide();
                $('#dynamicData').html(_html);
            }
            else
            {
                swal('נמצאה בעיה', data.message,'error');
            }
        }
     });
});

$(document).on('click','#nextBTN',function()
{
    current_page_number++;
    showPage(current_page_number);
    if(current_page_number > 1)
    {
        $('#backBTN').prop('disabled', false);
    }

    if(current_page_number >= total_page_number)
    {
        $('#nextBTN').prop('disabled', true);
    }

    $('#current_page_input').val(current_page_number);
});

$(document).on('click','#backBTN',function()
{
    current_page_number--;
    showPage(current_page_number);
    if(current_page_number == 1)
    {
        $('#backBTN').prop('disabled', true);
    }
    else
    {
        $('#backBTN').prop('disabled', false);
    }

    if(current_page_number < total_page_number)
    {
        $('#nextBTN').prop('disabled', false);
    }

    $('#current_page_input').val(current_page_number);
});

$(document).on('change','#current_page_input',function()
{
    if(this.value > total_page_number)
    {
        this.value = current_page_number;
        return;
    }

    current_page_number = this.value;
    showPage(this.value);

    if(current_page_number == total_page_number)
    {
        $('#nextBTN').prop('disabled', true);
    }
    else
    {
        $('#nextBTN').prop('disabled', false);
    }
});


$(document).ready(function()
{
    if(window.location.href.indexOf("noticeboard") > -1)
    {
        showPage(current_page_number);
        getTotalPages();
        $('#current_page_input').val(current_page_number);
    }
});

</script>