<?php
include 'functions.php';
// include 'f_faculty_validate.php';

session_start();
$error_main='Faculty Action Failed';
$success_main='Faculty Action Succeded';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    extract($_POST);//get all post parameters
    extract($_SESSION);//get all session parameters
    // var_dump($_POST);
    if($usertype=='a')
    {
        if($action=="delete")
        {
            $data=array('feedback_code'=>$control,'faculty_id'=>$parameter);
            // errordisplay($error_main,'Deletion disabled.');//Enable this to close deletion during development
            if(deletefromdb('form',$data))
                successdisplay($succes_main,'Deleted feild from this form.');
            else
                errordisplay($error_main,'Server Error, please try again later.');
        }
        // if(insertintodb('regist',$data))
        //     sendmail('zshanakhtar@outlook.com','Registration Done Successfully','You have been successfully registered please contact administrator to activate account.');
        // else
        //     errordisplay($error_main,'Server Error, please try again later.');
    }
    else
    {
        errordisplay($error_main,'Unauthorised.');
    }
}
else{
	header("Location:../index.php");
}


?>