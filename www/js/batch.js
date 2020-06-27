$(document).ready(function () {
    getBatchData();
});
function getBatchData()
{
    var table = $('#table1').DataTable(
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
                    "url": 'BatchController/fetchbatchdata',
                    "data": function (data) {
                      data.assessment_year = $('#assesmentid').val();
                    }
                },
                "fnDrawCallback": function () {
                    jQuery('#table1 #kv-toggle-demo').bootstrapToggle();
                            },
                        });
                $('#assesmentid').change(function (){
                    table.draw();
                });
 }

function addBatch()
{
    $('#batchid').val('');
    $('#batchcode').val('');
    $('#batchname').val('');
    $('#batchstrength').val('');
    $('#assessmentyear').val('');
    $('#addBatch').modal('show');
}

function insertbatch(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
           $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));
    });

    if (errors.length > 0)
    {
        bootbox.alert(
                {
                    message: errors.join("<br>"),
                    centerVertical: true,

                });
        return false;
    }
    $.ajax({
        method: 'POST',
        url: baseurl + 'batchvalidation',
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        dataType: 'JSON',
        success: function (response)
        {
            refresh();
            $('#createForm')[0].reset();
        }
    });
}

function EditBatch(batchid) {
//    var formdata = $('#addCorse').serialize();
    $.ajax({
        url: baseurl + 'addbatch/' + batchid,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, value) {
                console.log(value.course_code);
                $('#addBatch').appendTo("body").modal('show');
                $('#batchid').val(batchid);
                $("input[name='batchcode']").val(value.batch_code);
                $("input[name='batchname']").val(value.batch_name);
                $("input[name='batchstrength']").val(value.max_strength);
                $('[name=assessmentyear]').val( value.assessment_year_id );
            });
        }
    });
}
function refresh()
{
    var dt = $("#table1").DataTable();
    dt.ajax.reload(null, false);
}
function deleteBatch(batchid)
{
    if (confirm('Are you sure delete this data?'))
    {
        $.ajax({
            url: baseurl + 'batchDelete/' + batchid,
            type: "POST",
            dataType: "JSON",
            success: function (data)
            {
                refresh();
            },
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
        url: baseurl + 'batchchangestatusroute',
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


