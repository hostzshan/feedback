<?php
$query="SELECT DISTINCT regist.username,cluster.section,cluster.batch,regist.access from regist INNER JOIN cluster WHERE regist.access=cluster.access AND cluster.department='$approvet' AND regist.usertype='s' ORDER BY regist.username";
// echo $query;
$resultform=mysqli_query($conn,$query);

// $feedback_params=array('Knowledge of subject','Communication skills');

    include 'approveT_users.php';

?>