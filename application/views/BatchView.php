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
            'title' => 'Batch'
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
                    <div class="card-header"><br><div class="pull-right"><button class="btn btn-primary " data-toggle="modal" 
                                                                                 onclick="addBatch();" ><i class="fa fa-plus-square"></i></button> 
                            <button class="btn btn-primary"  onclick=refresh();><i class="fa fa-refresh"></i></button></div>

                        <div class="pull-left">                                                    
                            <div class="form-group">
                                <select id="assesmentid" class="form-control" name="assesmentid">
                                    <option value=''>-- Select Assessment Year --</option>
                                    <?php
                                    foreach ($assessment_year as $row) {
                                        echo "<option value='" . $row['assessment_year_id'] . "'>" . $row['assessment_year'] . "</option>";
                                    }
                                    ?></select></div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="container">
                        <table id="table1" class="table table-striped table-bordered ">
                            <thead align="center">
                                <tr>
                                    <th>Edit</th>
                                    <th>Batch Code</th>
                                    <th>Batch Name</th> 
                                    <th>Strength</th> 
                                    <th>Assessment Year</th> 
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                        </table>
                    </div>
                    <div class="modal fade" tabindex="-1" role="dialog" id="addBatch">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Batch</h4>
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
                                            <input type="hidden" class="form-control"  name="batchid" id="batchid">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control"  name="assessmentyearid" id="assessmentyearid">
                                        </div>
                                        <div class="form-group">
                                            <label for="batchcode">Batch Code <span style="color: red">*</span>: </label>
                                            <input type="text" class="form-control" id="batchcode" name="batchcode" 
                                                   placeholder="Enter Batch Code">
                                        </div>
                                        <div class="form-group">
                                            <label for="batchname">Batch Name <span style="color: red">*</span>:</label>
                                            <input type="text" class="form-control" id="batchname" name="batchname" 
                                                   placeholder="Enter Batch Name">
                                        </div>	
                                        <div class="form-group">
                                            <label for="batchstrength">Strength<span style="color: red">*</span>:</label>
                                            <input type="text" class="form-control" id="batchstrength" name="batchstrength" 
                                                   placeholder="Enter Strength">
                                        </div>               
                                        <div class="form-group">
                                             <label for="assessmentyear">Assessment Year<span style="color: red">*</span>:</label><br>
                                            <select id="assessmentyear" class="form-control" name="assessmentyear">
                                                <option value=''>-- Select Assessment Year --</option>
                                                <?php                                                                                               
                                               foreach ($assessment_year as $row) {
                                                    echo "<option value='" . $row['assessment_year_id'] . "'>" . $row['assessment_year'] . "</option>";
                                                }
                                                ?></select>                              
                                        </div><br>                                         
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="insertbatch(this);">Save Changes</button>
                                        </div>           
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
            <script src="<?php echo base_url(); ?>www/js/batch.js?v=1.0.0"></script>
        </div>
    </body>
</html>