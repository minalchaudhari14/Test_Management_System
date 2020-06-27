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
                p.ex3 {

                    padding-right: 200px;
                }
                p.ex2 {

                    padding-right: 200px;
                }
            </style>
            <!-- <h3 style="color:gray; text-align: center;">Question Bank</h3>
            -->
        </head>
        <body>
            <form action="QuesBankView" method="post">
                <div class="container">

                    <div class="card ">
                        <div class="card-header ">
                            <div class="row"> 
                                <p class="ex1"><div class="form-group">
                                    <select id="typeofque" class="form-control">
                                        <option value=''>-- Select Type Of Question --</option>
                                        <?php
                                        foreach ($description as $description) {
                                            echo "<option value='" . $description . "'>" . $description . "</option>";
                                        }
                                        ?></select></div></p>
                                <p class="ex1"><div class="form-group">
                                    <select id="typeoflevel" class="form-control">
                                        <option value=''>-- Select Difficulty Level --</option>
                                        <?php
                                        foreach ($difficulty_level_name as $difficulty_level_name) {
                                            echo "<option value='" . $difficulty_level_name . "'>" . $difficulty_level_name . "</option>";
                                        }
                                        ?></select></div></p>

                                <p class="ex1"><div class="form-group">
                                    <select id="subjectname" class="form-control">
                                        <option value=''>-- Select Subject --</option>
                                        <?php
                                        foreach ($subject_name as $subject_name) {
                                            echo "<option value='" . $subject_name . "'>" . $subject_name . "</option>";
                                        }
                                        ?>
                                    </select></div></p>


                                <p class="ex1"><div>
                                    <a href="selectqueroute" type="button" data-toggle="tooltip" title="Add Question" class="pull-right btn btn-primary mr-1"><i class="fa fa-plus-square">

                                        </i></a>  </div>
                               <!--  <script>
                                    $(document).ready(function () {
                                        $('[data-toggle="tooltip"]').tooltip();
                                    });
                                </script>  --> 
                                <div>         
                                    <button type="button" onclick='refresh();' class="btn btn-primary pull-right"><i class="fa fa-refresh"></i></button>

                                </div></p>

                            </div>
                        </div>


                        <br>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="Questionid" id="Questionid">
                        </div>
                        <div class="container">
                            <table id="Questiontable" class="table table-striped dt-responsive table-bordered">
                                <thead align="center">
                                    <tr>
                                        <th>Question</th>
                                        <th>Option For Question</th>
                                        <th>Answer</th>
                                        <th>Marks</th>
                                        <th>Negative Marks</th>
                                        <th>Difficulty Level</th>
                                        <th>Subject Name</th>
                                        <th>Type Of Question</th>
                                        <th>Time Duration</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

    </div>
</div>

<script type="text/javascript">
    var baseurl = '<?php echo base_url(); ?>';
</script>
<?php
$this->load->view('includejs');
?>
<script src="<?php echo base_url(); ?>www/js/distable.js"></script>

