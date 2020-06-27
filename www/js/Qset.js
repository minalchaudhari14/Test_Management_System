$(document).ready(function () {
    QuestionSet();
});
function refresh()
{
    var dt = $("#QuesSet").DataTable();
    dt.ajax.reload(null, false);
}
function QuestionSet()
{
    $('#QuesSet').DataTable(
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
                    "url": baseurl + 'QsetController/Queset'

                },
                "fnDrawCallback": function () {
                    jQuery('#QuesSet #kv-toggle-demo').bootstrapToggle();
                }


            });

}
//****************Code for Insert Test*******************
function createTest()
{
    errors = new Array();
    postData = new FormData();
    var test_id = "";
    var testName = "";
    var duration = "";
    var totalmark = "";
    var qset_id = $("#qset_id").val();

    var testCreation = JSON.parse(localStorage.getItem('test_creation')) || [];
    $.each(testCreation, function (key, value) {
        test_id = value['test_id'];
        testName = value['test_name'];
        duration = value['duration'];
        totalmark = value['totalmark'];
        selectCourse = value['selectCourse'];

    });

//    qset_id = new Array();
//    var arry2 = {};
//    var arr2 = [];
//    arry2.qset_id = $("input[name='qset_id[]']").map(function () {
//        return $(this).val();
//    }).get();
//    data.append('qset_id', JSON.stringify(arr2));
// qset_id.push(arry2);
//
//    data.append('qset_id', JSON.stringify(qset_id));

    postData.append('test_id', test_id);
    postData.append('testName', testName);
    postData.append('duration', duration);
    postData.append('totalmark', totalmark);
    postData.append('selectCourse', selectCourse);
    postData.append('qset_id', qset_id);

    if (postData.get('qset_id') == '')
        errors.push("Please select Questions Set!");
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
        type: 'POST',
        url: baseurl + 'AddTest',
        cache: false,
        processData: false,
        contentType: false,
        data: postData,
        dataType: 'JSON',
        success: function (response)
        {
            if (response.success)
            {
                var publish = new Array();
                var obj = {};

                obj.qset_id = JSON.stringify(qset_id);
                lastInsertId=obj.lastInsertId = response.lastInsetTestId;
                publish.push(obj);
                localStorage.setItem('publish', JSON.stringify(publish));

                bootbox.alert({
                    message: response.statusMsg,
                    callback: function () {
                        if (test_id) {
                            window.location.href = baseurl + 'edit-publishTest/' + test_id;
                        } else {
                            window.location.href = baseurl + 'edit-publishTest/' + lastInsertId;
                        }
                    }
                });

            } else
            {
                bootbox.alert({
                    message: response.statusMsg,
                    centerVertical: true

                });
            }
        }
    });
}
function deleteQuesset(qset_id) {
    if (confirm('Are you sure want to delete ?'))
    {
        $.ajax({
            url: baseurl + 'delete-set/' + qset_id,
            type: "POST",
            dataType: "JSON",
            success: function (data)
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
        url: baseurl + 'changestatusqset',
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

  