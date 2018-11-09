<?php include "../php-back/functions.php";$i=1; ?>
<div class="form-group input-group has-warning">
	<span class="input-group-addon">Feedback Name</span>
    <div id="feedback_name" type="text" class="form-control text-center"><?php $feedback_desc = getdescription($conn,"feedback",$feedback_code); echo $feedback_desc?></div>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S. No.</th>
            <th>Field(s) / Faculties</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
while($rowform = $resultform->fetch_assoc())
{
?>
            <tr>
                <?php
                $faculty_id = htmlspecialchars($rowform['faculty_id']);
                $faculty_name = getdescription($conn,"username",$faculty_id);
                $faculty_desc = getfielddetail($conn,"faculty",$feedback_code,$faculty_id);
                ?>
                <td><?php echo $i++; ?></td>
                <td><?php echo $faculty_name; ?></td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Description" data-name="faculty_desc" value="<?php echo $faculty_desc; ?>" >
                        <span class="input-group-addon alert-info btn btn-info zmultisubmit" type="submit" data-action="edit" data-parameter="<?php echo $faculty_id; ?>" data-type="faculty">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </span>
                    </div>
                </td>
                <td>
                    <button data-action="delete" data-parameter="<?php echo $faculty_id; ?>" data-type="faculty" type="submit" class="btn btn-danger zmultisubmit">
                        <span class="glyphicon glyphicon-trash"></span>
                        <span>Remove</span>
                    </button>
                </td>
            </tr>
<?php 
}
?>
		<tr>
			<td colspan="10">
                <div class="input-group">
                    <select data-name="faculty_id" class="form-control">
	        	        <?php include 'frag_field_drop.php';?>
	        	    </select>
                    <span data-action="add" data-parameter="new" data-type="faculty" type="submit" class="input-group-addon btn btn-danger zmultisubmit">
                        <span class="glyphicon glyphicon-plus"></span> Add New
				    </span>			
                </div>
			</td>
		</tr>
    </tbody>
</table>

<script>
    $("#control").val('<?php echo $feedback_code; ?>');
    $(".zmultisubmit").zformmultisubmit();
</script>