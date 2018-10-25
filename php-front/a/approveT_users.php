<?php require_once "../php-back/functions.php";$i=1; ?>
<div id="user"></div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S. No.</th>
            <th>Username</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Section</th>
            <th>Access</th>
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
                $username = htmlspecialchars($rowform['username']);
                $username_desc = getdescription($conn,"username",$username);
                ?>
                <td><?php echo $i++; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $username_desc; ?></td>
                <td><?php echo htmlspecialchars($rowform['batch']); ?></td>
                <td><?php echo htmlspecialchars($rowform['section']); ?></td>
                <td><?php echo htmlspecialchars($rowform['access']); ?></td>
                <td class="userstatus">
                    <button type="submit" class="btn btn-xs btn-danger z-optionbtn" data-target=".z-optionbox.z-i0<?php echo $i;?>" style="float:left;">
                        <span class="glyphicon glyphicon-cog"></span> Settings
                    </button>
                    <div class="col-xs-12" style="float:left;position:relative">
                        <ul class="z-optionbox z-i0<?php echo $i;?>" data-requester='status' data-fragment='type' data-control='<?php echo $username; ?>' style="display:none;">
                            <li class="z-option" data-type="user&status=t" title="Change User Status to Active"><span class="glyphicon glyphicon-ok-circle"></span> Activate</li>
                            <li class="z-option" data-type="user&status=f" title="Change User Status to Disabled"><span class="glyphicon glyphicon-ban-circle"></span> Disable</li>
                        </ul>
                    </div>
                </td>
            </tr>
<?php 
}
?>
    </tbody>
</table>

<script>
    $(".z-optionbtn").zoption();
    $(".userstatus").zstatusUpdater('user');
    // $("#control").val('<?php echo ''; ?>');
    $(".zmultisubmit").zformmultisubmit();

</script>