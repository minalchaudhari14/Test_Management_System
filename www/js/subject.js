$(document).ready(function () {
   getSubjectData();   
});

function getSubjectData()
{ 
    $('#table2').DataTable(
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
                    "url": 'SubjectController/fetchsubjectdata'
                },
                 "fnDrawCallback": function() {
            jQuery('#table2 #kv-toggle-demo').bootstrapToggle();
        }
     });
}
function insertModel()
{
    $('#subject_id').val('');
    $('#subjectcode').val('');
    $('#subjectname').val('');
    $('#addSubject').modal('show');
      
}

function insertsubject(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));

    });

    if (data.get('subjectcode') == '')
        errors.push("Please Enter Subject Code!");

    if (data.get('subjectname') == '')
        errors.push("Please Enter Subject Name!");
     
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
        url: baseurl + 'subjectvalidation',
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

function EditSubject(subjectid) {
//    var formdata = $('#addCorse').serialize();
    $.ajax({
        url: baseurl + 'addsubject/' + subjectid,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, value) {
                console.log(value.course_code);
                $('#addSubject').appendTo("body").modal('show');
                $('#subjectid').val(subjectid);
                $("input[name='subjectcode']").val(value.subject_code);
                $("input[name='subjectname']").val(value.subject_name);

            });
        }
    });
}
function refresh()
{
        var dt=$("#table2").DataTable();
        dt.ajax.reload(null,false);
}
function deleteSubject(subjectid)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + 'subjectDelete/' + subjectid,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#addSubject').modal('hide');
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
     data.append('id',id);
     data.append('status',changeStatusValue);
    $.ajax({
        url: baseurl +'subchangestatusroute',
        type: "Post",
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        success: function ()
        {
          // getCourseData();
             refresh();
        },
    });
       
}



  



