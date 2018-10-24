<?php include "../php-back/functions.php"; ?>
<div class="form-group input-group has-warning">
	<span class="input-group-addon">Feedback Code</span>
    <input id="feedback_code" name="feedback_code" type="text" class="form-control text-center" value="<?php echo $feedback_code?>" readonly required />
</div>
<?php 
$faculty_count=0;
while($faculty_ids = $resultform->fetch_assoc())//initialised in feedbackT.php
{
    $param_count=0;
    $faculty_id=$faculty_ids['faculty_id'];
    ?>
        <div class="row">
            <div class="col-sm-4">
                <label class="col-sm-6">
                <?php
                $faculty_name=getdescription($conn,'username',$faculty_id);
                echo $param_count==0?$faculty_name:'';
                $feedback_data=getfeedbackdata($conn,$faculty_id,$feedback_code,$feedback_params);
                ?>
                </label>
                <label class="col-sm-6 text-primary"><?php echo $param_count==0?$faculty_ids['faculty_desc']:''; ?></label>
            </div>
            <div class="col-sm-8">
    <?php
    foreach($feedback_params as $feedback_param)
    {
?>
        
            
            <div class="row form-group">
                <label for="<?php echo $faculty_id.$param_count; ?>_score" class="col-sm-3 control-label text-muted" style="font-size:14px"><?php echo $feedback_param; ?></label>
                <div class="col-sm-9">
                    <?php echo $feedback_data[$feedback_param];?>
                </div>
            </div>
                
            
<?php
++$param_count;
}
?>
                </div>
            </div>
<hr>
<?php
++$faculty_count;
}
?>
