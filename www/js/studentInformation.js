(document).ready(function(){
    var i=1;  

    $('#add').click(function(){  
         i++;  
         $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="contact_name[]" placeholder="Enter your Name" class="form-control name_list" required /></td><td><input type="text" name="contact_no[]" placeholder="Enter your number" class="form-control no_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });

    $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#row'+button_id+'').remove();  
    }); 
});
function reinsert(elem) 
{
        var closestform = $(elem).closest('form'),
        data = new FormData(),
        
        params=$(closestform).serializeArray(),
        errors=new Array();
        $.each(params,function(i,val){
            data.append(params[i].name,$.trim(val.value));
        });  

     
     contact_data = new Array();

        var student_id = $('input[name="student_id"]').val();

        var contactName = document.getElementsByName('contact_name[]');
        var contactNo = document.getElementsByName('contact_no[]');
        
        for(i = 0; i < contactName.length; i++)
        {
            var obj={
                'stud_id' : student_id,
                'contact_name' : contactName[i].value,
                'contact_no' : contactNo[i].value
            };
            contact_data.push(obj);
        }

        data.append('contact_data', JSON.stringify(contact_data));



            $.ajax({  
                url:baseurl+'readd',  
                type:"POST", 
                cache:false,
                processData:false,
                contentType:false, 
                 data:data,
               // data:JSON.stringify(postdata),
                datatype:'json',
                success:function(data)  
                {
                    // i=1;
                    // $('.dynamic-added').remove();
                    // $('#add_name')[0].reset();
                            alert('Record Inserted Successfully.');
                }  
           });

}
