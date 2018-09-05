<script>
jQuery.datetimepicker.setLocale('he');

$(document).ready(function()
{
    
    jQuery('#behaviorTable').dataTable({
        ajax: "/api/behaviour_json",
        responsive: true,
        cache: true,
        columns: [
            { "data": "behaviour_name" },
            { "data": "behav_date" },
            { 
                "data": "is_justified",
                "render": function ( data, type, row, meta ) {
                    return data == 1 ? 'כן' : 'לא';
                }
            },
            { "data": "justified_note" },
            { "data": "note" },
        ],
        columnDefs: [ { orderable: false, targets: [ 4 ] } ],
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false,
        paginate: true,
        lengthChange: false,
        language: {
            "lengthMenu": "מציג _MENU_ אירועים לכל עמוד",
            "zeroRecords": "לא נמצאו אירועים",
            "info": "",
            "infoEmpty": "אין אירועים",
            "infoFiltered": "(נמצאו _TOTAL_ אירועים)",
            "search": "חיפוש חופשי: ",
            "paginate": {
                "first": "הראשון",
                "last": "האחרון",
                "next": "הבא",
                "previous": "הקודם"
            },
            "processing": "טוען אירועים...",
            "decimal": ".",
            "thousands": ","
        },
        createdRow: function (row, data) {
            $(row).find("td").addClass('text-center');
        }
    });
    $('.dataTables_filter').addClass('float-left');

    var div = $("#behaviorTable_wrapper").find(".row:first div.col-sm-12.col-md-6:first");
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

    $.getJSON( "/api/behavior_chart/")
    .done(function( data ) {
        var ctx1 = $("#behaviorchart");
        ctx1.height(250);
        var data1 = {
        labels: Object.keys(data.data),
        datasets: [
                {
                    label: "statistics",
                    data: Object.values(data.data),
                    backgroundColor: [
                        "#e8b35e",
                        "#84f5d0",
                        "#ef978e",
                        "#92caef",
                        "#dea0f7"
                    ],
                    borderColor: [
                        "#e8b35e",
                        "#84f5d0",
                        "#ef978e",
                        "#92caef",
                        "#dea0f7"
                    ],
                    borderWidth: [1, 1, 1, 1, 1]
                }
            ]
        };
        var options = {
            responsive:true,
            maintainAspectRatio: false,
            title: {
                display: true,
                position: "top",
                text: "סטטיסטיקה כללית",
                fontSize: 18,
                fontColor: "#111"
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    fontColor: "#333",
                    fontSize: 16
                }
            }
        };

        var behaviorchart = new Chart(ctx1, {
            type: "pie",
            data: data1,
            options: options
        });

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
    
            var tableDate = moment(data[1], 'YYYY-MM-DD');

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

    $('#behaviorTable').dataTable().api().column(2).search('', true, false).draw();
});


</script>