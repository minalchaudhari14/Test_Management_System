<!DOCTYPE html>
<html>
    <head>
        <title></title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>www/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>www/js/jquery.min.js">
    </head>
    <body style="background-color: white">
        <form id="changePass_Form" name="changePass_Form">
            <br><br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" ><h4>Reset Password</h4></div>

                        <div class="card-body">
                            <div class="form-group">
                                            
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for='email'style="color: black">Email<span style="color: red">*</span></label>
                                            <input type="email" name="email" placeholder="Enter Your email" class="form-control" >
                                        </div>
                                        <div class="form-group ">
                                            <label for='password'style="color: black">New Password <span style="color: red">*</span></label>
                                            <input type="password" name="newPass" placeholder="New Password" class="form-control" id="newPass">                                                                         
                                        </div>
                                        <div class="form-group ">
                                            <label for='password'style="color: black">Confirm Password <span style="color: red">*</span></label>
                                            <input type="password" name="confirmPass" placeholder="Confirm Password" class="form-control" id="confirmPass" >
                                            <div class="valid-feedback">valid</div>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" >
                      
                            <div style="float: right;">		
                                <button type="button" name="change_pass" onclick="changePassword();" class="btn btn-primary">Submit</button>									
                                 <a href="<?php echo base_url('loginroute')?>" class="btn btn-primary">Close</a> 

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </body>
    <?php
        $this->load->view('includejs');
    ?>
    <script>
        function clickback() {
            window.location.href = 'studforgotpass';
        }

        function clickinner() {
            window.location.href = 'dashroute';
        }

    </script>
   <!--  <script type="text/javascript">
    var baseurl = '<?php echo base_url(); ?>';
</script> -->
<script type="text/javascript" src="www/js/resetPassword.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>www/js/jquery.min.js"></script>
</html>