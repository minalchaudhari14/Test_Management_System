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
<h3 align="center">Question Sets</h3>
<div class="container">
    <div class="card">
        <div class="card-body">
            <input type="hidden" class="form-control" name="qset_id" id="qset_id" >
            <button type="button" onclick='refresh();' class="btn btn-primary pull-right"><i class="fa fa-refresh"></i></button>
             
            <a href="addquesroute" data-toggle="tooltip" title="Add Question Set" class="pull-right btn btn-primary mr-1"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
         
            <br>
            <br>
            <table id="QuesSet" class="table table-striped dt-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Set Id</th>
                        <th>Qset Code</th> 
                        <th>Total Questions</th>
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
<script type="text/javascript" src="www/js/Qset.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script type="text/javascript">
	var baseurl='<?php echo base_url();?>';
</script>