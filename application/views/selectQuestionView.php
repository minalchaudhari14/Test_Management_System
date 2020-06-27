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
            'title' => 'Question Bank'
        );
        ?>
        <div class="wrapper d-flex align-items-stretch">
            <?php
            $this->load->view('sidebar', $user_data);
            ?>
            <?php
            $this->load->view('header', $user_data);
            ?>
            <style>
                p.ex1 {
                    padding: 15px;
                }
            </style>
            <h3 style="color:gray; align:center; text-align: center;">Select Type Of Question</h3>
            <div class="container">
                <div class="card ">
                    <div class="card-header ">
                        <!--   <form class="was-validated"> -->
                        <div class="row">
                            <p class="ex1"><div class="form-group">
                                <label for="level">Type Of Question<span style="color: red">*</span> :</label> 
                                <select id="typeofque" class="form-control">
                                    <option value=''>-- Select Type of Question --</option>
                                    <?php
                                    $type_of_question_id = 1;
                                    foreach ($description as $description) {
                                        echo "<option value='" . $type_of_question_id . "'select>" . $description . "</option>";
                                        $type_of_question_id++;
                                    }
                                    ?></select></div></p> 
                           <p class="ex1"><div class="form-group">
                                            <label for="level">Difficulty Level:<span style="color: red">*</span> :</label>
                                            <select id="typeoflevel" class="form-control" name="difficulty_level_name">
                                                <option value=''>-- Select Difficulty Level --</option>
                                                
                                                        <?php
                                               
                                                foreach ($difficulty_level as  $row):?>
                                                     <option value="<?php echo $row['difficulty_level_id']; ?>"><?php echo $row['difficulty_level_name']; ?></option>
                                              <?php endforeach ?>
                                                </select></div></p>

                                   <p class="ex1"><div class="form-group">
                                            <label for="level">Subject Name:<span style="color: red">*</span> :</label> 
                                            <select id="subjectname" class="form-control" name="subject_name">
                                                <option value=''>-- Select Subject --</option>
                                                <?php
                                               
                                                foreach ($subject as  $row):?>
                                                     <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></option>
                                                      <?php endforeach ?>
                                                   </select></div></p> 






                        </div>
                    </div>
                </div>
                <br>
                <?php
                $this->load->view('includejs');
                ?>       
                </body>
                <script src="<?php echo base_url(); ?>www/js/addque.js"></script>
                </html>



