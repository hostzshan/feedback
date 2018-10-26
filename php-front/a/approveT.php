<?php
$query="SELECT regist.username,cluster.section,cluster.batch,cluster.access from regist INNER JOIN cluster WHERE regist.access_code=cluster.access_code AND cluster.department='$approvet' AND regist.usertype='s' AND cluster.access_code_desc='anchor' ORDER BY regist.username";
// echo $query;
$resultform=mysqli_query($conn,$query);

// $feedback_params=array('Knowledge of subject','Communication skills');

    include 'approveT_users.php';

?>