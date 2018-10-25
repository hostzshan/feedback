<?php
include '..\PHPMailer\src\PHPMailer.php';
include '..\PHPMailer\src\SMTP.php';
include '..\PHPMailer\src\Exception.php';
include 'functions.php';
include 'connection.php';
include 'f_registration_validate.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$success_main='Registration Successful';
$error_main='Registration Failed';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    extract($_POST);//get all post parameters
    $error_info=validate($_POST);
    if($error_info=='true')
    {
        $hashandsalt = password_hash($pass, PASSWORD_BCRYPT);//hash password
        // echo $hashandsalt;
        $flag_ac_verify=verifyaccesscode($conn,$access_code,$department);
        if($flag_ac_verify=='false')
        {
            errordisplay($error_main,'Invalid access code.');
        }
        else
        {
            $data=array('username'=>$univ_roll,'pass'=>$hashandsalt,'usertype'=>'s','access_code'=>$access_code);
            // errordisplay($error_main,'Registration disabled.');//Enable this to close registration during development
            if(insertintodb('regist',$data))
            {
                successdisplay($success_main,'Contact Administrator to activate account.');
                // sendmail('zshanakhtar@outlook.com','Registration Done Successfully','You have been successfully registered please contact administrator to activate account.');
            }
            else
                errordisplay($error_main,'Server Error, please try again later.');
        }
    }
    else
    {
        errordisplay($error_main,$error_info);
    }
}
else{
	header("Location:../index.php");
}


?>