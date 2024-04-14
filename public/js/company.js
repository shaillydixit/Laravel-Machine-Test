$(document).ready(function () {
    $('#logo').change(function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
$(document).ready(function () {
    datatable = $("#datatable").dataTable({
        bAutoWidth: false,
        bFilter: true,
        bStateSave: true,
        bSort: true,
        bProcessing: true,
        bServerSide: true,

        oLanguage: {
            sLengthMenu: "_MENU_",
            sInfoFiltered: "",
            sProcessing: "Loading ...",
            sEmptyTable: "NO DATA ADDED YET !",
        },
        aLengthMenu: [
            [-1, 10, 20, 30, 50],
            ["All", 10, 20, 30, 50],
        ],
        iDisplayLength: 10,
        sAjaxSource: httpPath + "companies/show",
        fnServerParams: function (aoData) {
            aoData.push({
                name: "mode",
                value: "fetch",
            });
        },
        fnDrawCallback: function (oSettings) {
            $('.ttip, [data-toggle="tooltip"]').tooltip();
        },
    });
    $(".dataTables_filter input")
        .addClass("form-control")
        .attr("placeholder", "Search");
    $(".dataTables_length select").addClass("form-control");
});
$(document).ready(function () {
    $('#logo').change(function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});