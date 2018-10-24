<option value="">--Select--</option>
<?php 
$query="SELECT access_code from cluster";
// echo $query;
$resultfaculties=mysqli_query($conn,$query);
while($rowfaculties = $resultfaculties->fetch_assoc())
{ 
    $faculty_id = htmlspecialchars($rowfaculties['access_code']);
    $faculty_desc = getdescription($conn,"access_code",$faculty_id);
?>
<option value="<?php echo $faculty_id; ?>"><?php echo $faculty_desc.'('.$faculty_id.')'; ?></option>
<?php } ?>