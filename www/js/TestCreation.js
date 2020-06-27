$(document).ready(function () {
    TestCreation();
});

function refresh()
{
    var dt = $("#example").DataTable();
    dt.ajax.reload(null, false);
}

function TestCreation()
{
    $('#example').DataTable(
            {
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, 100, 200],
                    [10, 25, 50, 100, 200]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                "iDisplayLength": 10,
                "order": [[0, "asc"]],
                "destroy": true,
                "processing": true,
                'serverSide': true,
                'serverMethod': 'post',
                "ajax": {
                    "url": baseurl + 'TestCreationController/Test'

                },
                "fnDrawCallback": function () {
                    jQuery('#example #kv-toggle-demo').bootstrapToggle();
                }
            });
}
function deleteTest(test_id){
    if(confirm('Are you sure want to delete ?'))
    {
        $.ajax({
            url : baseurl + 'delete-test/' + test_id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               refresh();
            },
             error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
            
        });
    }
}
function changeStatus(id, status)
{
    var data = new FormData();
    var changeStatusValue = (status == 1) ? 0 : 1;
    data.append('id', id);
    data.append('status', changeStatusValue);
    $.ajax({
        url: baseurl + 'changestatus',
        type: "Post",
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        success: function ()
        {
            refresh();
        }
    });

}



