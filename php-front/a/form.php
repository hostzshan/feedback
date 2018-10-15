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
                            <span class="glyphicon glyphicon-list-alt"></span>
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i0" data-requester='trinket' data-fragment='facultyt' style="display:none;">
                                <li class="z-option" data-facultyt="edit&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Form as Student"><span class="glyphicon glyphicon-edit"></span><br>Edit</li>
                                <li class="z-option" data-facultyt="preview&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Preview as Student"><span class="glyphicon glyphicon-eye-open"></span><br>Preview</li>
                            </ul>
                        </div>
                    </td>
                    <td class="playground">
                        <button type="submit" class="btn btn-danger z-optionbtn" data-target=".z-optionbox.z-i1" style="float:left;">
                            <span class="glyphicon glyphicon-user"></span>
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i1" data-requester='trinket' data-fragment='accesst' style="display:none;">
                                <li class="z-option" data-accesst="edit&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Form as Student"><span class="glyphicon glyphicon-edit"></span><br>Edit</li>
                                <li class="z-option" data-accesst="preview&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Preview as Student"><span class="glyphicon glyphicon-eye-open"></span><br>Preview</li>
                            </ul>
                        </div>
                    </td>
                    <td class="playground">
                        <button type="submit" class="btn btn-danger z-optionbtn" data-target=".z-optionbox.z-i2" style="float:left;">
                            <span class="glyphicon glyphicon-cog"></span>
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i2" data-requester='trinket' data-fragment='formt' style="display:none;">
                                <li class="z-option" data-formt="edit&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Form as Student"><span class="glyphicon glyphicon-edit"></span><br>Edit</li>
                                <li class="z-option" data-formt="preview&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Preview as Student"><span class="glyphicon glyphicon-eye-open"></span><br>Preview</li>
                            </ul>
                        </div>
                    </td>
                </tr>
<?php 
}
?>
				<tr>
					<td colspan="10">
						<button type="button" onclick="addmem(this)" name="" value="" class="btn btn-xs col-xs-12 btn-info" >
							<span class="glyphicon glyphicon-plus"></span>
							<span>Add New</span>
						</button>
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
	    <form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal" id="faculty" >
            <div class="row form-group">
	            <label for="control" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Feedback</label>
	            <div class="col-sm-10">
                    <select class="form-control" id="control" name="control" required>
	        			<option value="">--Select--</option>
                        <?php 
                        
                        $resultaccess->data_seek(0);
                        
                        while($rowforms = $resultaccess->fetch_assoc())
                        { 
                            $feedback_code = htmlspecialchars($rowforms['feedback_code']);
                            $feedback_desc = getdescription($conn,"feedback",$feedback_code);
                        ?>
	        			<option value="<?php echo $feedback_code; ?>"><?php echo $feedback_desc; ?></option>
	        			<?php } ?>
	        		</select>
	        	</div>
	        </div>
	        <div class="row form-group">
	        	<label for="parameter" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Faculty</label>
	        	<div class="col-sm-10">
                    <select class="form-control" id="parameter" name="parameter" required>
	        			<option value="">--Select--</option>
                        <?php 
                        $query="SELECT username from regist WHERE usertype='t'";
                        // echo $query;
                        $resultfaculties=mysqli_query($conn,$query);
                        while($rowfaculties = $resultfaculties->fetch_assoc())
                        { 
                            $faculty_id = htmlspecialchars($rowfaculties['username']);
                            $faculty_desc = getdescription($conn,"username",$faculty_id);
                        ?>
	        			<option value="<?php echo $faculty_id; ?>"><?php echo $faculty_desc; ?></option>
	        			<?php } ?>
	        		</select>
	        	</div>
	        </div>
	        <div class="row form-group">
	        	<label for="faculty_desc" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Faculty Description</label>
	        	<div class="col-sm-10">
                    <input type=text class="form-control" id="faculty_desc" name="faculty_desc">
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
    $("#faculty").zform();
</script>

