<?php
function realescape($arr){
    include "../php-back/".'connection.php';
    foreach($arr as $x => $x_value)
    {
        $arr[$x]=mysqli_real_escape_string($conn, $x_value);
        // Get rid of any newline characters in $string.
        $arr[$x] = str_replace(PHP_EOL, '', $x_value);
    }
    return $arr;
    $conn->close();
}

function insertintodb($table,$data){
    include "../php-back/".'connection.php';
    $query1 = "INSERT INTO $table (sno) VALUES (NULL)";
    if ($conn->query($query1) === TRUE) {
        $last_id = $conn->insert_id;
        return updatedb($table,$data,$last_id)?true:false;
    } else {
        return false;
    }
    $conn->close();
}

function updatedb($table,$data,$sno){
    include "../php-back/".'connection.php';
    $flag_update_statement=0;
    foreach($data as $x => $x_value){
        // echo $x."\n";
        // echo $x_value."\n";
        $stmt = $conn->prepare("UPDATE $table SET $x = ? WHERE sno='$sno'");
        $stmt->bind_param("s", $x_value);
        $flag_update_statement = $stmt->execute()?$flag_update_statement+1:$flag_update_statement;
        $stmt->close();
    }
    return $flag_update_statement==4?true:false;
    $conn->close();
}

function errordisplay($error_main,$error_desc){
    echo '<div class="alert alert-danger"><strong>'.$error_main.'!</strong> '.$error_desc.'</div>';
}
function inputvalidate($mode,$data){
    $flag=0;
    if($mode=='max-length')
    {
        foreach($data as $x => $x_value)
            if(strlen($x)>$x_value)
            {
                $flag=1;
                break;
            }
    }
    else if($mode=='exact-length')
    {
        foreach($data as $x => $x_value)
            if(strlen($x)!=$x_value)
            {
                $flag=1;
                break;
            }
    }
    else if($mode=='min-length')
    {
        foreach($data as $x => $x_value)
            if(strlen($x)<$x_value)
            {
                $flag=1;
                break;
            }
    }
    return $flag==0?true:false;
}
function generateaccesscode($access){
    $bytes = random_bytes(3);
    $code=bin2hex($bytes);
    return $access.$code;
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
