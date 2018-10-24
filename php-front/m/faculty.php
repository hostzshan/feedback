<?php
$query="SELECT username FROM regist where usertype='t'";
// echo $query;
$resultaccess=mysqli_query($conn,$query);
?>

<div class="panel panel-danger">
	<div class="panel-heading" data-toggle="collapse" data-target="#available" style="font-size:150%;"><b>Faculties</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
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
$i=1;
while($rowaccess = $resultaccess->fetch_assoc())
{
?>
                <tr>
                    <?php
                    $faculty_id = htmlspecialchars($rowaccess['username']);
                    $faculty_desc = getdescription($conn,"username",$faculty_id);
                    ?>
                    <td><?php echo $i;?></td>
                    <td><?php echo $faculty_desc; ?></td>
                    <td class="playground">
                        <button type="submit" class="btn btn-danger z-optionbtn" data-target=".z-optionbox.z-i0<?php echo $i;?>" style="float:left;">
                            <span class="glyphicon glyphicon-cog"></span>
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i0<?php echo $i;?>" data-requester='trinket' data-fragment='facultyt' style="display:none;">
                                <li class="z-option" data-facultyt="total&faculty_id=<?php echo $faculty_id; ?>" title="View Total Feedback Data Showing Total Scores"><span class="glyphicon glyphicon-edit"></span><br>Total/Raw</li>
                                <li class="z-option" data-facultyt="average&faculty_id=<?php echo $faculty_id; ?>" title="View Total Feedback Data Showing Average Scores"><span class="glyphicon glyphicon-eye-open"></span><br>Average</li>
                                <li class="z-option" data-facultyt="insight&faculty_id=<?php echo $faculty_id; ?>" title="See Interesting Insights"><span class="glyphicon glyphicon-eye-open"></span><br>Insights</li>
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
	<div class="panel-heading" data-toggle="collapse" data-target="#trinket" style="font-size:150%;"><b>Data</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="trinket">
		
	</div>
</div>


<script>
    $(".z-optionbtn").zoption();
    $(".playground").fragmentLoader('trinket');
    
</script>

