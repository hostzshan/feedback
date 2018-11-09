<?php

$feedback_params=array('Knowledge of Subject','Communication Skills','Positive attitude on a daily basis','Presents the information in a way that is easy  to understand','Interaction with Students','Applied Knowledge');
// $feedback_params=array('Provides support for all students','Positive attitude on a daily basis','Presents the information in a way that is easy  to understand','Motivates me to give my best effort','Encourages student feedback','Takes the time to assist individual students that need help','I am able to ask for assistance without fear of rejection or embarrassment','Focuses on stopping unwanted behavior for the majority of the class period');

function realescape($arr){
    include "../php-back/".'connection.php';
    foreach($arr as $x => $x_value)
    {
        $arr[$x]=mysqli_real_escape_string($conn, $x_value);
        // Get rid of any newline characters in $x_value.
        $arr[$x] = str_replace(PHP_EOL, '', $x_value);
    }
    return $arr;
    $conn->close();
}

function verifyaccesscode($conn,$access_code,$department){
    $query = "SELECT access,allowed_users FROM cluster WHERE access_code='$access_code' AND department='$department' AND access_code_desc='anchor'";
    // echo $query;
    $result=mysqli_query($conn,$query);
    if($row=$result->fetch_assoc()){
        $query = "SELECT count(*) FROM regist WHERE access_code='$access_code' AND userstatus='t'";
        // echo $query;
        $resultcount=mysqli_query($conn,$query);
        if($rowcount=$resultcount->fetch_assoc()){
            // echo $rowcount['count(*)'] ."<=". $row['allowed_users'];
            if( $rowcount['count(*)'] <= $row['allowed_users'] )
                return $row['access'];
                // return 'false'; //activate this for stoppping registration during development
        }
    }
    return 'false';
}

function insertintodb($table,$data){
    include "../php-back/".'connection.php';
    $query1 = "INSERT INTO $table (sno) VALUES (NULL)";
    if ($conn->query($query1) === TRUE) {
        $last_id = $conn->insert_id;
        if(updatedb($table,$data,$last_id))
            return true;
        else
        {
            deletefromdb($table,array('sno'=>$last_id));
            return false;
        }
    } else {
        return deletefromdb($table,array('sno'=>$last_id));
    }
    $conn->close();
}

function updatedb($table,$data,$sno){
    include "../php-back/".'connection.php';
    $flag_update_statement=0;
    foreach($data as $x => $x_value){
        // echo $x."<br>";
        // echo $x_value."<br>";
        // echo $sno."<br>";
        $stmt = $conn->prepare("UPDATE $table SET $x = ? WHERE sno='$sno'");
        $stmt->bind_param("s", $x_value);
        $flag_update_statement = $stmt->execute()?$flag_update_statement+1:$flag_update_statement;
        $stmt->close();
    }
    return $flag_update_statement==sizeof($data)?true:false;
    $conn->close();
}
function deletefromdb($table,$data){
    include "../php-back/".'connection.php';
    $query = "DELETE FROM ".$table;//permanent delete
    $query1 = "SELECT sno FROM ".$table;//temporary delete
    $i=0;
    foreach($data as $x => $x_value){
        // echo $x."\n";
        // echo $x_value."\n";
        $query.=$i++==0?" WHERE ":" AND ";
        $query.=$x."='$x_value'";
        $data[$x]=$x_value."_deleted";
    }
    // echo $query;
    $result=mysqli_query($conn,$query);
    // if($row = $result->fetch_assoc()){
    //     $sno=$row['sno'];
    //     return updatedb($table,$data,$sno)?true:false;
    // }
    return $result;
    $conn->close();
}

