<script>


$(document).ready(function()
{
    jQuery('#teachersTable').dataTable({
        ajax: "/api/studentscontact_json",
        responsive: true,
        cache: true,
        columns: [
            { 
                "data": "avatar",
                "render": function ( data, type, row, meta ) {
                    return '<img class="img-avatar img-avatar48" src="' + window.location.origin + '/assets/img/avatars/' + data + '" alt="">';
                }
             },
            { "data": "id" },
            { 
                "data": "details.firstName",
                "render": function ( data, type, row, meta ) {
                    var json_parsed = JSON.parse(row.details);
                    var full_name = json_parsed.lastName + ' ' + json_parsed.firstName;
                    
                    return full_name;
                }
            },
            { 
                "data": "details.gender",
                "render": function ( data, type, row, meta ) {
                    var json_parsed = JSON.parse(row.details);
                    var gender = json_parsed.gender ? 'זכר' : 'נקבה';
                    return gender;
                }
            },
            { "data": "email" },
            { 
                "data": "details.phoneNumber",
                "render": function ( data, type, row, meta ) {
                    var json_parsed = JSON.parse(row.details);
                    return '<span class="badge badge-primary">' + json_parsed.phoneNumber + '</span>';
                }
            }
        ],
        columnDefs: [ { orderable: false, targets: [ 4 ] } ],
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false,
        paginate: false,
        lengthChange: false,
        language: {
            "lengthMenu": "מציג _MENU_ תלמידים לכל עמוד",
            "zeroRecords": "לא נמצאו תלמידים",
            "info": "",
            "infoEmpty": "אין תלמידים",
            "infoFiltered": "(נמצאו _TOTAL_ תלמידים)",
            "search": "חיפוש חופשי: ",
            "paginate": {
                "first": "הראשון",
                "last": "האחרון",
                "next": "הבא",
                "previous": "הקודם"
            },
            "processing": "טוען תלמידים...",
            "decimal": ".",
            "thousands": ","
        },
        createdRow: function (row, data) {
            $(row).find("td").addClass('text-center');
        }
    });
    $('.dataTables_filter').addClass('float-left');
});
</script>