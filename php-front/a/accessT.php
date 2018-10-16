<?php
$query="SELECT * from access WHERE feedback_code='$feedback_code' ORDER BY access_code";
// echo $query;
$resultaccess=mysqli_query($conn,$query);

// $feedback_params=array('Knowledge of subject','Communication skills');

    include 'accessT_'.$accesst.'.php';

?>