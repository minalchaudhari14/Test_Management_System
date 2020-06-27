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
            'title' => 'Settings'
        );
        ?>
        <div class="wrapper d-flex align-items-stretch">
            <?php
            $this->load->view('sidebar',$user_data);
            ?>
            <?php
            $this->load->view('header',$user_data);
            ?>
<div class="container">
     <h3>Change Password</h3>
    <hr>
    <form action="changepass" method="post" accept-charset="utf-8" id="changpassid">
        <div class="form-group">     
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input type="password" name="currentpassword" value="" id="currentpassword" 
                               class="form-control" autofocus="autofocus"  />
                        <label for="currentpassword">Current Password</label> </div>
                </div>
            </div>
        </div>
        <div class="form-group">     
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input type="password" name="newpassword" value="" id="newpassword" 
                               class="form-control" autofocus="autofocus"  />
                        <label for="password">New Password</label></div>
                </div>
            </div>
        </div>        
        <div class="form-group">         
            <div class="form-row">             
                <div class="col-md-6">
                    <div class="form-label-group">
                        <input type="password" name="confirmpassword" value="" id="confirmpassword" 
                               class="form-control" autofocus="autofocus"  />
                        <label for="confirmpassword">Confirm Password</label>                  </div>
                </div>
            </div>
        </div>
        <div class="form-group">         
            <div class="form-row">             
                <div class="col-md-6">
                    <input type="submit" name="chnagepwd" value="Change" class="btn btn-primary btn-block" onclick=" changePass();"/>
                  
                </div>
            </div>
        </div>
        </form>
</div>
        </div>            
<?php
$this->load->view('includejs');
?>
<script type="text/javascript" src="www/js/changepass.js"></script>
    </body>
</html>
 