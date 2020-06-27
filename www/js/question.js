function updateDataTableSelectAllCtrl(table) {
    var $table = table.table().node();
    var $chkbox_all = $('tbody input[type="checkbox"]', $table);
    var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
    var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);
// If none of the checkboxes are checked
    if ($chkbox_checked.length === 0) {
        chkbox_select_all.checked = false;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }

// If all of the checkboxes are checked
    } else if ($chkbox_checked.length === $chkbox_all.length) {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }

// If some of the checkboxes are checked
    } else {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = true;
        }
    }
}


//*************Code for Add Question to set************************
$(document).ready(function () {
    addQuesSet();

    $("#addquesset").click(function () {
        addSetToLocalStorage();
    })

});
function addQuesSet() {
    var rows_selected = [];
    var table = $('#example1').DataTable({
        "destroy": true,
        "processing": true,
        'serverSide': true,

        'serverMethod': 'post',
        "ajax": {
            "url": baseurl + 'AddQuesController/getQuestion',
            'data': function (data) {
                data.difficulty_level_name = $('#selectLevel').val();
            }

        },
        'columnDefs': [
            {
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'width': '1%',
                'className': 'dt-body-center'

            }
        ],
        'select': {
            'style': 'multi'
        },
        responsive: true,
        'order': [[1, 'asc']],
        'rowCallback': function (row, data, dataIndex) {
// Get row ID
            var rowId = data[0];
// If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });
    table.on('click', 'tbody tr', function () {
        $(this).toggleClass('selected');
    });
    $('#selectLevel').change(function () {
        table.draw();
    });
    $('#example1 tbody').on('click', 'input[type="checkbox"]', function (e) {
        var $row = $(this).closest('tr');
// Get row data
        var data = table.row($row).data();
// Get row ID
        var rowId = data[0];
// Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
// If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);
// Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }

        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }

// Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
// Prevent click event from propagating to parent
        e.stopPropagation();
    });
// Handle click on table cells with checkboxes
    $('#example1').on('click', 'tbody td, thead th:first-child', function (e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
// Handle click on "Select all" control
    $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
        if (this.checked) {
            $('#example1 tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#example1 tbody input[type="checkbox"]:checked').trigger('click');
        }
// Prevent click event from propagating to parent
        e.stopPropagation();
    });
// Handle table draw event
    table.on('draw', function () {
// Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });
}

//*******************Code For Insert Data from question_set***************************
function AddSet(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));
    });

    var question_id = "";
    var questionID = [];
    var qset = JSON.parse(localStorage.getItem('qset'));
    $.each(qset, function (key, value) {
        question_id = JSON.parse(value['question_id']);
        for (var i = 0; i < question_id.length; i++) {
            questionID.push(parseInt(question_id[i]));
        }
    });
    var uniqueID = [];
    $.each(questionID, function (i, el) {
        if ($.inArray(el, uniqueID) === -1)
            uniqueID.push(el);
    })

    data.append('question_id', uniqueID);

    if (uniqueID.length != data.get('totalques')) {
        errors.push("Please Select " + data.get('totalques') + "Questions ");
    }
    if (data.get('qset_code') == '')
        errors.push("Please Enter Question Set Code!");
    if (data.get('totalques') == '')
        errors.push("Please Enter Total no of Questions!");
    if (data.get('course_id') == '')
        errors.push("Please select Course!");

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
        url: baseurl + 'Quesset',
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        dataType: 'JSON',
        success: function (response)
        {
            if (response.success)
            {
                localStorage.clear();
                bootbox.alert({
                    message: response.statusMsg,
                    callback: function () {
                        window.location.href = 'Qsetroute';
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

//*****************************Code for localstorage*****************
function addSetToLocalStorage() {
    var errors = new Array();
    var selectcourse = $('#selectcourse')[0];
    var qset_code = $('#qset_code')[0];
    var totalques = $('#totalques')[0];

    var checkedCheckboxes = [];
    $("input[name='question_id[]']:checked").map(function () {
        checkedCheckboxes.push($(this).val());
    })

    var qset = new Array();
    var obj;
    if ($('#qset_code').val() == '')
        errors.push("Please Enter Question Set Code!");
    if ($('#totalques').val() == '')
        errors.push("Please Enter Total no of Questions!");
    if ($('#selectcourse').val() == '')
        errors.push("Please select Course!");

    if (errors.length > 0)
    {
        bootbox.alert({
            message: errors.join("<br>"),
            centerVertical: true,
        });
        return false;
    }
    obj = {};
// obj.selectcourse = selectcourse.value;
// obj.qset_code = qset_code.value;
// obj.totalques = totalques.value;
    obj.question_id = ('question_id', JSON.stringify(checkedCheckboxes));

    qset = JSON.parse(localStorage.getItem('qset')) || [];
    qset.push(obj);

    localStorage.setItem('qset', JSON.stringify(qset));

    var questionID = [];
    $.each(qset, function (key, value) {
        var questionIds = JSON.parse(value['question_id']);
        for (var i = 0; i < questionIds.length; i++) {
            questionID.push(parseInt(questionIds[i]));
        }
    });

    var uniqueID = [];
    $.each(questionID, function (i, el) {
        if ($.inArray(el, uniqueID) === -1)
            uniqueID.push(el);
    })

    console.log(uniqueID);

    selques(uniqueID);
}

function removeIdfromlocal(question_id) {

// $(elem).parents().parents().remove();
    var qset = new Array();
    qset = JSON.parse(localStorage.getItem('qset')) || [];
    var questionID = [];
    $.each(qset, function (key, value) {
        var questionIds = JSON.parse(value['question_id']);
        for (var i = 0; i < questionIds.length; i++) {
            questionID.push(questionIds[i]);
        }
    });
    var uniqueID = [];
    $.each(questionID, function (i, el) {
        if ($.inArray(el, uniqueID) === -1)
            uniqueID.push(el);
    })
    localStorage.clear();
    obj = {};
    for (var i in uniqueID) {
        if (parseInt(uniqueID[i]) == question_id) {
            uniqueID.splice(i, 1);
            qset = [];
            obj.question_id = ('question_id', JSON.stringify(uniqueID));
            qset.push(obj);
        }
    }
    localStorage.setItem('qset', JSON.stringify(qset));
    selques(uniqueID);
    console.log(uniqueID);
}
function selques(uniqueID)
{
    var selectedques = $('#select').DataTable(
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
                traditional: true,
                'serverSide': true,
                'serverMethod': 'post',
                "ajax": {
                    "url": baseurl + 'AddQuesController/selectedQuestion',
                    "data": {question_id: JSON.stringify(uniqueID)}
                }
            });
}