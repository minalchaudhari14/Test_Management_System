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
            <div class="container mt-3">
                <div class="card">
                    <br>
                    <div class="container">
                        <form id="frm-example" action="AddQuesView.php" method="POST">
                            <div  class="row">
                                <div class='col-md-6'>  
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 align='center'>Add Question</h3>        
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="code">Set Code<span style="color: red">*</span> :</label>
                                                    <input type="text" class="form-control" placeholder="Enter set code" name="qset_code" id="qset_code" required>      
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="code">Total Questions<span style="color: red">*</span> :</label>
                                                    <input type="text" class="form-control" placeholder="Enter no of Question" name="totalques" id="totalques" required>      
                                                </div>

                                                <div class="col-md-2">
                                                    <a id="addquesset" class="pull-right btn btn-primary "><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="Course">Course <span style="color: red">*</span> :</label>                  
                                                    <select id='selectcourse' name="course_id" class="form-control">
                                                        <option value=''>--Select Course--</option>
                                                        <?php foreach ($course as $row): ?>
                                                            <option value="<?php echo $row['course_id']; ?>"><?php echo $row['course_name']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="level">Difficulty Level<span style="color: red">*</span> :</label>                  
                                                    <select id='selectLevel' class="form-control">
                                                        <option value=''>--Select Level--</option>
                                                        <?php
                                                        foreach ($difficulty_level_name as $difficulty_level_name) {
                                                            echo "<option value='" . $difficulty_level_name . "'>" . $difficulty_level_name . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="container">
                                                <br>
                                                <table id="example1" class="table table-striped dt-responsive display select table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th><input name="select_all" value="1" type="checkbox"></th>
                                                            <th>Question</th>
                                                            <th>Difficult Level</th>
                                                            <th>Marks</th>
                                                            <th>Negative Mark</th> 
                                                        </tr>
                                                    </thead>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class='col-md-6'>  
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 align="center">Selected Questions</h3>
                                        </div>
                                        <div class="card-body">
                                            <a onclick="AddSet(this);" class="pull-right btn btn-primary ">Add Set</a>
                                            <br>
                                            <br>
                                            <table id="select" class="table table-striped dt-responsive display select table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Question</th>
                                                        <th>Difficult Level</th>
                                                        <th>Marks</th>
                                                        <th>Negative Mark</th> 
                                                        <th>Remove</th>
                                                    </tr>
                                                </thead>
                                            </table>  
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $this->load->view('includejs');
        ?>
        <script src="www/js/question.js"></script>
        
    </body>
</html>



