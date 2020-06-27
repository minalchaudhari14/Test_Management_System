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
                <form action="MatchthefollowView" method="post" id="add">
                    <div class="container">
                        <!--  <form action="MultiplechoiceView" method="post" id="add">
                             <div class="container"> -->
                        <div class="card ">
                            <div class="card-header ">
                                <div class="row">
                                    <p class="ex1"><div class="form-group">
                                        <label for="level">Type Of Question<span style="color: red">*</span> :</label> 
                                        <select id="typeofque"  name="description" class="form-control">
                                            <option value='' >-- Select Type Of Question --</option>
                                            <?php
                                            $a = 5;
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
                                <h3 class="card-title" style="color:gray;">Match The Following</h3> 
                                <br>
                                <div class="row">
                                    <!-- <div class="card-columns"> -->
                                    <div class="col-md-7">
                                        <div class="card text-left">
                                            <table class="table-responsive table-striped table-bordered " id="matchtable" name="table">
                                                <thead name="table">
                                                    <tr>
                                                        <th>Question</th>
                                                        <th>Match Pair</th>
                                                        <th>Correct Answer</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> <label>A :<input type="text" name="Question" id="option"></label></td>
                                                        <td> <label>1 :<input type="text" name="matchpair" ></label></td>
                                                        <td> <label>A :<input type="text" name="Answer" ></label></td>
                                                    </tr>
                                                    <tr >
                                                        <td> <label>B :<input type="text" name="Question" id="option"></label></td>
                                                        <td> <label>2 :<input type="text" name="matchpair" ></label></td>
                                                        <td> <label>B :<input type="text" name="Answer" ></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <label>C :<input type="text" name="Question" id="option"></label></td>
                                                        <td> <label>3 :<input type="text" name="matchpair" ></label></td>
                                                        <td> <label>C :<input type="text" name="Answer" ></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <label>D :<input type="text" name="Question" id="option"></label></td>
                                                        <td> <label>4 :<input type="text" name="matchpair" ></label></td>
                                                        <td> <label>D :<input type="text" name="Answer" ></label></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card text-left">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="form-group">
                                                        <div>
                                                            <label for="ans" name="matchpair">Correct MacthPair <span style="color: red">*</span>: </label><br>
                                                            <input name="matchpair[]" type="text" class="form-control" id="usr1" style="width: 50px;float: left;"> 
                                                            <input name="matchpair[]" type="text" class="form-control" id="usr2" style="width: 50px;float: left;"> 
                                                            <input name="matchpair[]" type="text" class="form-control" id="usr3" style="width: 50px;float: left;"> 
                                                            <input name="matchpair[]" type="text" class="form-control" id="usr4" style="width: 50px;"> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mark" name="Marks">Marks<span style="color: red">*</span>:
                                                                <input type="Text" class="form-control" name="Marks" id="mark"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Nmark" name="Nmark">Negative Mark :(Optional)
                                                                <input type="Text" class="form-control" id="Nmark" name="Nmark"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time" name="Time">Time Duration<span style="color: red">*</span>:
                                                                <input type="Text" class="form-control" name="Time" id="time"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="submit" onclick="addmatchpair(this);">Save Question</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <br>
            <div class="container">
            </div>
            <?php
            $this->load->view('includejs');
            ?>
            <script type="text/javascript">
                var baseurl = '<?php echo base_url(); ?>';
            </script>
            <script src="<?php echo base_url(); ?>www/js/matchfollow.js"></script> 









