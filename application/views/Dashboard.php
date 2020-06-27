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
            'title' => 'Dashboard'
        );
        ?>
        <div class="wrapper d-flex align-items-stretch">
        <?php
        $this->load->view('sidebar', $user_data);
        ?>
         <?php
        $this->load->view('header', $user_data);
        ?>
<!--<div class="container">-->
<div id="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <div class="mr-5 "><div class="inner ">
                                <h2><?php echo $h['number']; ?></h2>Students
                                <!--<p>Total No. of Student Register</p>-->
                            </div></div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1">
                        <span class="float-left">Total Registered Student</span>
                        <span class="float-right">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-list-ul"></i>
                        </div>
                        <div class="mr-5">
                            <div class="inner">
                                <h2><?php echo $r['num']; ?></h2>Students
                            </div>                            
                        </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">Registred in Last 10 Days</span>
                        <span class="float-right">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            
            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="mr-5">
                            <div class="inner">
                                <h2><?php echo $s['no'];?></h2>Students
                            </div>
                        </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">Registered in last 30 days</span>
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
</div>
<?php
$this->load->view('includejs');
?>
<?php
//$this->load->view('Footer');
?>
 </body>
</html>
     
 