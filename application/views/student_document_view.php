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
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="hidden" name="student_id" id="student_id" value="<?php echo(!empty($studentName->student_id)) ? $studentName->student_id:'';?>"> 

                            </div>
                            <div class="form-group">
                                <input type="hidden" name="student_doc_id" id="student_doc_id" value="<?php echo(!empty($studentDocName->student_doc_id)) ? $studentDocName->student_doc_id:'';?>"> 
                                
                            </div>
                            <div class="form-group ">
                                    <label for='email' style="color: black;" class="control-label">Student Name
                                    </label>                               
                                    <input type="text" name="student_first_name" id="student_first_name"  class="form-control" value="<?php echo (!empty($studentName->student_first_name)) ? $studentName->student_first_name:'';?>">

                                </div> 
                         
                        </div>
                        <div class="col-md-7"></div>
                        <div class="col-md-2" style="float: right;">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="<?php echo base_url();?>studdocid/<?php echo $studentName->student_id?>" style='background-color: orange;' ><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                 <button class="btn btn-primary" style="" onclick="refreshdoc();"><i class="fa fa-refresh"></i></button> 
                                <a class="btn btn-primary" href="<?php echo base_url('studdatatableroute'); ?>" style="background-color: orange;"><i class="fa fa-close"></i></a>
                            </div>  
                        </div>
                        <br/><br/>
                    </div>
                </div>
            <div class="card-body">         
                <table id="exampledocument" class="table table-striped table-bordered dt-responsive">
                    <thead>
                        <tr>
                            <th>Student Document Name</th>
                            <th>Student Document path</th>
                            <th>Delete</th>		            	
                        </tr>	
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <div class="page-footer" style="float: right;">
                    
                </div>
            </div>            
        </div>
    </div>
</body>
<?php
    $this->load->view('includejs');
?>
<script type="text/javascript" src="<?php echo base_url();?>www/js/studDocValidation.js"></script>

 
