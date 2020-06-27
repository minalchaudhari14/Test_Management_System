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
            'title' => 'Course'
        );
        ?>
        <div class="wrapper d-flex align-items-stretch">
            <?php
            $this->load->view('sidebar', $user_data);
            ?>
            <?php
            $this->load->view('header', $user_data);
            ?>
            <div class="container ">
                <div class="card">
                    <div class="card-header"><div class="pull-right"><button class="btn btn-primary " data-toggle="modal"
                                                                             onclick="insertCourse();"  ><i class="fa fa-plus-square "></i></button>
                            <button class="btn btn-primary" onclick="refresh();"><i class="fa fa-refresh"></i></button></div></div>
                    <br/><br/>
                    <div class="container">
                        <div>
                            <table id="example" class="table table-striped table-bordered ">
                                <thead align="center">
                                    <tr>
                                        <th>Edit</th>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Add Subject</th>
                                        <th>Add Batch</th>
                                        <th>Status</th>
                                        <th>Remove</th>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" tabindex="-1" role="dialog" id="addCorse">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Course</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <?php
                                $this->load->library('form_validation');
                                echo validation_errors();
                                ?>
                                <form method="post"  id="createForm">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control"  name="courseid" id="courseid">
                                        </div>
                                        <div class="form-group">
                                            <label for="coursecode"> Course Code <span style="color: red">*</span>:</label>
                                            <input type="text" class="form-control" id="coursecode" name="coursecode"
                                                   placeholder="Enter Course Code">
                                        </div>
                                        <div class="form-group">
                                            <label for="coursename"> Course Name <span style="color: red">*</span>:</label>
                                            <input type="text" class="form-control" id="coursename" name="coursename"
                                                   placeholder="Enter Course Name">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="validation(this);">Save Change</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id="addSubject">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Subject Mapping</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <form>
                                        <select class="form-control select2" id="Language_select" name="Language_select" multiple="multiple">
                                            <?php foreach ($subject_data as $row): ?>
                                                <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <input type="hidden" class="form-control"  name="courseId" id="courseId">
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal" onclick="addSubjectMap();">Map</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" tabindex="-1" role="dialog" id="addBatch">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Batch Mapping</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <form>
                                        <select class="form-control select2" id="batch_select" name="batch_select" multiple="multiple">
                                            <?php foreach ($batch_data as $row): ?>
                                                <option value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal"  onclick="addBatchMap();">Map</button>
                            </div>
                        </div>
                    </div>
                </div></div>
            <?php
            $this->load->view('includejs');
            ?>
            <script>
                var select = document.getElementById("batch_select");
                multi(select, {
                    enable_search: true
                });
            </script>
            <script>
                var select = document.getElementById("Language_select");
                multi(select, {
                    enable_search: true

                });
            </script>
            <script type="text/javascript">
                var baseurl = '<?php echo base_url(); ?>';
            </script>
            <script type="text/javascript" src="www/js/course.js"></script>
        </div>
    </body>
</html>