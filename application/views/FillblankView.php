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
            <div class="container">
                <form action="FillblankView" method="post" id="add" >
                    <div class="container">
                        <form action="MultiplechoiceView" method="post" id="add">
                            <div class="container">
                                <div class="card ">
                                    <div class="card-header ">

                                        <div class="row">

                                            <p class="ex1"><div class="form-group">
                                                <label for="level">Type Of Question<span style="color: red">*</span> :</label> 
                                                <select id="typeofque"  name="description" class="form-control">
                                                    <option value='' >-- Select Type of Question --</option>
                                                    <?php
                                                    $a = 3;
                                                    $type_of_question_id = 1;
                                                    foreach ($description as $description) {
                                                        echo "<option value='" . $type_of_question_id . "'" . (($type_of_question_id == $a) ?
                                                                "selected='selected'" : "") . ">" . $description . "</option>";
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
                            </div>
                            <br>
                            <div class="container">
                                <div class="card text-center">
                                    <div class="card-body ">
                                        <h3 class="card-title" style="color:gray;">Fill In The Blank</h3> 
                                        <br>
                                        <div class="row">
                                            <!-- <div class="card-columns"> -->
                                            <div class="col-md-6">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <table class="table">   
                                                            <tr>
                                                                <td><label for="comment" name="Question">Question<span style="color: red">*</span>:</label></td>
                                                                <td><textarea class="form-control" name="Question" rows="1" id="question"></textarea></td>
                                                            </tr>
                                                            <tr>
                                                            <div class="radio">
                                                                <td> <label><input type="radio" name="optradio"   onclick ="insertData('A');">A</label></td>
                                                                <td> <input type="text" name='option1[]' class="form-control" id="option1"></td>
                                                            </div>
                                                            </tr>
                                                            <tr>
                                                            <div>   
                                                                <td><label><input type="radio" name="optradio"  onclick ="insertData('B');">B</label></td>
                                                                <td><input type="text" name='option2[]' class="form-control" id="option2"></td>
                                                            </div>
                                                            </tr>
                                                            <tr>
                                                            <div>   
                                                                <td><label><input type="radio" name="optradio"  onclick ="insertData('C');">C</label></td>
                                                                <td><input type="text" name='option3[]' class="form-control" id="option3"></td>
                                                            </div>
                                                            </tr>
                                                            <tr>
                                                            <div>   
                                                                <td><label><input type="radio" name="optradio"  onclick ="insertData('D');">D</label></td>
                                                                <td><input type="text" name='option4[]' class="form-control" id="option4"></td>
                                                            </div>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card text-left">

                                                    <div class="card-body">
                                                        <div class="container">
                                                            <div class="form-group">

                                                                <div>
                                                                    <label for="ans" Name="Answer">Correct Answer <span style="color: red">*</span>:<br>
                                                                        (For correct answer please select radio button)  
                                                                        <input type="text"  name="Answer" class="form-control" id="Answer" > </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="mark" name="Marks">Marks<span style="color: red">*</span>:
                                                                        <input type="Text" name="Marks" class="form-control" id="mark"></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Nmark" name="Nmark">Negative Mark :(Optional)
                                                                        <input type="Text" class="form-control" id="Nmark" name="Nmark"></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="time" name="Time">Time Duration<span style="color: red">*</span>:
                                                                        <input type="Text" name="Time" class="form-control" id="time"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <button type="button"  id="submit" class="btn btn-secondary" data-dismiss="modal" value="Validate" onclick="addque(this)">Save Question</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
            <br>
            <?php
            $this->load->view('includejs');
            ?>
            <script type="text/javascript">
                var baseurl = '<?php echo base_url(); ?>';
            </script>
            <script src="<?php echo base_url(); ?>www/js/addque.js"></script>









