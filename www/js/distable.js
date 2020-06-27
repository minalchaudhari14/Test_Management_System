

$(document).ready(function () {
    QuesBank();
    
});
function refresh()
{
var dt = $("#Questiontable").DataTable();
dt.ajax.reload(null, false);
}
function  QuesBank()
{
    var table = $('#Questiontable').DataTable(
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
                "order": [[0, " asc"]],

                "destroy": true,
                "processing": true,
                'serverSide': true,
                'serverMethod': 'post',
                "ajax": {
                    "url": baseurl + 'QuesBankController/QuesBank1',

                    "data": function (data) {
                        data.subject_name = $('#subjectname').val();
                         data.difficulty_level_name = $('#typeoflevel').val();
                           data.description = $('#typeofque').val();
                    }
                }
            });

    $('#subjectname,#typeoflevel,#typeofque').change(function () {
        table.draw();
    });

}

function deleteQuestion(Questionid)
{
    if(confirm('Are you sure delete this data?'))
    {
        $.ajax({
            url : baseurl + 'delete/' + Questionid,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
              
                refresh();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
   }  

