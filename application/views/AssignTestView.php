
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


<div class="container mt-3">
    <form id="assignform-example" action="AssignTestView.php" method="POST">   
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link disabled " href="addnewtestroute">Test Creation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled"  href="Mapset">Add Question Set</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>publishtestroute">Publish Test</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active btn-primary"  href="<?php echo base_url(); ?>assigntestroute">Assign Test</a>
            </li>
        </ul>
        <br>
        <br>
        <div class="card">
            <div class="card-body">
                <br>
             <input type="hidden" class="form-control" name="test_id" 
                           value="<?php echo (!empty($TestData->test_id)) ? $TestData->test_id : ''; ?>" >
             
                <table id="assignform" class="table table-striped dt-responsive display table-bordered"
                       value="<?php echo (!empty($TestData->batch_id)) ? $TestData->batch_id : ''; ?>" >
                    <thead>
                        <tr>
                            <th><input name="select_all" value="1" type="checkbox"></th>
                            <th>Batch code</th>
                            <th>Batch Name</th>

                        </tr>
                    </thead>
                </table>
                <button type="button" onclick="InsertAssignData(this);" id="assign" class="btn btn-primary">Save</button>

            </div>
        </div>
    </form>

</div>

<!--<script src="<?php echo base_url(); ?>www/js/assigntest.js"></script>-->
</div>
<?php
$this->load->view('includejs');
?>
  <script src="<?php echo base_url(); ?>www/js/assigntest.js"></script>      
    </body>
</html>





