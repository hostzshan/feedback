<?php
$query="SELECT * from form WHERE feedback_code='$feedback_code' AND faculty_id='$username'";
// echo $query;
$resultform=mysqli_query($conn,$query);

// $feedback_params=array('Knowledge of subject','Communication skills');

    include 'feedbackT_'.$feedbackt.'.php';

?>


