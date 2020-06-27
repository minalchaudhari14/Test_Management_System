$(document).ready(function(){
StudDocument();
});
function StudDocument(){
var sid = $("#student_id").val();
$('#exampledocument').DataTable({
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
data : {'sid' : sid},
url: baseurl + 'StudDocController/getStudentDocData'
}
});
}

function studDocValid(elem)
{
var closestform = $(elem).closest('form'),
data = new FormData(),
params = $(closestform).serializeArray(),
errors = new Array();
documentImage = $('#student_document_path').prop('files')[0];
$.each(params, function (i, val) {
data.append(params[i].name, $.trim(val.value));
});
data.append('document', documentImage);

if(data.get('stud_doc_name')=='')
errors.push("Please enter the Student Document!");

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
url:baseurl + 'StudDocPageController/studDocValid',
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
centerVertical: true,
});
//window.location.href = baseurl + 'Add/';
$('#adddoc')[0].reset();
}
else
{
bootbox.alert({
message: "not inserted",
centerVertical: true
});
}
}
});
}
function refreshdoc()
{
var dt=$("#exampledocument").DataTable();
dt.ajax.reload(null,false);
}

