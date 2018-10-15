<?php
$query="SELECT * from form WHERE feedback_code='$feedback_code' ORDER BY faculty_id";
// echo $query;
$resultform=mysqli_query($conn,$query);

// $feedback_params=array('Knowledge of subject','Communication skills');

    include 'facultyT_'.$facultyt.'.php';

?>