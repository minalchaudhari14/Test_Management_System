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
    <form action="AddSetView.php" method="POST" id="Mapset">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="addnewtestroute">Test Creation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active btn-primary"  href="Mapset">Add Question Set</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled " href="publishtestroute">Publish Test</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled"  href="assigntestroute">Assign Test</a>
            </li>
        </ul>
        <br>
        <br>
        <div class="container">
                <div class="card">
                    <div class="card-body">
<!--                        <input type="hidden" class="form-control" name="test_id" 
                           value="<?php echo $test_id ; ?>" >-->
<!--                        <?php echo form_dropdown('qset_code1', $qset_code, '', 'multiple="multiple" id="qset_id" '); ?> -->

                             <select class="form-control select2" id="qset_id" name="qset_id" multiple="multiple" value="<?php echo (!empty($TestData->qset_id)) ? $TestData->qset_id : ''; ?>">
                                <?php foreach ($qset_code as $row): ?>
                                    <option value="<?php echo $row['qset_id']; ?>"><?php echo $row['qset_code']." "."(".$row['total_no_of_question'].")"; ?></option>
                                <?php endforeach ?>
                            </select>
                        <br>
                        <button type="button" onclick='createTest(this);' id='addset' class="btn btn-primary pull-right">Add Set </button> 
                    </div> 
                </div>
        </div>
        <br>
        <br>
    </form>           
</div>
<?php
$this->load->view('includejs');
?>
<!--<script>
    var select = $('#qset_id')[0];
    multi(select, {
        enable_search: true
    });
</script>-->

<script src="<?php echo base_url(); ?>www/js/Qset.js"></script>
<script src="<?php echo base_url(); ?>www/js/dualselect.js"></script>
    </body>
</html>

