function changePassword() {
    var formdata = $('#changePass_Form').serialize();
    var errors = new Array();
    $.ajax({
        url: baseurl + "resetPasswordController/changePassword",
        type: "POST",
        data: formdata,
        dataType: 'json',
        success: function (data) {
            if(data.error){
                if(data.checkEmail !== ''){
                    errors.push(data.checkEmail);
                }
                if(data.newPassError !== ''){
                    errors.push(data.newPassError);
                }
                if(data.confirmPassError !== ''){
                    errors.push(data.confirmPassError);
                }
            }
            if(errors.length > 0){
                bootbox.alert(
                        {
                            message: "<font style='font-size: 15px; color:black;'>"+ errors.join('') +"</font>",
                            centerVertical: true,
                        });
            }
            if(data.success) {
                 location.href = 'dashroute';            
                 bootbox.alert(
                        {
                            message: "<font style='font-size: 15px; color:black;'>password changed successfully</font>",
                            centerVertical: true,
                        });
            }else{
                    bootbox.alert(
                        {
                            message: "<font style='font-size: 15px; color:black;'>fail</font>",
                            centerVertical: true,
                        });
            }
        }
    });
}