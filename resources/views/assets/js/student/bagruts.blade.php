<script>
jQuery.datetimepicker.setLocale('he');

$(document).ready(function()
{
    
    jQuery('#bagrutsTable').dataTable({
        ajax: "/api/bagruts_json",
        responsive: true,
        cache: true,
        columns: [
            { "data": "questionnaire_name" },
            { "data": "subject_name" },
            { "data": "questionnaire_num" },
            { "data": "questionnaire_main" },
            { "data": "bagrut_date" },
            { 
                "data": "submit_grade",
                "render": function ( data, type, row, meta )
                {
                    return data >= 55 ? '<span class="badge badge-success badge-pill">'+data+'</span>' : '<span class="badge badge-danger badge-pill">'+data+'</span>';
                }
            },
            { 
                "data": "bagrut_grade",
                "render": function ( data, type, row, meta )
                {
                    return data >= 55 ? '<span class="badge badge-success badge-pill">'+data+'</span>' : '<span class="badge badge-danger badge-pill">'+data+'</span>';
                }
            },
            { 
                "data": "project_grade",
                "render": function ( data, type, row, meta )
                {
                    if(row.has_project)
                    {
                        return data >= 55 ? '<span class="badge badge-success badge-pill">'+data+'</span>' : '<span class="badge badge-danger badge-pill">'+data+'</span>';
                    }
                    return 'ללא עבודה';
                }
            },
            { 
                "data": "final_grade",
                "render": function ( data, type, row, meta )
                {
                    if(data != '' && data != null)
                    {
                        return data >= 55 ? '<span class="badge badge-success badge-pill">'+data+'</span>' : '<span class="badge badge-danger badge-pill">'+data+'</span>';
                    }
                    return 'לא צוין';
                }
            },
            { "data": "note" },
        ],
        columnDefs: [ { orderable: false, targets: [ 4 ] } ],
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false,
        paginate: true,
        lengthChange: false,
        language: {
            "lengthMenu": "מציג _MENU_ מבחנים לכל עמוד",
            "zeroRecords": "לא נמצאו מבחנים",
            "info": "",
            "infoEmpty": "אין מבחנים",
            "infoFiltered": "(נמצאו _TOTAL_ מבחנים)",
            "search": "חיפוש חופשי: ",
            "paginate": {
                "first": "הראשון",
                "last": "האחרון",
                "next": "הבא",
                "previous": "הקודם"
            },
            "processing": "טוען מבחנים...",
            "decimal": ".",
            "thousands": ","
        },
        createdRow: function (row, data) {
            $(row).find("td").addClass('text-center');
        }
    });
    $('.dataTables_filter').addClass('float-left');

    var div = $("#bagrutsTable_wrapper").find(".row:first div.col-sm-12.col-md-6:first");
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
    
            var tableDate = moment(data[4], 'YYYY-MM-DD');

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

    $('#bagrutsTable').dataTable().api().column(2).search('', true, false).draw();
});


</script>