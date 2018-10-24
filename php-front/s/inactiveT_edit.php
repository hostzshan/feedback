<?php include "../php-back/functions.php"; ?>
<form role="form" action="javascript:void(0)" onsubmit="return false;" class="ajaxsubmitform" id="feedback" >
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
                <div class="col-sm-2">
                    <input id="<?php echo $faculty_id.$param_count; ?>_score" name="<?php echo $faculty_id.$param_count; ?>_score" type="text" pattern="[0-9]|10" class="form-control" required />
                </div>
                <div class="col-sm-7 scorer" data-qname="<?php echo $faculty_id.$param_count; ?>">
                        <i class="btn btn-default">10</i>
                        <i class="btn btn-default">9</i>
                        <i class="btn btn-default">8</i>
                        <i class="btn btn-default">7</i>
                        <i class="btn btn-default">6</i>
                        <i class="btn btn-default">5</i>
                        <i class="btn btn-default">4</i>
                        <i class="btn btn-default">3</i>
                        <i class="btn btn-default">2</i>
                        <i class="btn btn-default">1</i>
                        <i class="btn btn-default">0</i>
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
<div id="response"></div>
		<div class="row form-group">
			<div class="col-sm-offset-5 col-sm-2">
			     <button type="submit" class="btn btn-info col-sm-8 col-sm-offset-2">
					<span class="glyphicon glyphicon-paste"></span>
					<br class="hidden-lg hidden-sm hidden-xs"></br>					
					<span class="hidden-sm">Submit</span>
				 </button>
			</div>
        </div>
</form>


<script>
    $('#feedback').zform();
    $('.scorer i').on('click',function(){
        var score=parseInt($(this).html());
        $(this).addClass("btn-success");
        $(this).removeClass("btn-default");
        $(this).prevUntil().removeClass("btn-success");
        $(this).prevUntil().addClass("btn-default");
        $(this).nextUntil().removeClass("btn-default");
        $(this).nextUntil().addClass("btn-success");
        var str=$(this).parent().data('qname');
        $('#'+str+'_score').val(score);
        $('#'+str+'_score').trigger('change');
    });
    $('#faculty00_score,#faculty01_score,#faculty10_score,#faculty11_score').on('keyup',function(e){
        var score=parseInt($(this).val());
        $(this).closest('div.row.form-group').find('.scorer i').each(function(){
            if(parseInt($(this).html())==score)
            {
                $(this).click();
            }
        });
    });
</script>