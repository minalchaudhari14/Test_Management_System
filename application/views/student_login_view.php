<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Login</title>   
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->load->view('includecss'); ?>
    </head> 
    <body>   
    <center> 
       <div class="container">
           <div>
                    <img src="<?php echo base_url(); ?>www/images/images.jpg" 
                     style="width: 150px; margin-top: 15px; background-color: grey;" class="rounded-circle" >
<!--                    <div class="overlay ctr"><button type="button" class="btn btn-outline-light">Edit</button></div>-->
           </div>
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card card-signin my-2" id="card">
                            <div class="card-body" >
                                <h5 class="card-title text-center text-white">Admin Login</h5>
                                
                                <form class="form-signin" id="loginform"> 
                                    <div class="form-label-group text-left text-white">
                                        <label for="inputEmail">Email Address<span style="color: red"> *</span></label>
                                        <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email Address" required="" autofocus="" 
                                               value="<?php
                                               if(isset($_COOKIE['emailid'])){
                                                   echo $_COOKIE['emailid'];
                                               }?>">                     
                                    </div>
                                    <br>
                                      <div class="form-label-group text-left text-white">
                                        <label for="password">Password<span style="color: red"> *</span></label>
                                        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required="" 
                                               value=" <?php
                                               if(isset($_COOKIE['pass'])){
                                                   echo $_COOKIE['pass'];
                                               }?>">
                                    </div><br>
                                    <div class="checkbox text-left text-white">
                                        <label><input type="checkbox" name="remember" id="remember">Remember me</label>
                                    </div>
                                 <button class="btn btn-lg btn-primary btn-block" id="loginBtn" type="button" onclick="studentLogin();">Sign in</button>
                                </form>
                                <div class="text-white"><p>Forgot your password? <a href="<?php echo base_url('studresetPass'); ?>">click here</a></p>
                                <!--  <p><a class="d-block small" href="<?php echo base_url('homeroute'); ?>">Back to Home page</a></p> -->
                                </div>
                                </div>                       
                            </div>
                            </div>
                            </div>
                        </div>
</center>
<?php
$this->load->view('includejs');
?> 
<script type="text/javascript">
    var baseurl = '<?php echo base_url(); ?>';
</script>
<script type="text/javascript" src="www/js/loginjs.js"></script>

  
