<?php
include '..\PHPMailer\src\PHPMailer.php';
include '..\PHPMailer\src\SMTP.php';
include '..\PHPMailer\src\Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
date_default_timezone_set("Asia/Calcutta"); 
$app_id=date('dmHis');

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    extract($_POST);//get all post parameters
    $hashandsalt = password_hash($pass, PASSWORD_BCRYPT);//hash password
    // echo $hashandsalt;
    if($access_code=='156sadgj')
    {
        $data=array('username'=>$univ_roll,'pass'=>$hashandsalt,'usertype'=>'s','access_code'=>$access_code);
        if(insertintodb('regist',$data))
            sendmail('zshanakhtar@outlook.com','Registration Done Successfully','You have been successfully registered please contact administrator to activate account.');
    }
    else
    {

    }
    //if( password_verify($pass, $hashandsalt) )
    //echo '<br>success<br>';
}
else{
	header("Location:../index.php");
}

function realescape($arr){
    include "../php-back/".'connection.php';
    foreach($arr as $x => $x_value)
        $arr[$x]=mysqli_real_escape_string($conn, $x_value);
    return $arr;
}
function insertintodb($table,$data){
    include "../php-back/".'connection.php';
    $keys=implode(",", array_keys($data) );
    $values=implode("','", array_values($data) );
    $FILLteam="INSERT INTO $table ($keys) values ('$values')";
    echo $FILLteam;
    if($conn->query($FILLteam))
        return true;
    else
        return false;
}
function sendmail($to,$subject,$body){
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "authenticatorkaprakop";
    $mail->Password = "asli!pass";
    $mail->SetFrom("authenticatorkaprakop@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);

    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else {
        echo "Message has been sent";
    }
}
?>