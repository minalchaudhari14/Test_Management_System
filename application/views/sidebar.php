 <nav id="sidebar"  >
    <div class="container">
<!--    <div class="menu">-->
<center> <h6>Test Management System</h6> </center>
    <br>
    <ul class="list-unstyled components mb-5">    
            <div class="container">          
                <center> 
                    <span id="img"><img src="<?php echo base_url(); ?>www/images/images.jpg" class="rounded-circle" alt="Cinque Terre" width="100" height="90">
                    </span></center> 
            </div><br>   
        <div class="container">
            <center><span id="admin">Admin</span> </center>
        </div>
        <div class="container">
            <center><span id="email">admin123@gmail.com</span></center>
        </div>
        <div class="container">
            <center><span id="mbno">+91-8697463515</span></center>
        </div>
        <br><br>
        <li>
            <a href="<?php echo base_url('dashroute'); ?>" ><span class="fa fa-tachometer "></span><span id="dashboard">Dashboard</span></a>
        </li>   
        <li >
            <a href="<?php echo base_url('studdatatableroute'); ?>" ><span class="fa fa-male"></span><span id="studinfo">Student Info</span></a>
        </li>   
        <li>  
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="fa fa-book"></span><span id="courseinfo">Courses Info</span></a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="<?php echo base_url('courseroute'); ?>" ><span class="fa fa-graduation-cap"></span><span id="course">Course</span> </a>
                </li>
                <li>
                    <a href="<?php echo base_url('batchroute'); ?>"><span class="fa fa-user"></span><span id="batch">Batch</span></a>
                </li>
                <li>
                    <a href="<?php echo base_url('subjectroute'); ?>"><span class="fa fa-book"></span><span id="subject">Subject</span></a>
                </li> 
            </ul>
                <li>
                   <a href="<?php echo base_url('quesbankroute'); ?>"><span class=" fa fa-question"></span><span id="quesbank">Question Bank</span></a>
               </li>
               <li> 
                 <a href="<?php echo base_url('testcreationroute'); ?>"><span class="fa fa-pencil"></span><span id="testcreation">Test Creation</span></a>
               </li>
                <li> 
                 <a href="<?php echo base_url('Qsetroute'); ?>"><span class="fa fa-sticky-note"></span><span id="quesset">Question Set</span></a>
               </li>
                <li > 
                 <a href="#home" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="fa fa-wrench"></span><span id="settings">Settings</span></a>
               </li>
                 <ul class="collapse list-unstyled" id="home">
                <li>
                    <a  href="<?php echo base_url(); ?>changepassroute"><span class="fa fa-key"></span><span id="pass">Change Password</span></a> 
                </li>
               </ul>
               <li>
                   <a href="<?php echo base_url(); ?>StudloginController/logout" ><span class="fa fa-sign-out"></span><span id="logout">Logout</span></a>
               </li>
           </li>
       </ul>   
   </div>
    </nav>
