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
        <!-- Page Content  -->
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <select id="assesmentid" class="form-control" name="assesmentid">
                                    <option value=''>-- Select Assessment Year --</option>
                                    <?php
                                        foreach ($assessment_year as $row) {
                                            echo "<option value='" . $row['assessment_year'] . "'>" . $row['assessment_year'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-4" style="float: right;">
                            <div class="pull-right">
                                    <a class="btn btn-primary" href="<?php echo base_url('studInforoute') ?>" style='background-color: orange;'><i class="fa fa-plus-square" aria-hidden="true"  data-target="#addinfo" onclick="AddStudInfoModel();"></i></a>

                                    <button class="btn btn-primary" style="" onclick="refresh();"><i class="fa fa-refresh"></i></button> 

                                     <a class="btn btn-primary" href="<?php echo base_url('dashroute');?>" style="background-color: orange;">
                                        <i class="fa fa-close"></i></a>
                            </div>
                        </div>
                    </div>
                </div>    
                <br/><br/>             
                <div class="container">
                    <table id="studentDataTable" class="table table-striped dt-responsive">
                        <thead>
                            <tr>
                                <th>Student Photo</th> 
                                <th>Registration Id</th>
                                <th>Student First Name</th>
                                <th>Student Middle Name</th>
                                <th>Student Last Name</th>
                                <th>Email</th>                               
                                <th>Add Batch</th>                                  
                                <th>Add Document</th> 
                                <th>Edit</th> 
                                <th>Active</th>
                                <th>Mobile No</th>
                                <th>Alternate Mobile No</th>
                                <th>Student Gender</th> 
                                <th>DOB</th>                                              
                                <th>Address</th>
                                <th>State</th>
                                <th>City</th>                                
                                <th>Country</th>
                                <th>Assessment Year</th>
                                <th>Date of Registration</th>                                  
                                <th>Aadhar Card No</th>    
                            </tr> 
                        </thead>                         
                    </table>
                </div>
                <div class="card-footer">
                    <!-- <div class="page-footer" style="float: right;">
                        <a class="btn btn-primary" href="<?php echo base_url('dashroute');?>" style="background-color: orange;">Close </a>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="addBatch">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Student Batch Mapping</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <form>
                                        <select class="form-control select2" id="batch_select" name="batch_select" multiple="multiple">
                                            <?php foreach ($batch_data as $row): ?>
                                                <option value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <input type="hidden" class="form-control"  name="studentId" id="studentId">
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal" onclick="addStudentBatchMap();">Map</button>
                            </div>
                        </div>
                    </div>
                </div>
    </body>
       <?php
        $this->load->view('includejs');
        ?>        
<script>
    var select = document.getElementById("batch_select");
    multi(select, {
        enable_search: true
    });
</script>
<script type="text/javascript" src="<?php echo base_url();?>www/js/studinfovalidation.js">
</script>