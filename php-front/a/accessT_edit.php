<?php include "../php-back/functions.php";$i=1; ?>
<div class="form-group input-group has-warning">
	<span class="input-group-addon">Feedback Name</span>
    <input id="feedback_name" type="text" class="form-control text-center" value="<?php $feedback_desc = getdescription($conn,"feedback",$feedback_code); echo $feedback_desc?>" readonly required />
</div>
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
		<tr>
			<td colspan="10">
                <div class="col-sm-10">
                    <select data-name="access_code" class="form-control">
	        	    	<?php include 'frag_access_drop.php';?>
	        	    </select>
                </div>
                <button data-action="add" data-parameter="<?php echo $faculty_id; ?>" data-type="access" type="submit" class="col-sm-2 btn btn-danger zmultisubmit">
                    <span class="glyphicon glyphicon-plus"></span>
					<span>Add New</span>
				</button>			
			</td>
		</tr>
    </tbody>
</table>

<script>
    $("#control").val('<?php echo $feedback_code; ?>');
    $(".zmultisubmit").zformmultisubmit();
</script>