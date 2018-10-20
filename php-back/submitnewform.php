<?php
include 'functions.php';
include 'connection.php';
// include 'f_faculty_validate.php';

session_start();
$error_main='Form Action Failed';
$success_main='Form Action Succeded';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    extract($_POST);//get all post parameters
    extract($_SESSION);//get all session parameters
    // var_dump($_POST);
    if($usertype=='a')
    {
        $table='form_info';
        $randomID=generateaccesscode('FEED');
        $data=array('feedback_code'=>$randomID,'feedback_desc'=>$feedback_desc);
        $success_info="Feedback from created successfully.";
        $error_info="Feedback from not created.";
        // errordisplay($error_main,'Addition disabled.');//Enable this to close edit during development
        if(insertintodb($table,$data))
            successdisplay($success_main,$success_info);
        else
            errordisplay($error_main,$error_info);
    }
    else
    {
        errordisplay($error_main,'Unauthorised.');
    }
}
else{
	header("Location:../index.php");
}

$conn->close();
?>