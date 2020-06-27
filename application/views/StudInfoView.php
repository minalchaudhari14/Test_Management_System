<!doctype html>
<html lang="en">
    <head>
        <title>StudentTestManagement</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->load->view('includecss'); ?>
    </head>
    <body>
        <?php
        $user_data = array(
            'title' => 'Student Info'
        );
        ?>
        <div class="wrapper d-flex align-items-stretch">
            <?php
            $this->load->view('sidebar', $user_data);
            ?>
            <?php
            $this->load->view('header', $user_data);
            ?>
        <div class="card">
            <script type="text/javascript">
                $( "#date" ).click(function() {
                    alert($("#date1").datepicker("getDate"));
                    alert($("#date2").datepicker("getDate"));
                });
            </script>     
<body> 
<div class="container">   
    <form action="StudInfoView" method="POST" id="addinfo" name="addinfo">
        <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header" ><h4>Login Detail</h4></div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group ">
                                    <label for='email' style="color: black;" class="control-label">Student Email
                                        <span style="color: red">*</span>
                                    </label>                               
                                    <input type="text" name="email" id="email" placeholder="Enter The Email" class="form-control" value="<?php echo (!empty($StudentInformation->email)) ? $StudentInformation->email:'';?>">
                                </div> 
                                <div class="form-group" style="display: <?php echo (!empty($StudentInformation->password)) ? "none" : "block"; ?>">
                                    <label for='password'style="color: black">Student Password <span style="color: red">*</span></label>
                                    <input type="password" name="password" placeholder="Enter The Password" id="password" class="form-control" id="passwor">
                                </div>
                            </div>
                            <div class="col-md-2">
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="card">           
                <div class="card-header"><h4>Student Image</h4></div>
                <div class="card-body">
                    <div class="row">  
                        <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
                    </div>
                    <div class="row">  
                        <div class="form-group" id="upload_form">
                            <label for="body" >select Image</label>
                            <?php 
                            echo "<input type='file' name='student_photo' size='20' id='student_photo' />";
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card">                     
                <div class="card-header"><strong></strong>Student Detail</strong>
            <div class="pull-right"><a class="btn btn-primary" href="<?php echo base_url('studdatatableroute');?>" style="background-color: orange;">
                                        <i class="fa fa-close"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                            <div class="form-group">
                                <input type="hidden" name="student_id" id="student_id" value="<?php echo(!empty($StudentInformation->student_id)) ? $StudentInformation->student_id:'';?>">  
                            </div>   
                        <div class="col-sm-4">  
                        </div>                           
                        <div class="col-md-4" style="float: right;">
                         <div class="form-group">

                        <select class="form-control select2" id="assessment_year_id" name="assessment_year_id">
                            <option value=''>-- Select Assessment Year --</option>
                            <?php foreach ($assessment_year_id as $row): ?>
                                <option <?php echo(!empty($StudentInformation->assessment_year_id) and $StudentInformation->assessment_year_id == $row['assessment_year_id']) ? 'selected' : '';?> value="<?php echo $row['assessment_year_id']; ?>"><?php echo $row['assessment_year']; ?></option>
                            <?php endforeach ?>
                        </select>
                        </div>  
                    </div>
                        <div class="col-md-8"></div>  
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for='studentfname'style="color: black">Student First Name<span style="color: red">*</span></label>
                                <input type="text" name="student_first_name" placeholder="Enter the  First Name:" id="student_first_name" class="form-control" value="<?php echo(!empty($StudentInformation->student_first_name)) ? $StudentInformation->student_first_name:'';?>" >
                            </div>                        
                        </div>                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for='studentmname'style="color: black">Student Middle Name</span></label>
                                <input type="text" name="student_middle_name"  placeholder="Enter the Middle Name:" class="form-control" value="<?php echo(!empty($StudentInformation->student_middle_name)) ? $StudentInformation->student_middle_name:'';?>" >
                            </div>
                        </div>                    
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="studentlname" style="color: black">Student Last Name<span style="color: red">*</span></label>
                                <input type="text" name="student_last_name" id="student_last_name" placeholder="Enter the Last Name:" class="form-control" value="<?php echo (!empty($StudentInformation->student_last_name)) ? $StudentInformation->student_last_name:'';?>">
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for='dateobirth'style="color: black">DoB<span style="color: red">*</span></label>
                                <input type="date" name="dob"  class="form-control" 
                                id="date1" name="date" value="<?php echo (!empty($StudentInformation->dob)) ? $StudentInformation->dob:'';?>">

                            </div>
                        </div>
                        <div class="col-sm-4">
                             <div class="form">
                                <label>Gender<span style="color: red">*</span></label><br>
                                <input type="radio" name="gender" value="Male" checked value=""> Male
                                <input type="radio" name="gender" value="Female"> Female<br>
                            </div>  
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for='dateofreg' style="color: black">Date Of Registration<span style="color: red">*</span></label>
                                <input type="date" name="date_of_reg" class="form-control" id="date2" name="date" value="<?php echo (!empty($StudentInformation->date_of_reg)) ? $StudentInformation->date_of_reg:'';?>">
                            </div>
                        </div>  
                    </div>                                 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobileno" id="mobileno" style="color: black">Mobile No<span style="color: red">*</span></label>
                                <input type="text" name="mobile_no" id="mobile_no" placeholder="Enter the Mobile No:" class="form-control" maxlength="10" value="<?php echo (!empty($StudentInformation->mobile_no)) ? $StudentInformation->mobile_no:'';?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for='alternatemno'style="color: black">Alternate Mobile No</label>
                                <input type="text" name="alternate_mobile_no" placeholder="Enter the Alternate Mobile No:" class="form-control" maxlength="10" value="<?php echo (!empty($StudentInformation->alternate_mobile_no)) ? $StudentInformation->alternate_mobile_no:'';?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for='aadharcardno'style="color: black">Aadhar Card No<span style="color: red">*</span></label>
                                <input type="text" name="aadhar_card_no" placeholder="Enter the Aadhar Card No:" class="form-control" id="aadhar_card_no" maxlength="12" value="<?php echo (!empty($StudentInformation->aadhar_card_no)) ? $StudentInformation->aadhar_card_no: ''; ?>">
                                <div class="valid-feedback" >valid</div>
                            </div>                         
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">                   
                            <div class="form-group">
                                <label for='add'style="color: black">Address</label>
                                <input type="text" name="address" placeholder="Enter the Address:" class="form-control" value="<?php echo (!empty($StudentInformation->address)) ? $StudentInformation->address: ''; ?>" >
                            </div>
                        </div>
                    </div>               
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="currentcity" style="color: black">City</label>
                                <input type="text" name="city" placeholder="Enter the City:" class="form-control" value="<?php echo (!empty($StudentInformation->city)) ? $StudentInformation->city : '';?>">
                            </div>  
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="currentstate" style="color: black">State</label>
                                <input type="text" name="state" placeholder="Enter the State:" class="form-control" value="<?php echo (!empty($StudentInformation->state)) ? $StudentInformation->state:'';?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for='currentcountry'style="color: black">Country</label>
                                <input type="text" name="country" placeholder="Enter the  Country:" class="form-control" value="<?php echo (!empty($StudentInformation->country)) ? $StudentInformation->country:'';?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div style="float: right;">
                       <!--  <a href="<?php echo base_url('studdatatableroute')?>" class="btn btn-primary" style="background-color: orange;float: right;">Close</a> -->
                        <button type="button" name="Submit" id="submit" value="submit" class="btn btn-primary" onclick="Validstudent(this);" 
                        style="background-color: orange;">Submit</button>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</form>
</div>
</script>
</body>
<?php
    $this->load->view('includejs');
?>
</div>

<script type="text/javascript">
var baseurl='<?php echo base_url();?>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>www/js/studinfovalidation.js">
</script>
<script type="text/javascript">
    $(document).on("click", ".browse", function() {
  var file = $(this).parents().find(".file");
  file.trigger("click");
});
$('input[type="file"]').change(function(e) {
  var fileName = e.target.files[0].name;
  $("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});
</script>













