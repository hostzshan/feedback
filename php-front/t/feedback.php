<?php
$query="SELECT feedback_code FROM form WHERE faculty_id='$username'";
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
                    <th>Feedback Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
while($rowaccess = $resultaccess->fetch_assoc())
{
?>
                <tr>
                    <?php
                    $feedback_code = htmlspecialchars($rowaccess['feedback_code']);
                    $feedback_desc = getdescription($conn,"feedback",$feedback_code);
                    ?>
                    <td>1</td>
                    <td><?php echo $feedback_desc; ?></td>
                    <td class="playground">
                        <button type="submit" class="btn btn-danger z-optionbtn" data-target=".z-optionbox.z-i0" style="float:left;">
                            <span class="glyphicon glyphicon-cog"></span>
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i0" data-requester='trinket' data-fragment='feedbackt' style="display:none;">
                                <li class="z-option" data-feedbackt="total&feedback_code=<?php echo $feedback_code; ?>" title="View Total Feedback Data Showing Total Scores"><span class="glyphicon glyphicon-edit"></span><br>Total/Raw</li>
                                <li class="z-option" data-feedbackt="average&feedback_code=<?php echo $feedback_code; ?>" title="View Total Feedback Data Showing Average Scores"><span class="glyphicon glyphicon-eye-open"></span><br>Average</li>
                                <li class="z-option" data-feedbackt="insight&feedback_code=<?php echo $feedback_code; ?>" title="See Interesting Insights"><span class="glyphicon glyphicon-eye-open"></span><br>Insights</li>
                            </ul>
                        </div>
                    </td>
                </tr>
<?php 
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
    $(".playground").fragmentLoader('trinket');
    
</script>

