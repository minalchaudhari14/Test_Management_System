$(document).ready(function () {
    $('#typeofque').change(function () {
if ($(this).val() == 1) {
            location.href = "multiplechroute?q="+$(this).val();
        } else if ($(this).val() == 2) {
            location.href = "truefalseroute?q="+$(this).val();
        } else if ($(this).val() == 3) {
            location.href = "fillblankroute?q="+$(this).val();
        } else if ($(this).val() == 4) {
            location.href = "sequencetyperoute?q="+$(this).val();
        } else if ($(this).val() == 5) {
            location.href = "matchthefollowroute?q="+$(this).val();
        } else if ($(this).val() == 6) {
            location.href = "multiplech2route?q="+$(this).val()
        }
    });
});



function insertData(txt) {
    var e = document.getElementsByTagName('input');

    for (var i = 0; i < e.length; i++) {
        if (e[i].name == 'Answer') {
            e[i].value = txt;
        }
    }
}

function addsequencetype(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));
    });

   
    if (data.get('question[]') == '')
        errors.push("Please Enter Question!");
     if (data.get('sequence[]') == '')
        errors.push("Please Enter Random Sequence!");
    if (data.get('option[]') == '')
        errors.push("Please Enter The Option!");
   if (data.get('Answer') == '')
        errors.push("Please Enter Correct Answer!");
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

    
  TableData = new Array();

var arry={};
       var arr1 = [];
 arry.Question = $("input[name='question[]']").map(function () {
  return $(this).val();
    }).get();
data.append('question', JSON.stringify(arr1));
TableData.push(arry);

var arry1={};
var arr = [];
arry1.IncorrectSequence=$("input[name='option[]']").map(function () {
 return $(this).val();
    }).get();
data.append('option', JSON.stringify(arr));
TableData.push(arry1);


data.append('TableData', JSON.stringify(TableData));
//code for sequence
optionData = new Array();
var arry2={};
 var arr2 = [];
arry2.Option1 = $("input[name='sequence[]']").map(function () {
return $(this).val();
    }).get();
data.append('sequence', JSON.stringify(arr2));

var arr3 = [];
arry2.Option2 =$("input[name='sequence1[]']").map(function () {
return $(this).val();
    }).get();
data.append('sequence1', JSON.stringify(arr3));

var arr4 = [];
arry2.Option3 =$("input[name='sequence2[]']").map(function () {
return $(this).val();
    }).get();
data.append('sequence2', JSON.stringify(arr4));

var arr5 = [];
arry2.Option4 =$("input[name='sequence3[]']").map(function () {
return $(this).val();
    }).get();
data.append('sequence3', JSON.stringify(arr5));
 optionData.push(arry2);

data.append('optionData', JSON.stringify(optionData));

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
        url: baseurl + 'sequencetyperoute1',
        method: "POST",
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        dataType: 'json',
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
                        } else {
                            bootbox.alert({
                                message: response.statusMsg,
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

