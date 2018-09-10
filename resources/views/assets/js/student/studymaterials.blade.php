<script>
jQuery.datetimepicker.setLocale('he');

$(document).ready(function()
{
    jQuery('#studymaterialsTable').dataTable({
        ajax: "/api/studymaterials_json",
        responsive: true,
        cache: true,
        columns: [
            { "data": "subject_name" },
            { "data": "teacher_id" },
            { "data": "note" },
            { "data": "created_at" },
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
            "lengthMenu": "מציג _MENU_ חומרי לימוד לכל עמוד",
            "zeroRecords": "לא נמצאו חומרי לימוד",
            "info": "",
            "infoEmpty": "אין חומרי לימוד",
            "infoFiltered": "(נמצאו _TOTAL_ חומרי לימוד)",
            "search": "חיפוש חופשי: ",
            "paginate": {
                "first": "הראשון",
                "last": "האחרון",
                "next": "הבא",
                "previous": "הקודם"
            },
            "processing": "טוען חומרי לימוד...",
            "decimal": ".",
            "thousands": ","
        },
        createdRow: function (row, data) {
            $(row).find("td").addClass('text-center');
        }
    });
    $('.dataTables_filter').addClass('float-left');

    var div = $("#studymaterialsTable_wrapper").find(".row:first div.col-sm-12.col-md-6:first");
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
    
            var tableDate = moment(data[3], 'YYYY-MM-DD');

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

    $('#studymaterialsTable').dataTable().api().column(2).search('', true, false).draw();
});


</script>