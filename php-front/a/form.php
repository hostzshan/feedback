<?php
$query="SELECT feedback_code FROM form_info ORDER BY created";
// echo $query;
$resultaccess=mysqli_query($conn,$query);
?>

<div class="panel panel-danger">
	<div class="panel-heading" data-toggle="collapse" data-target="#available" style="font-size:150%;"><b>Feedback Forms</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="available">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Feedback Name</th>
                    <th>Field(s) / Faculties</th>
                    <th>Allowed Users</th>
                    <th>Status</th>
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
                    <td><?php echo $i;?></td>
                    <td><?php echo $feedback_desc; ?></td>
                    <td class="playground">
                        <button type="submit" class="btn btn-xs btn-warning z-optionbtn" data-target=".z-optionbox.z-i0<?php echo $i;?>" style="float:left;">
                            <span class="glyphicon glyphicon-list-alt"></span> Options
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i0<?php echo $i;?>" data-requester='trinket' data-fragment='facultyt' style="display:none;">
                                <li class="z-option" data-facultyt="edit&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Form as Student"><span class="glyphicon glyphicon-edit"></span><br>Edit</li>
                                <li class="z-option" data-facultyt="preview&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Preview as Student"><span class="glyphicon glyphicon-eye-open"></span><br>Preview</li>
                            </ul>
                        </div>
                    </td>
                    <td class="playground">
                        <button type="submit" class="btn btn-xs btn-info z-optionbtn" data-target=".z-optionbox.z-i1<?php echo $i;?>" style="float:left;">
                            <span class="glyphicon glyphicon-user"></span> Options
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i1<?php echo $i;?>" data-requester='trinket' data-fragment='accesst' style="display:none;">
                                <li class="z-option" data-accesst="edit&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Form as Student"><span class="glyphicon glyphicon-edit"></span><br>Edit</li>
                                <li class="z-option" data-accesst="preview&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Preview as Student"><span class="glyphicon glyphicon-eye-open"></span><br>Preview</li>
                            </ul>
                        </div>
                    </td>
                    <td class="feedbackstatus">
                        <button type="submit" class="btn btn-xs btn-danger z-optionbtn" data-target=".z-optionbox.z-i2<?php echo $i;?>" style="float:left;">
                            <span class="glyphicon glyphicon-cog"></span> Settings
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i2<?php echo $i;?>" data-requester='status' data-fragment='type' data-control='<?php echo $feedback_code; ?>' style="display:none;">
                                <li class="z-option" data-type="feedback&status=a" title="Change Feedback Status to Active"><span class="glyphicon glyphicon-ok-circle"></span> Activate</li>
                                <li class="z-option" data-type="feedback&status=n" title="Change Feedback Status to Disabled"><span class="glyphicon glyphicon-ban-circle"></span> Disable</li>
                                <!-- <li class="z-option" data-type="feedback&status=c" title="Change Feedback Status to Closed"><span class="glyphicon glyphicon-ban-circle"></span> Close</li> -->
                            </ul>
                        </div>
                    </td>
                </tr>
<?php 
$i++;
}
?>
				<tr>
					<td colspan="10">
                        <form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" id="newform">
                            <div class="">
                                <label for="feedback_desc" class="col-sm-1 control-label" style="color:#337ab7; font-size:14px">Description</label>
                                <div class="input-group col-sm-11">
                                    <input id="feedback_desc" name="feedback_desc" type="text" class="form-control" required />
                                    <span onclick="triggersubmit(this)" class="input-group-addon btn btn-danger alert-danger">
                                        <span class="glyphicon glyphicon-plus"></span>				
                                        <span>Add New Form</span>
                                    </span>
                                </div>
                            </div>
                        </form>
					</td>
				</tr>
            </tbody>
        </table>

    </div>
</div>


<div class="panel panel-danger">
	<div class="panel-heading" data-toggle="collapse" data-target="#trinket" style="font-size:150%;"><b>Feedback Form Editor</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="trinket">
		
	</div>
</div>

<div id="response"></div>

<div class="panel panel-danger">
	<div class="panel-heading" data-toggle="collapse" data-target="#formeditor" style="font-size:150%;"><b>Feedback Form Editor - Manual</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse one" id="formeditor">
	    <form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal" id="multiform" >
            <div class="row form-group">
	            <label for="control" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Feedback</label>
	            <div class="col-sm-10">
                    <select class="form-control" id="control" name="control" required>
                        <?php include 'frag_form_drop.php';?>
	        		</select>
	        	</div>
	        </div>
	        <div class="row form-group">
	        	<label for="parameter" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Action Helper</label>
	        	<div class="col-sm-10">
                    <select class="form-control" id="parameter" name="parameter" required>
                        <option value="new">Assign Access/Add Faculty</option>
	        			<?php include 'frag_field_drop.php';?>
	        			<?php include 'frag_access_drop.php';?>
	        		</select>
	        	</div>
	        </div>
	        <div class="row form-group">
	        	<label for="access" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Group/Access</label>
	        	<div class="col-sm-10">
                    <select class="form-control" id="access" name="access">
	        			<?php include 'frag_access_drop.php';?>
	        		</select>
	        	</div>
	        </div>
	        <div class="row form-group">
                <label for="faculty_id" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Field/Faculty</label>
	        	<div class="col-sm-10">
                    <select class="form-control" id="faculty_id" name="faculty_id">
	        			<?php include 'frag_field_drop.php';?>
	        		</select>
	        	</div>
	        </div>
	        <div class="row form-group">
	        	<label for="faculty_desc" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Field/Faculty Description</label>
	        	<div class="col-sm-10">
                    <input type="text" class="form-control" id="faculty_desc" name="faculty_desc">
	        	</div>
	        </div>
	        <div class="row form-group">
	        	<label for="type" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Action Type</label>
	        	<div class="col-sm-10">
                    <select class="form-control" id="type" name="type" required>
	        			<option value="">--Select--</option>
	        			<option value="faculty">Field/Faculty</option>
	        			<option value="access">Group/Access</option>
	        			<option value="form">Feedback Form</option>
	        		</select>
	        	</div>
	        </div>
	        <div class="row form-group">
	        	<label for="action" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Action</label>
	        	<div class="col-sm-10">
                    <select class="form-control" id="action" name="action" required>
	        			<option value="">--Select--</option>
	        			<option value="delete">Delete</option>
	        			<option value="add">Add</option>
	        			<option value="edit">Edit</option>
	        		</select>
	        	</div>
	        </div>
            <div class="row form-group">
                <button type="submit" class="col-sm-2 col-sm-offset-5 btn btn-danger">
                    <span class="glyphicon glyphicon-send"></span> Submit
                </button>
            </div>
        </form>
	</div>
</div>


<script>
    $(".z-optionbtn").zoption();
    $(".playground").fragmentLoader("trinket");
    $(".feedbackstatus").zstatusUpdater('feedback');
    $("#multiform").zform();
    $(".ajaxsubmitform").zform();
</script>

