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
        $this->load->view('sidebar', $user_data);
        ?>
         <?php
        $this->load->view('header', $user_data);
        ?>
<div class="container">
    <form method="POST"  action="AddNewTestView" id="createForm">
        <div class="container mt-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active btn-primary" href="addnewtestroute">Test Creation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled"  href="Mapset">Add Question Set</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="publishtestroute">Publish Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled"  href="assigntestroute">Assign Test</a>
                </li>
            </ul>
            <br>
            <h3 style="color:gray; text-align: center;">Create New Test</h3>
            <div class="card">
                <div class="card-body">
                    <input type="hidden" class="form-control" id="test_id" name="test_id" 
                           value="<?php echo (!empty($TestData->test_id)) ? $TestData->test_id : ''; ?>" >

                    <div class="form-group">
                        <label for="TestTitle">Title<span style="color: red">*</span>:</label>
                        <input type="text" class="form-control" placeholder="Enter Test name" 
                               name="test_name" value="<?php echo (!empty($TestData->test_name)) ? $TestData->test_name : ''; ?>" id="test_name" required>      
                    </div>

                    <div class="form-group">
                        <label for="Duration">Duration<span style="color: red">*</span> :</label>
                        <input type="text" class="form-control" placeholder="Enter Test duration" 
                               name="duration" value="<?php echo (!empty($TestData->duration)) ? $TestData->duration : ''; ?>" id="duration" required>     
                    </div>

                    <div class="form-group">
                        <label for="marks">Out of Mark<span style="color: red">*</span> :</label>
                        <input type="text" class="form-control" placeholder="Enter Total marks"
                               name="out_of_mark" value="<?php echo (!empty($TestData->out_of_mark)) ? $TestData->out_of_mark : ''; ?>" id="totalmark" required>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            &nbsp &nbsp;
                            <label for="Course">Course <span style="color: red">*</span>:</label>
                            <div class="col-md-3">
                                <select id='selectCourse' name="selectCourse" class="form-control" value="<?php echo (!empty($TestData->course_id)) ? $TestData->course_id : ''; ?>">
                                    <option value="">-- Select Course --</option>
                                   
                                     <?php foreach ($course_name as $row): ?>
                                    <option value="<?php echo $row['course_id']; ?>"><?php echo $row['course_name']; ?></option>
                                <?php endforeach ?>
                                  
                                </select>
                                <div class="invalid-feedback">Please Select Course</div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <div class="row"> 
                            &nbsp &nbsp;
                            <label for="Subject">Subject<span style="color: red"></span> :</label>

                            <div class="col-md-3">
                                <select id='selectSubject' class="form-control">
                                    <option value=''>-- Select Subject --</option>
                                    <?php
                                    foreach ($subject_name as $subject_name) {
                                        echo "<option value='" . $subject_name . "'>" . $subject_name . "</option>";
                                    }
                                    ?>
-->                               
                    <div class="card-footer">
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <a id="subBtn" class="btn btn-primary">Save</a>
                    </div>
                </div> 
            </div>
        </div>
    </form>
</div></div>
<?php
$this->load->view('includejs');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>www/js/creation.js"></script>
    </body>
</html>