<?php
$query="SELECT form_info.feedback_code FROM regist INNER JOIN access INNER JOIN form_info ON regist.access_code=access.access_code AND access.feedback_code=form_info.feedback_code WHERE regist.username='$username' and feedback_status='a'";
// echo $query;
$resultaccess=mysqli_query($conn,$query);
?>

<div class="panel panel-danger">
	<div class="panel-heading" data-toggle="collapse" data-target="#available" style="font-size:150%;"><b>Active</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="available">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Feedback Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
$i=1;
while($rowaccess = $resultaccess->fetch_assoc())
{
?>
                <tr>
                    <?php
                    $feedback_code = htmlspecialchars($rowaccess['feedback_code']);
                    $feedback_desc = getdescription($conn,"feedback",$feedback_code);
                    ?>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $feedback_desc; ?></td>
                    <td class="playground">
                        <button type="submit" class="btn btn-danger z-optionbtn" data-target=".z-optionbox.z-i0<?php echo $i; ?>" style="float:left;">
                            <span class="glyphicon glyphicon-cog"></span>
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i0<?php echo $i; ?>" data-requester='trinket' data-fragment='feedbackt' style="display:none;">
                                <li class="z-option" data-feedbackt="edit&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Form as Student"><span class="glyphicon glyphicon-edit"></span><br>Edit</li>
                                <li class="z-option" data-feedbackt="preview&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Preview as Student"><span class="glyphicon glyphicon-eye-open"></span><br>Preview</li>
                            </ul>
                        </div>
                    </td>
                </tr>
<?php 
$i++;
}
?>
            </tbody>
        </table>
    </div>
</div>


<div class="panel panel-danger">
	<div class="panel-heading" data-toggle="collapse" data-target="#trinket" style="font-size:150%;"><b>Feedback Form</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="trinket">
		
	</div>
</div>


<script>
    $(".z-optionbtn").zoption();
    $(".playground").fragmentLoader("trinket");
    
</script>

