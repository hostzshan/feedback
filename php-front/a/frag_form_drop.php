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