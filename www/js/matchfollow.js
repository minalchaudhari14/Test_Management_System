//Calling route on dropdown
$(document).ready(function () {
    $('#typeofque ').change(function () {

        if ($(this).val() == 1) {

location.href="multiplechroute";
   } else if ($(this).val() == 2) {
    location.href= "truefalseroute";
           } else if ($(this).val() == 3) {
            location.href = "fillblankroute";
        } else if ($(this).val() == 4) {
            location.href = "sequencetyperoute";
        } else if ($(this).val() == 5) {
            location.href = "matchthefollowroute";
        } else if ($(this).val() == 6) {
            location.href = "multiplech2route";
        }
    });
});

function addmatchpair(elem)
  {
     var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));
    });
//This is for validation
    if (data.get('subject') == '')
        errors.push("Please Select Subject Name!");
    if (data.get('level') == '')
        errors.push("Please Select Difficlty Level!");
    if (data.get('Question') == '')
        errors.push("Please Enter Question!");
    if (data.get('option[]') == '')
        errors.push("Please Enter The Option!");
    if (data.get('matchpair') == '')
        errors.push("Please Enter Match Pair!");
    if (data.get('Answer') == '')
        errors.push("Please Enter Correct Answer!");
    if (data.get('matchpair') == '')
        errors.push("Please Enter Correct Matchpair!");

    if (data.get('Marks') == '')
        errors.push("Please Enter Mark!");
    if (data.get('Time') == '')
        errors.push("Please Enter Time Duration!");
    if (errors.length > 0)
    {
        bootbox.alert(
                {
                    message: errors.join("<br>"),
                    centerVertical: true,

                });
        return false;
    }
    //Store table data in one field
 TableData = new Array();
            $("#matchtable TBODY TR").each(function () {
                var row = $(this);
                var add = {};
                add.Question = row.find("TD").eq(0).find("input").val();
                add.matchpair = row.find("TD").eq(1).find("input").val();
                 add.Answer = row.find("TD").eq(2).find("input").val();
                 TableData.push(add);
            });
            
   //Store correct matchpair in json array in one field
     matchpair_data = new Array();
    var arry1={};
var arr = [];
arry1.CorrectMatchpair=$("input[name='matchpair[]']").map(function () {
 return $(this).val();
    }).get();
data.append('matchpair', JSON.stringify(arr));
matchpair_data.push(arry1);
data.append('matchpair_data', JSON.stringify(matchpair_data));
data.append('TableData', JSON.stringify(TableData));

 var typeoflevel = $("#typeoflevel");
            if (typeoflevel.val() == "") {
                //If the "Please Select" option is selected display error.
                alert("Please Select Difficulty Level!");
                return false;
            }
             var subjectname = $("#subjectname");
            if (subjectname.val() == "") {
                //If the "Please Select" option is selected display error.
                alert("Please Select Subject Name!");
                return false;
            }
            $.ajax({
                type: "POST",
              url: baseurl + 'matchthefollowroute1',
                cache: false,
                processData: false,
                contentType: false,
                data: data,
                dataType: "json",
                //For popup adding more question
                success: function (response)
{
if (response.success)
{
    bootbox.confirm({

          message: "<p style='font-size: 15px; color:black;'>Do You Want To Add More Question<p>",
         buttons: {
               confirm: {
                   label: 'Yes',
                   className: 'btn-success'
               },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'

               }
           },
           callback: function (result) {
                if (result) {
                    location.href = 'selectqueroute';
               }
                 else{


                     
bootbox.alert({
message: response.statusMsg,
   //This is for redirect to datadisplay table
 callback: function (result) {
     location.href = 'quesbankroute';
    }
});

               }  
             }
       });

$('#add')[0].reset();
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
 
