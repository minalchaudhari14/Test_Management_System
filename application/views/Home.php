<!doctype html>
<html lang="en">
    <head>
        <title>Home Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->load->view('includecss'); ?>  
    </head>
    <body>
    <div id="wrapper">
      <div id="content-wrapper">
        <div class="container-fluid">
            <center> <h1>Test Mangement System</h1></center>
          <hr>
<div class="row">
<div class="col-xl-3 col-sm-6 mb-3">
  &nbsp;
</div>

  <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-users"></i>
                  </div>
                  <div class="mr-5">User Login</div>
                </div>
               <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('log-in'); ?>">
                  <span class="float-left">Click Here</span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div> 
    
    <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">Admin Login</div>
                </div>
                  <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('loginroute'); ?>">
                  <span class="float-left">Click Here</span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
</div> 
        </div>
      </div>
    </div>
      <?php
$this->load->view('includejs');
?>
  </body>

</html>
