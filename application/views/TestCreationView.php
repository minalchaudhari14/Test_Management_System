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
            'title' => 'Test Creation'
        );
        ?>
        <div class="wrapper d-flex align-items-stretch">
            <?php
            $this->load->view('sidebar',$user_data);
            ?>
            <?php
            $this->load->view('header',$user_data);
            ?>
<h3 align="center">Test Creation</h3>
<div class="container">
    <div class="card">
        <div class="card-body">
            
            <button type="button" onclick='refresh();' class="btn btn-primary pull-right"><i class="fa fa-refresh"></i></button>
             
            <a href="addnewtestroute" data-toggle="tooltip" title="Add New Test" class="pull-right btn btn-primary mr-1"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
         
            <br>
            <br>
            <input type="hidden" class="form-control" name="test_id" id="test_id" >
            <table id="example" class="table table-striped dt-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Edit</th>

                        <th>Test Name</th> 
                        <th>Qset Code</th>
                        <th>Duration</th>
                        <th>Total Mark</th>
                        <th>Publish Test</th>
                        <th>Assign Test</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
               
            </table> 
        </div>

    </div>
</div>
<?php
$this->load->view('includejs');
?>
<script type="text/javascript" src="www/js/TestCreation.js"></script>
<script type="text/javascript" src="www/js/creation.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script type="text/javascript">
	var baseurl='<?php echo base_url();?>';
</script>