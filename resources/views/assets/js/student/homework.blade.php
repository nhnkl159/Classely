<script>
jQuery.datetimepicker.setLocale('he');

$(document).ready(function()
{
    jQuery('#homeworkTable').dataTable({
        ajax: "/api/homework_json",
        responsive: true,
        cache: true,
        columns: [
            { "data": "subject_name" },
            { "data": "teacher_id" },
            { "data": "submit_date" },
            { "data": "note" },
            { 
                "data": "files_path",
                "render": function ( data, type, row, meta )
                {
                    var jsonParsed = JSON.parse(data);
                    return '<a href="'+jsonParsed['test']+'" download><i class="fa fa-download"></i></a>';
                }
            },
        ],
        columnDefs: [ { orderable: false, targets: [ 4 ] } ],
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false,
        paginate: true,
        lengthChange: false,
        language: {
            "lengthMenu": "מציג _MENU_ שיעורי בית לכל עמוד",
            "zeroRecords": "לא נמצאו שיעורי בית",
            "info": "",
            "infoEmpty": "אין שיעורי בית",
            "infoFiltered": "(נמצאו _TOTAL_ שיעורי בית)",
            "search": "חיפוש חופשי: ",
            "paginate": {
                "first": "הראשון",
                "last": "האחרון",
                "next": "הבא",
                "previous": "הקודם"
            },
            "processing": "טוען שיעורי בית...",
            "decimal": ".",
            "thousands": ","
        },
        createdRow: function (row, data) {
            $(row).find("td").addClass('text-center');
        }
    });
    $('.dataTables_filter').addClass('float-left');

    var div = $("#homeworkTable_wrapper").find(".row:first div.col-sm-12.col-md-6:first");
    $(div).addClass('row');
    $(div).addClass('mr-5');
    $(div).addClass('mb-5');

    var inputs_html = `
        <div class="col-md-6 row">
            <label for="dateFrom" class="col-form-label">מתאריך:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="dateFrom">
            </div>
        </div>
        <div class="col-md-6 row">
            <label for="dateFrom" class="col-form-label">עד:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="dateTo">
            </div>
        </div>
    `;

    $(div).html(inputs_html);

        $('#dateFrom, #dateTo').datetimepicker({
        timepicker:false,
        format:'d/m/Y'
      
    });

});

$(document).on('change','#dateFrom, #dateTo',function()
{
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var startDate = $("#dateFrom").val();
            //convert date into epoch
            startDate = moment(startDate, 'DD/MM/YYYY');
    
            var endDate = $("#dateTo").val();
            endDate = moment(endDate, 'DD/MM/YYYY');
    
            var tableDate = moment(data[2], 'YYYY-MM-DD');

            if($("#dateFrom").val() == '' && $("#dateTo").val() == '')
            {
                return true;
            }

            if($("#dateFrom").val() != '' && (startDate <= tableDate))
            {
                if($("#dateTo").val() == '')
                {
                    return true;
                }
                else if($("#dateTo").val() != '' && (endDate >= tableDate))
                {
                    return true;
                }
                return false;
            }
            return false;
        }
    );

    $('#homeworkTable').dataTable().api().column(2).search('', true, false).draw();
});


</script>