function dashboardcheck()
{
    $.ajax({
        url: baseurl+"admininfo" ,
        method:"POST",
        dataType:"json",
        success:function(){
                $.each(data, function (index, value) {
                console.log(value.course_code);
                $("#pname").html(value.student_first_name);
//                $("#pmob").html(value.mobile_no);
                $("#pemail").html(value.email);       
               
        });           
        }
    })
}


