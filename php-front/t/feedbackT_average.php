<?php include "../php-back/functions.php"; ?>
<div class="form-group input-group has-warning">
	<span class="input-group-addon">Feedback Name</span>
    <div id="feedback_name" type="text" class="form-control text-center"><?php $feedback_desc = getdescription($conn,"feedback",$feedback_code); echo $feedback_desc?></div>
</div>
<?php 
$faculty_count=0;
$feedback_data_total=array();
$total=0;
if($faculty_ids = $resultform->fetch_assoc())//initialised in feedbackT.php
{
    $param_count=0;
    $faculty_id=$faculty_ids['faculty_id'];
    ?>
        <div class="row">
            <div class="col-sm-3">
                <?php
                $feedback_data=getconsolidatedfbdata($conn,$faculty_id,$feedback_code,$feedback_params);
                ?>
                <label class="col-sm-12 text-primary"><?php echo $param_count==0?$faculty_ids['faculty_desc']:''; ?></label>
            </div>
            <div class="col-sm-9">
<?php
    foreach($feedback_params as $feedback_param)
    {
        $obtained=array_key_exists($feedback_param,$feedback_data)?$feedback_data[$feedback_param]:0;
        $n=$feedback_data['n'];
        $y_max=$feedback_data['y-max'];
        $max=$y_max*$n;
        $good=$feedback_data['good'];
        $average=$feedback_data['average'];
        $good_n=array_key_exists($feedback_param.'good-n',$feedback_data)?$feedback_data[$feedback_param.'good-n']:0;
        $average_n=array_key_exists($feedback_param.'average-n',$feedback_data)?$feedback_data[$feedback_param.'average-n']:0;
        $bad_n=array_key_exists($feedback_param.'bad-n',$feedback_data)?$feedback_data[$feedback_param.'bad-n']:0;
        $total+=$obtained;
?>
            <div class="row form-group">
                <label class="col-sm-3 control-label text-muted" style="font-size:14px"><?php echo $feedback_param; ?></label>
                <div class="col-sm-9">
                        <div class="col-sm-10">
                            <div class="z-progress progress">
                                <?php
                                if($n!=0){ 
                                $ratio=$obtained/$max;
                                ?>
                                <div class="progress-bar" role="progressbar" data-ratio="<?php echo $ratio; ?>">
                                    <?php echo substr($ratio*10,0,5); ?>
                                </div>
                                <?php }
                                else {?>
                                <div class="progress-bar error" role="progressbar" data-ratio="1">
                                    <?php echo 'Empty'; ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-control"><?php echo $n; ?></div>
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

            <div class="row form-group">
                <label class="col-sm-2 control-label text-danger" style="font-size:14px">Overall Score</label>
                <div class="col-sm-10">
                    <div class="col-sm-12">
                        <div class="z-progress progress">
                            <?php 
                            if($n!=0){  
                            $ratio=$total/($max*$param_count);
                            ?>
                            <div class="progress-bar" role="progressbar" data-ratio="<?php echo $ratio; ?>">
                                <?php echo substr($ratio*10,0,5); ?>
                            </div>
                            <?php }
                            else {?>
                            <div class="progress-bar error" role="progressbar" style="width:100%;">
                                <?php echo 'Empty'; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
<?php
}
?>

<script>
$('.z-progress').zprogressbar(<?php echo $good; ?>,<?php echo $average; ?>,<?php echo $y_max; ?>);
</script>