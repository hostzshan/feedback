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