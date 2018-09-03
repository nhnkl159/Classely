/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */

var BeTableDatatables = function() {
    // Override a few DataTable defaults, for more examples you can check out https://www.datatables.net/
    var exDataTable = function() {
        jQuery.extend( jQuery.fn.dataTable.ext.classes, {
            sWrapper: "dataTables_wrapper dt-bootstrap4"
        });
    };

    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        jQuery('.js-dataTable-full').dataTable({
            columnDefs: [ { orderable: false, targets: [ 4 ] } ],
            pageLength: 8,
            lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
            autoWidth: false,
            "lengthChange": false,
            "language": {
                "lengthMenu": "מציג _MENU_ רשומות לכל עמוד",
                "zeroRecords": "לא נמצאו רשומות",
                "info": "דף _PAGE_ מתוך _PAGES_",
                "infoEmpty": "אין מידע",
                "infoFiltered": "(נמצאו _TOTAL_ תוצאות)",
                "search": "חיפוש חופשי: ",
                "paginate": {
                    "first": "הראשון",
                    "last": "האחרון",
                    "next": "הבא",
                    "previous": "הקודם"
                },
                "processing": "טוען נכסים...",
                "decimal": ".",
                "thousands": ","
            }
        });
    };

    // Init full extra DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFullPagination = function() {
        jQuery('.js-dataTable-full-pagination').dataTable({
            pagingType: "full_numbers",
            columnDefs: [ { orderable: false, targets: [ 4 ] } ],
            pageLength: 8,
            lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
            autoWidth: false
        });
    };

    // Init simple DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableSimple = function() {
        jQuery('.js-dataTable-simple').dataTable({
            columnDefs: [ { orderable: false, targets: [ 4 ] } ],
            pageLength: 8,
            lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
            autoWidth: false,
            searching: false,
            oLanguage: {
                sLengthMenu: ""
            },
            dom: "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>"
        });
    };

    return {
        init: function() {
            // Override a few DataTable defaults
            exDataTable();

            // Init Datatables
            initDataTableSimple();
            initDataTableFull();
            initDataTableFullPagination();
            $('.dataTables_filter').addClass('float-left');
        }
    };
}();

// Initialize when page loads
jQuery(function(){ BeTableDatatables.init(); });