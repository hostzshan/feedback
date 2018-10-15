<?php include "../php-back/functions.php"; ?>
<div class="form-group input-group has-warning">
	<span class="input-group-addon">Feedback Name</span>
    <input id="feedback_name" type="text" class="form-control text-center" value="<?php $feedback_desc = getdescription($conn,"feedback",$feedback_code); echo $feedback_desc?>" readonly required />
</div>
<?php 
$faculty_count=0;
$feedback_data_total=array();
while($faculty_ids = $resultform->fetch_assoc())//initialised in feedbackT.php
{
    $param_count=0;
    $faculty_id=$faculty_ids['faculty_id'];
    ?>
        <div class="row">
            <div class="col-sm-3">
                <?php
                $feedback_data=getfeedbackdata($conn,$faculty_id,$feedback_code,$feedback_params);
                ?>
                <label class="col-sm-12 text-primary"><?php echo $param_count==0?$faculty_ids['faculty_desc']:''; ?></label>
            </div>
            <div class="col-sm-9">
<?php
    foreach($feedback_params as $feedback_param)
    {
        if (array_key_exists($feedback_param, $feedback_data_total)) {
            $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param,$feedback_data_total[$feedback_param]+$feedback_data[$feedback_param]);
        }
        else{
            $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param,$feedback_data[$feedback_param]);
        }
?>
            <div class="row form-group">
                <label class="col-sm-3 control-label text-muted" style="font-size:14px"><?php echo $feedback_param; ?></label>
                <div class="col-sm-9">
                    
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" id="appid_sent" role="progressbar" style="width:34%;">
                                Sent Successfully: 0/0
                            </div>
                            <div class="progress-bar progress-bar-warning" id="appid_exists" role="progressbar" style="width:33%;">
                                Already Exists: 0/0
                            </div>
                            <div class="progress-bar progress-bar-danger" id="appid_error" role="progressbar" style="width:33%;">
                                Network Error: 0/0
                            </div>
                            <div class="progress-bar progress-bar-danger" id="appid_error" role="progressbar" style="width:100%;">
                                Select a manager and applications to send
                            </div>
                        </div>
                    
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