function errordisplay($error_main,$error_desc){
    echo '<div class="alert alert-danger"><strong>'.$error_main.'!</strong> '.$error_desc.'</div>';
}
function successdisplay($success_main,$success_desc){
    echo '<div class="alert alert-info"><strong>'.$success_main.'!</strong> '.$success_desc.'</div>';
}
function inputvalidate($mode,$data){
    $flag=0;
    if($mode=='regex')
    {
        foreach($data as $x => $x_value)
        {
            if($x_value=='alpha')
                $regex='/[^a-z]/i';
            else if($x_value=='alphanum')
                $regex='/[^a-z0-9]/i';
            else if($x_value=='num')
                $regex='/[^0-9]/i';
            else
                $regex='/[^a-z_\-0-9]/i';
            if(preg_match($regex, $x))
            {
                $flag=1;
                break;
            }
        }
    }
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
    else if($mode=='max-value')
    {
        foreach($data as $x => $x_value)
            if($x>$x_value)
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


function zencrypt($toencrypt){
    $length=strlen($toencrypt);
    $bytes = random_bytes(2);
    $code=bin2hex($bytes);
    $salt=intval($code,16);
    $partial1=zencrypthelper(substr($toencrypt,0,$length/2),$salt);
    $partial2=zencrypthelper(substr($toencrypt,$length/2),$salt);
    return $code.$partial1.$partial2;
}

function zencrypthelper($key,$salt){//Helper Fuction built by Zeeshan for encryption
    $digit=intval(dechex($key),16);
    $encoded=dechex($digit+$salt);
    $len=strlen($encoded);
    return $len.$encoded;
}

function zdecrypt($todecrypt){
    $salt=substr($todecrypt,0,4);
    $length_partial1=$todecrypt{4};
    $partial1=substr($todecrypt,4+1,$length_partial1);
    $length_partial2=$todecrypt{4+1+$length_partial1};
    $partial2=substr($todecrypt,4+1+$length_partial1+1,$length_partial2);
    // return "salt=".$salt." length_partial1=".$length_partial1." partial1=".$partial1." length_partial2=".$length_partial2." partial2=".$partial2;
    $decodedpartial1=zdecrypthelper($partial1,$salt);
    $decodedpartial2=zdecrypthelper($partial2,$salt);
    return $decodedpartial1.$decodedpartial2;
}

function zdecrypthelper($key,$salt){
    $diff=intval($key,16)-intval($salt,16);
    if($diff<0)
        $diff=intval($salt,16)-intval($key,16);
    // return "salt ".$salt." key ".$key." diff ".$diff." decoded ".$decoded;
    return $diff;
}

function getdescription($conn,$mode,$id){
    $flag=0;
    if($mode == "username"){
        $query="SELECT name from regist_info WHERE username='$id'";
        // echo $query;
        $descname="name";
        $flag=1;
    }
    else if($mode == "feedback"){
        $query="SELECT feedback_desc from form_info WHERE feedback_code='$id'";
        // echo $query;
        $descname="feedback_desc";
        $flag=1;
    }
    else if($mode == "access_code"){
        $query="SELECT access from cluster WHERE access_code='$id' AND access_code_desc='anchor'";
        // echo $query;
        $descname="access";
        $flag=1;
    }
    if($flag==1){
        $resultdesc=mysqli_query($conn,$query);
        if($rowdesc = $resultdesc->fetch_assoc()){
            $description = $rowdesc[$descname];
            if($descname=='feedback_desc')
            {
                $query2="SELECT DISTINCT cluster.department from access INNER JOIN cluster WHERE access.access_code=cluster.access_code AND access.feedback_code='$id'";
                // echo $query2;
                $resultdesc2=mysqli_query($conn,$query2);
                while($rowdesc2 = $resultdesc2->fetch_assoc()){
                    $description.= " ".gethtmllabel($rowdesc2['department'],'danger');
                }
                $query2="SELECT DISTINCT cluster.batch from access INNER JOIN cluster WHERE access.access_code=cluster.access_code AND access.feedback_code='$id'";
                // echo $query2;
                $resultdesc2=mysqli_query($conn,$query2);
                while($rowdesc2 = $resultdesc2->fetch_assoc()){
                    $description.= " ".gethtmllabel(4-($rowdesc2['batch']-date('Y')),'info');
                }
            }
            return $description;
        }
    }
    return 'Not found';
}
function gethtmllabel($text,$color_class){
    return "<span class='label label-$color_class'>$text</span>";
}
function getaccesscodes($conn,$access){
    $flag=0;
    $query="SELECT access_code from cluster WHERE access='$access'";
    // echo $query;
    $resultdesc=mysqli_query($conn,$query);
    return $resultdesc;
}
function getfielddetail($conn,$mode,$id1,$id2){
    $flag=0;
    if($mode == "faculty"){
        $query="SELECT faculty_desc from form WHERE feedback_code='$id1' AND faculty_id='$id2'";
        // echo $query;
        $descname="faculty_desc";
        $flag=1;
    }
    else if($mode == "feedback"){
        $query="SELECT feedback_desc from form_info WHERE feedback_code='$id'";
        // echo $query;
        $descname="feedback_desc";
        $flag=1;
    }
    if($flag==1){
        $resultdesc=mysqli_query($conn,$query);
        if($rowdesc = $resultdesc->fetch_assoc()){
            return $rowdesc[$descname];
        }
    }
    return 'Not found';
}

function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
    }
function getconsolidatedfbdata($conn,$faculty_id,$feedback_code,$feedback_params){
    $feedback_link=$faculty_id."/".$feedback_code;
    $query="SELECT feedback_key from fb_data WHERE feedback_link='$feedback_link'";
    $resultdata=mysqli_query($conn,$query);
    $feedback_data_total=array('n'=>0,'y-max'=>10,'good'=>8,'good-n'=>0,'average'=>6,'average-n'=>0,'bad-n'=>0,'total'=>0);
    while($rowdata = $resultdata->fetch_assoc()){
        $feedback_data_total['n']++;
        
        $feedback_data=getfeedbackdata($conn,$faculty_id,$feedback_code,$rowdata['feedback_key'],$feedback_params);
        
        foreach($feedback_params as $feedback_param)
        {
            $current_value=$feedback_data[$feedback_param];
            $good_n=0;
            $average_n=0;
            $bad_n=0;
            if($current_value>=$feedback_data_total['good'])
                $good_n++;
            else if($current_value>=$feedback_data_total['average'])
                $average_n++;
            else
                $bad_n++;
            if (array_key_exists($feedback_param, $feedback_data_total)) {
                $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param,$feedback_data_total[$feedback_param]+$current_value);
                $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param.'good-n',$feedback_data_total[$feedback_param.'good-n']+$good_n);
                $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param.'average-n',$feedback_data_total[$feedback_param.'average-n']+$average_n);
                $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param.'bad-n',$feedback_data_total[$feedback_param.'bad-n']+$bad_n);
            }
            else{
                $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param,$current_value);
                $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param.'good-n',$good_n);
                $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param.'average-n',$average_n);
                $feedback_data_total=array_push_assoc($feedback_data_total,$feedback_param.'bad-n',$bad_n);
            }
            $feedback_data_total=array_push_assoc($feedback_data_total,'total',$feedback_data_total['total']+$current_value);
        }
    }
    return $feedback_data_total;
}
function getfeedbackdata($conn,$faculty_id,$feedback_code,$feedback_key,$feedback_params){
    $feedback_link=$faculty_id."/".$feedback_code;
    $query="SELECT feedback_data from fb_data WHERE feedback_link='$feedback_link' AND feedback_key='$feedback_key'";
    $feedback_array=array();
    $resultdata=mysqli_query($conn,$query);
    $i=0;
    $decrypted="";
    if($rowdata = $resultdata->fetch_assoc()){
         $rawdata=$rowdata['feedback_data'];
         $decrypted=zdecrypt($rawdata);
    }
    foreach($feedback_params as $feedback_param){
        $feedback_array[$feedback_param]=($i<strlen($decrypted)?$decrypted{$i}:-1)+1;
        $i++;
    }
    return $feedback_array;
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
