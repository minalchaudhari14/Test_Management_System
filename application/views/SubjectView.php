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
            'title' => 'Subject'
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
                    <div class="card-header"><div class="pull-right"><button class="btn btn-primary" data-toggle="modal" 
                                                                             onclick=" insertModel();" ><i class="fa fa-plus-square"></i></button> 
                            <button class="btn btn-primary" onclick="refresh();"><i class="fa fa-refresh"></i></button></div>
                    </div>
                    <br/> <br/>
                    <div class="container"
                         <div>
                            <table id="table2" class="table table-striped table-bordered ">
                                <thead align="center">
                                    <tr>
                                        <th>Edit</th>
                                        <th>Subject Code</th>
                                        <th>Subject Name</th> 
                                        <th>Status</th>
                                        <th>Remove</th>                  
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" tabindex="-1" role="dialog" id="addSubject">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Subject</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <?php
                                $this->load->library('form_validation');
                                echo validation_errors();
                                ?>
                                <form method="post" id="createForm">
                                    <div class="modal-body">     
                                        <div class="form-group">
                                            <input type="hidden" class="form-control"  name="subjectid" id="subjectid">
                                        </div>
                                        <div class="form-group">
                                            <label for="subjectcode"> Subject Code <span style="color: red">*</span>: </label>
                                            <input type="text" class="form-control" id="subjectcode" name="subjectcode" 
                                                   placeholder="Enter Subject Code">
                                        </div>
                                        <div class="form-group">
                                            <label for="subjectname"> Subjec Name <span style="color: red">*</span>:
                                            </label>
                                            <input type="text" class="form-control" id="subjectname" name="subjectname" 
                                                   placeholder="Enter Subject Name">
                                        </div>	
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="insertsubject(this);">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $this->load->view('includejs');
            ?>
            <script type="text/javascript">
                var baseurl = '<?php echo base_url(); ?>';
            </script>
            <script src="<?php echo base_url(); ?>www/js/subject.js"></script>
    </body>
</html>