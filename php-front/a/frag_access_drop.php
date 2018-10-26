<option value="">--Select--</option>
<?php 
$query="SELECT DISTINCT access from cluster";
// echo $query;
$resultfaculties=mysqli_query($conn,$query);
while($rowfaculties = $resultfaculties->fetch_assoc())
{ 
    $access = htmlspecialchars($rowfaculties['access']);
?>
<option value="<?php echo $access; ?>"><?php echo $access; ?></option>
<?php } ?>