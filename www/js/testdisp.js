$(document).ready(function () {
    PublishTest();
});

function PublishTest()
{
    $('#publishque').DataTable(
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
                    "url": baseurl + 'PublishTestController/Publishque'

                }
            });

}

//*************************Code For Insert Data *****************
function displayTest(elem)
{
    var closestform = $(elem).closest('form'),
    data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));
    });
//    var test_id = "";
    var lastInsertId = "";
    var testCreation = JSON.parse(localStorage.getItem('test_creation'));
    $.each(testCreation, function (key, value) {
        lastInsertId = value['lastInsertId']; 
//        test_id = value['test_id']; 
    });

    data.append('lastInsertId', lastInsertId);

    if (data.get('sdate') == '')
        errors.push("Please Select Date!");

    if (data.get('edate') == '')
        errors.push("Please Select End Date");

    if (data.get('stime') == '')
        errors.push("Please Select Starts Time");

    if (data.get('etime') == '')
        errors.push("Please Select End Time");

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
        url: baseurl + 'publish',
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        dataType: 'JSON',
        success: function (response)
        {
            if (response.success)
            {
                bootbox.alert({
                    message: response.statusMsg,
                    callback: function () {
                        window.location.href = 'assigntestroute';
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
