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
'title' => 'Student Info'
);
?>
<div class="wrapper d-flex align-items-stretch">
<?php
$this->load->view('sidebar', $user_data);
?>
<?php
$this->load->view('header', $user_data);
?>
</head>
<body style="background-color: white;">
<form action="stud_doc_view_page" id="adddoc" method="POST">
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-8">
<div class="card">
<div class="card-header" >
<center><h5>Add Student Document</h5></center>
<div class="pull-right"><a class="btn btn-primary"
href="<?php echo base_url();?>Add/<?php echo $studentName->student_id?>"><i class="fa fa-close"></i></a></div>
</div>
<div class="card-body">
<div class="form-group">
<input type="hidden" class="form-control" name="student_doc_id" id="student_doc_id" value="<?php echo(!empty($studentDocName->student_doc_id)) ? $studentDocName->student_doc_id:'';?>">
<div class="form-group">
<input type="hidden" name="student_id" id="student_id" value="<?php echo(!empty($studentName->student_id)) ? $studentName->student_id:'';?>">
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-md-6">
<div class="form-group ">
<label for='student_doc_name'style="color: black">Document Name<span style="color: red">*</span></label>
<input type="text" name="student_doc_name" placeholder="Enter The Document" class="form-control" >
</div>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="body" >select Image<span style="color: red">*</span></label>

<?php echo "<input type='file' name='student_document_path' size='20' id='student_document_path' />"; ?>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="pull-right" >
<button type="button" onclick="studDocValid(this);" class="btn btn-primary" style="background-color: orange;">Submit</button>
</div>
</div>
</div>
</div>
<div class="col-md-2"></div>
</form>
</div>
</body>
<script type="text/javascript" src="<?php echo base_url();?>www/js/studDocValidation.js"></script>
<?php
$this->load->view('includejs');
?>
</html>