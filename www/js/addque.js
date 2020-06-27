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
//Select radio button value display on textbox
function insertData(txt) {
    var e = document.getElementsByTagName('input');

    for (var i = 0; i < e.length; i++) {
        if (e[i].name == 'Answer') {
            e[i].value = txt;
        }
    }
}


function addque(elem)
{
    var closestform = $(elem).closest('form'),
            data = new FormData(),
            params = $(closestform).serializeArray(),
            errors = new Array();
    $.each(params, function (i, val) {
        data.append(params[i].name, $.trim(val.value));
    });

//This is for validation
    if (data.get('Question') == '')
        errors.push("Please Enter Question!");
    if (data.get('option1[]') == '')
        errors.push("Please Enter The Option!");
   if (data.get('matchpair') == '')
        errors.push("Please Enter Match Pair!");
    if (data.get('Answer') == '')
        errors.push("Please Enter Correct Answer!");
    if (data.get('Sequence') == '')
        errors.push("Please Enter Correct Sequence!");

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

//Store option in json array in one field
    option_data = new Array();

    var arry2 = {};
    var arr2 = [];
    arry2.Option1 = $("input[name='option1[]']").map(function () {
        return $(this).val();
    }).get();
    data.append('option1', JSON.stringify(arr2));

    var arr3 = [];
    arry2.Option2 = $("input[name='option2[]']").map(function () {
        return $(this).val();
    }).get();
    data.append('option2', JSON.stringify(arr3));

    var arr4 = [];
    arry2.Option3 = $("input[name='option3[]']").map(function () {
        return $(this).val();
    }).get();
    data.append('option3', JSON.stringify(arr4));

    var arr5 = [];
    arry2.Option4 = $("input[name='option4[]']").map(function () {
        return $(this).val();
    }).get();
    data.append('option4', JSON.stringify(arr5));
    option_data.push(arry2);

    data.append('option_data', JSON.stringify(option_data));

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
        url: baseurl + 'multiplechroute1',
        method: "POST",
        cache: false,
        processData: false,
        contentType: false,
        data: data,
        dataType: 'json',
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
                        } else {
                            bootbox.alert({
                                message: response.statusMsg,
                                //This is for redirect to datadisplay 
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

