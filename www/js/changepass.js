function changePass() 
{
    var user = $('#changpassid').serialize();
    var errors = new Array();
    event.preventDefault();
    $.ajax({
        url: baseurl + "ChangepassController/updatePwd",
        method: "POST",
        data: user,
        dataType: "json",
        success: function (data)
        {
             $('#changpassid')[0].reset();
            if (data.error) {
                if (data.$curr_password !== '') {
                    errors.push(data.$curr_password);
                }
                if (data.$new_password !== '') {
                    errors.push(data.$new_password);
                }
                if (data.$conf_password !== '') {
                    errors.push(data.$conf_password);
                }
                
            }
            if (errors.length > 0) {
                bootbox.alert(
                        {
                            message: "<font style='font-size: 15px; color:black;'>" + errors.join('') + "</font>",
                            centerVertical: true,
                        });
            }     
             if (data.success) {
                bootbox.alert(
                        {
                            message: "<font style='font-size: 15px; color:black;'>Password Update Succesfully!</font>",
                            centerVertical: true,
                        });
                return false;
            }
            if (data.fail) {
                bootbox.alert(
                        {
                            message: "<font style='font-size: 15px; color:black;'>Sorry!Something Wrong</font>",
                            centerVertical: true,
                        });
                return false;
            }
            
        }
    });
}


