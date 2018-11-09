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
while($rowforms = $resultforms->fetch_assoc())
{
?>
                <tr>
                    <?php
                    $feedback_code = htmlspecialchars($rowforms['feedback_code']);
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