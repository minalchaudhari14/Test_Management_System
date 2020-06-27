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

$(document).ready(function () {
    var rows_selected = [];
    var table = $('#assignform').DataTable({
        "destroy": true,
        "processing": true,
        'serverSide': true,
        'serverMethod': 'post',
        "ajax": {
            "url": baseurl + 'AssignTestController/getAssign'

        },
        'columnDefs': [
            {
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'width': '1%',

                'className': 'dt-body-center'

            }],

        'select': {
            'style': 'multi'
        },
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

    $('#assignform tbody').on('click', 'input[type="checkbox"]', function (e) {
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
    $('#assignform').on('click', 'tbody td, thead th:first-child', function (e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });

    // Handle click on "Select all" control
    $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
        if (this.checked) {
            $('#assignform tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#assignform tbody input[type="checkbox"]:checked').trigger('click');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

    // Handle table draw event
    table.on('draw', function () {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });

});

//*************************Code for Asign Test Insert**************
function InsertAssignData(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));

    });
    
    var checkedCheckboxes = [];
    $("input[name='batch_id[]']:checked").each(function () {
        checkedCheckboxes.push($(this).val());
    });
    data.append('batch_id', JSON.stringify(checkedCheckboxes));

    var lastInsertId = "";
    var publish = JSON.parse(localStorage.getItem('publish'));
    $.each(publish, function (key, value) {
        lastInsertId = value['lastInsertId'];
    });
    var test_id = "";
     var test_creation = JSON.parse(localStorage.getItem('test_creation'));
    $.each(test_creation, function (key, value) {
        test_id = value['test_id']; 
    });
    data.append('test_id', test_id);
    data.append('lastInsertId', lastInsertId);
    
    var fields = $("input[name='batch_id[]']:checked")
    if (fields.length == 0)
        errors.push("Please select Atleast one checkbox For Assign Test!");
    
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
        url: baseurl + 'InsertAssign',
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
                        window.location.href = baseurl + 'testcreationroute';
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


