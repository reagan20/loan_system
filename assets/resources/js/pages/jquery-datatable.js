$(function () {
    $('.datatable').DataTable();
    $('.dataTables_filter input').addClass("dataTable_search");

    $('.datatable2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

});