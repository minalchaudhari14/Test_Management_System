  

<div class="container">
    <div class="card ">
        <div class="card-header ">

            <div class="row">
<!-- <p class="ex1"><div class="form-group">
                               <select id="typeofque"  class="form-control">
        <option value=''>-- Select subject --</option>
        <?php 
       //foreach($subject_name as $subject_name){
       // echo "<option value='".$subject_name."'>".$subject_name."</option>";
       //  }
        ?>
</select></div></p> -->
                <p class="ex1">
                <div class="form-group">
                    <label for="level">Subject Name<span style="color: red">*</span> :</label>  <?php echo form_dropdown('subject_name', $subject_name, '', 'class="form-control" id="list"'); ?>
                </div>
                </p> 
                <p class="ex1"><div class="form-group">
                    <label for="level">Difficulty Level<span style="color: red">*</span> :</label>                  <?php echo form_dropdown('difficulty_level_name', $difficulty_level_name, '', 'class="form-control" '); ?> 
                    <div class="invalid-feedback">Please Select The Difficulty Level</div>
                </div></p>


 <!--  <p class="ex1"><div class="form-group">
     <label for="level">Select Type Of Question<span style="color: red">*</span> :</label>
     <select class="form-control" id="demo">
      </select>
  </div></p> -->
<!--   <p class="ex1"><div class="form-group">
                             <select id="typeofque" class="form-control">
 <option value=''>-- Select Type of Question --</option>
  <?php 
        //foreach($description as $description){
         // echo "<option value='".$description."'>".$description."</option>";
        //}
        ?></select></div></p> -->
<!--  <p class="ex1"><div class="form-group">
                             <select id="typeofque" class="form-control">

  <?php //foreach ($description as $description): ?>
                                <option <?php //echo(!empty($data->$type_of_question_id) and $data->$type_of_question_id == $description['description']) ? 'selected' : '';?> value="<?php// echo  $description['description']; ?>"><?php //echo  $description//['description']; ?></option>
                           <?php //endforeach ?>
</select></div></p> -->

<!--  <p class="ex1"><div class="form-group">
                             <select id="typeofque" class="form-control">
 <option value=''>-- Select Type of Question --</option>
 <?php 
 //$type_of_question_id=1; //of course don't hardcode it
//$selected = $row->$type_of_question_id// == $type_of_question_id ?// 'selected' : '';
?>
<option value="<?php //echo $description->type_of_question_id; ?>" <?php //echo $selected; ?>> <?php// echo $description->description; ?> </option>
 $type_of_question_id++;
<?php //endforeach; ?>
</select></div></p> -->
<!--
<p class="ex1"><div class="form-group">
                             <select id="typeofque" class="form-control">
 <option value='' >-- Select Type of Question --</option>
  <?php 
  $a=1;
   $type_of_question_id=1;
  
        foreach($description as $description){
        
         echo "<option value='".$type_of_question_id."'".(($type_of_question_id==$a)? 
          "selected='selected'":"").">".$description."</option>";
         
           $type_of_question_id++;
             
       //  if(questionType == 1;
       //  {
       //   $description="selected";
       //  }
       }
        ?></select></div></p>  -->
 




            <p class="ex1"><div class="form-group col-md-3">

                    <label for="level">Type Of Question<span style="color: red">*</span> :</label>                  
                    <?php 
                   echo form_dropdown('description', $description, '', 'class="form-control" id="typeofque" ');
                    ?> 
                </div></p>   
                
            </div>

        </div>
    </div>
</div>

