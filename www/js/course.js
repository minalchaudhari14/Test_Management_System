$(document).ready(function () {
    getCourseData();
});
function getCourseData(){
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
                    "url": 'CourseController/fetchDatafromDatabase'
                },
               "fnDrawCallback": function() {
                jQuery('#example #kv-toggle-demo').bootstrapToggle();           
                },    
              
            });  
}
function insertCourse()
{
     $('#courseid').val('');
     $('#coursecode').val('');
     $('#coursename').val('');
     $('#addCorse').modal('show');
}
function addSubject(courseId)
{
    $('#courseId').val(courseId);
    $('#addSubject').modal('show');
    
}

function addBatch(courseId,assessmentID)
{
    $('#courseId').val(courseId);
    $('#assessmentID').val(assessmentID);
    $('#addBatch').modal('show');  
}

function addBatchMap(elem)
{
           var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray()
            $.each(params, function (i, val) {
                data.append(params[i].name, $.trim(val.value));
                
            });
               var cid=$('input[name=courseId]').val();
              data.append('batchselect', $("#batch_select").val());
              data.append('cid',cid);             
           $.ajax({
        method: 'POST',
        url: baseurl + 'mapbatch',
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        dataType: 'JSON',
 
    });
}

function addSubjectMap(elem)
{
           var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray()
            $.each(params, function (i, val) {
                data.append(params[i].name, $.trim(val.value));         
            });
              var cid=$('input[name=courseId]').val();
              data.append('languageselect', $("#Language_select").val());
              data.append('cid',cid);           
            $.ajax({
                method: 'POST',
                url: baseurl + 'mapsubject',
                cache: false,
                processData: false,
                contentType: false,
                data: data,
                dataType: 'JSON',
                 
    });
}

function validation(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));
    });
    if (data.get('coursecode') == '')
        errors.push("Please Enter Course Code!");

    if (data.get('coursename') == '')
        errors.push("Please Enter Course Name!");

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
            url: baseurl + 'coursevalidation',
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

function EditCourse(courseid) {
//    var formdata = $('#addCorse').serialize();
    $.ajax({
        url: baseurl + 'add/' + courseid,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, value) {
                console.log(value.course_code);
                $('#addCorse').appendTo("body").modal('show');
                $('#courseid').val(courseid);
                $("input[name='coursecode']").val(value.course_code);
                $("input[name='coursename']").val(value.course_name);  
                
            });
        }
        
    });
         
}

function refresh()
{
        var dt=$("#example").DataTable();
        dt.ajax.reload(null,false);
}

function deleteCourse(courseid)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + 'itemsDelete/' + courseid,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#addCorse').modal('hide');
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
        url: baseurl +'coursechangestatusroute',
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


