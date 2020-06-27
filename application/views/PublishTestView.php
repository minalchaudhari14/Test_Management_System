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
    <form action="PublishTestView" method="POST">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link disabled " href="addnewtestroute">Test Creation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled"  href="Mapset">Add Question Set</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active btn-primary" href="<?php echo base_url(); ?>publishtestroute">Publish Test</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="<?php echo base_url(); ?>assigntestroute">Assign Test</a>
            </li>
        </ul>
        <br>
        <h3 style="color:gray; text-align: center;">Report For Publish</h3>

        <div class="card">
            <div class="card-body">
                <br>
             <input type="hidden" class="form-control" name="test_id" 
                           value="<?php echo (!empty($TestData->test_id)) ? $TestData->test_id : ''; ?>" >
                <table id="publishque" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Qset Code</th>
                            <th>Mark Per Question</th>
                        </tr>
                    </thead>

                </table>  
                <br>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Proceed To Publish</button>
            </div>
        </div>
        <br>
        <div id="demo" class="collapse">
            <div class="card">
                <div class="card-body">
                    <table class="table" border="2">
                        <input type="hidden" name="test_id" id="test_id" value="<?php echo (!empty($TestPublish->test_id)) ? $TestPublish->test_id : ''; ?>" required>
                        <tr>
                            <td> Start_Date<span style="color: red">*</span>:  </td>
                            <td><input type="date" name="sdate" id="startdate" value="<?php echo (!empty($TestPublish->start_date)) ? $TestPublish->start_date : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td> End_Date<span style="color: red">*</span>:</td>
                            <td>  <input type="date" name="edate" id="enddate" value="<?php echo (!empty($TestPublish->end_date)) ? $TestPublish->end_date : ''; ?>"required></td>
                        </tr>
                        <tr>
                            <td>   
                                Start_Time<span style="color: red">*</span>:</td>
                            <td>
                                <input type="time" id="starttime" name="stime" value="<?php echo (!empty($TestPublish->start_time)) ? $TestPublish->start_time : ''; ?>"required>
                            </td>
                        </tr>
                        <tr> 
                            <td>End_Time<span style="color: red">*</span>:</td>
                            <td>
                                <input type="time" name="etime" id="endtime" value="<?php echo (!empty($TestPublish->end_time)) ? $TestPublish->end_time : ''; ?>">
                            </td>
                        </tr>
                        <tr><td colspan="2" align="center">
                              <button type="button" onclick='publishInsertTest(this);' class="btn btn-primary">Add Set </button> </td></tr>    
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
$this->load->view('includejs');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>www/js/publish.js"></script>

