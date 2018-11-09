<div id="response"></div>
<form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" id="accesscode">
<div class="panel panel-danger">
	<div class="panel-heading" data-toggle="collapse" data-target="#one" style="cursor:pointer;font-size:150%;"><b>Create</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="one">
		<div class="row form-group">
			<label for="department" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Department</label>
                <div class="col-sm-10">
                    <select required class="form-control" id="department" name="department">
                        <option value="">--Select--</option>
                        <option value="CS">Computer Science and Engineering</option>
                        <option value="ME">Mechanical Engineering</option>
                        <option value="EN">Electronics and Communication</option>
                        <option value="EC">Electrical and Electronics Engineering</option>
                        <option value="IT">Information Technology</option>
                        <option value="CE">Civil Engineering</option>
                    </select>
                </div>
		</div>
		<div class="row form-group">
			<label for="batch" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Batch (Year of passing)</label>
                <div class="col-sm-10">
                    <select required class="form-control" id="batch" name="batch">
                        <option value="">--Select--</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
		</div>
		<div class="row form-group">
			<label for="section" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Section</label>
                <div class="col-sm-10">
                    <select class="form-control" id="section" name="section">
                        <option value="">--Select--</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
		</div>
		<div class="row form-group">
			<label for="allowed_users" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Allowed Users</label>
			<div class="col-sm-10">
				<input id="allowed_users" name="allowed_users" type="text" class="form-control" required />
			</div>
        </div>
        <div class="row form-group">
			<label for="sub_section" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Group</label>
			<div class="col-sm-10">
				<input id="sub_section" name="sub_section" type="text" class="form-control" />
			</div>
        </div>
		<div class="row form-group">
			<div class="col-sm-offset-5 col-sm-2">
			     <button type="submit" class="btn btn-danger col-sm-8 col-sm-offset-2">
					<span class="glyphicon glyphicon-floppy-disk"></span>
					<br class="hidden-lg hidden-sm hidden-xs">					
					<span class="hidden-sm">Continue</span>
				 </button>
			</div>
		</div>
	</div>
</div>
</form>

<div class="panel panel-danger">
	<div class="panel-heading" data-toggle="collapse" data-target="#two" style="cursor:pointer;font-size:150%;"><b>Predefined</b><span class="btn btn-danger pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="two">
        <?php
        $query="SELECT * from cluster WHERE access_code_desc='anchor' ORDER BY access_code";
        // echo $query;
        $resultaccess=mysqli_query($conn,$query);
        $i=1;
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Access Codes</th>
                    <th>Description</th>
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
                        $access_code = htmlspecialchars($rowaccess['access_code']);
                        $access_code_desc = getdescription($conn,"access_code",$access_code);
                        ?>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $access_code; ?></td>
                        <td><?php echo $access_code_desc; ?></td>
                        <td>
                            <button data-action="delete" data-parameter="<?php echo $access_code; ?>" data-type="access" type="submit" class="btn btn-danger zmultisubmit">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
        <?php 
        }
        ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(".ajaxsubmitform").zform();
</script>