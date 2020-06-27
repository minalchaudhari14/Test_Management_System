$(document).ready(function () {
    StudDatatableInfo();
});

function StudDatatableInfo() {
    var table = $('#studentDataTable').DataTable({
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
            url: baseurl + 'StudDatatableController/getStudentData',
            "data": function (data) {
                data.assessment_year = $('#assesmentid').val();
            }
        },
            "fnDrawCallback": function() {
                jQuery('#studentDataTable #kv-toggle-demo').bootstrapToggle();           
                },      
    });
    $('#assesmentid').change(function () {
        table.draw();
    });
}

function Validstudent(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    input = document.getElementById('file');
    profileImage = $('#student_photo').prop('files')[0];
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));
    });
    data.append('image', profileImage);

    if (data.get('email') == '')
        errors.push("Please Enter EmailID!");

    if (data.get('student_id') === '') {
        if (data.get('password') == '')
            errors.push("Please Enter password!");
    }

    if (data.get('student_first_name') == '')
        errors.push("Please Enter Student First Name!");

    if (data.get('student_last_name') == '')
        errors.push("Please Enter Student Last Name!");

    if (data.get('dob') == '')
        errors.push("Please Enter Date Of Birth!");

    if (data.get('date_of_reg') == '')
        errors.push("Please Enter Date Of Registration");

    if (data.get('mobile_no') == '')
        errors.push("Please Enter Mobile Number!");

    if (data.get('aadhar_card_no') == '')
        errors.push("Please Enter Aadhar Card No");


    if ($('#email').val() == '') {
        $('#email').css('border-color', 'red');
    } else {
        $('#email').css('border-color', '');
    }

    if ($('#password').val() == '') {
        $('#password').css('border-color', 'red');
    } else {
        $('#password').css('border-color', '');
    }

    if ($('#student_first_name').val() == '') {
        $('#student_first_name').css('border-color', 'red');
    } else {
        $('#student_first_name').css('border-color', '');
    }

    if ($('#student_last_name').val() == '') {
        $('#student_last_name').css('border-color', 'red');
    } else {
        $('#student_last_name').css('border-color', '');
    }

    if ($('#date1').val() == '') {
        $('#date1').css('border-color', 'red');
    } else {
        $('#date1').css('border-color', '');
    }

    if ($('#date2').val() == '') {
        $('#date2').css('border-color', 'red');
    } else {
        $('#date2').css('border-color', '');
    }

    if ($('#mobile_no').val() == '') {
        $('#mobile_no').css('border-color', 'red');
    } else {
        $('#mobile_no').css('border-color', '');
    }

    if ($('#aadhar_card_no').val() == '') {
        $('#aadhar_card_no').css('border-color', 'red');
    } else {
        $('#aadhar_card_no').css('border-color', '');
    }

    if ($('#assessment_year').val() == '') {
        $('#assessment_year').css('border-color', 'red');
    } else {
        $('#assessment_year').css('border-color', '');
    }


    if (errors.length > 0)
    {
        bootbox.alert({
            message: errors.join("<br>"),
            centerVertical: true,

        });
        return false;
    }

    $.ajax({
        method: 'POST',
        url: baseurl + 'validation',
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        dataType: 'JSON',
        success: function (response)
        {
            if (response.success) {
                bootbox.alert({
                    message: response.statusMsg,
                    centerVertical: true,
                });
                window.location.href = baseurl + 'studdatatableroute';
            } else {
                bootbox.alert({
                    message: response.statusMsg,
                    centerVertical: true
                });
            }
        }
    });
}

function clickbackdoc()
{
    window.location.href = 'studdocroute';
}

function changeStudentStatus(id, status)
{
    var data = new FormData();
    var changeStatusValue = (status == 1) ? 0 : 1;
    data.append('id', id);
    data.append('status', changeStatusValue);
    $.ajax({
        url: baseurl + 'changeStudStatus',
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

function refresh()
{
    var dt = $("#studentDataTable").DataTable();
    dt.ajax.reload(null, false);
}
function addStudentBatch(studentId)
{
    $('#studentId').val(studentId);
    $('#addBatch').modal('show');

}
function addStudentBatchMap(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray()
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));

    });
    var cid = $('input[name=studentId]').val();
    data.append('batchselect', $("#batch_select").val());
    data.append('cid', cid);
    $.ajax({
        method: 'POST',
        url: baseurl + 'mapstudentbatch',
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        dataType: 'JSON',

    });
}