<?php
include 'connection.php';
include 'functions.php';
include 'f_submitfeedback_validate.php';

session_start();
$error_main='Feedback Not Submitted';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    $flag=validate($_POST);
    // var_dump($_POST);
    if($flag!='valid')
        errordisplay($error_main,$flag);
    else
    {
        extract($_POST);//get all post parameters
        extract($_SESSION);
        $flag=0;
        $resfeedbackfound=mysqli_query($conn,"SELECT form.feedback_code FROM regist INNER JOIN access INNER JOIN form ON regist.access_code=access.access_code AND access.feedback_code=form.feedback_code WHERE regist.username='$username' AND access.feedback_code='$feedback_code' ");
        if($rowstream = $resfeedbackfound->fetch_assoc()){
            $query="SELECT faculty_id FROM form WHERE feedback_code='$feedback_code'";
            $resfaculty=mysqli_query($conn,$query);
            while($rowfaculty = $resfaculty->fetch_assoc()){
                $raw_data="";
                for($i=0;$i<sizeof($feedback_params);$i++)
                    $raw_data.=$_POST[$rowfaculty['faculty_id'].$i."_score"]-1;
                $feedback_data=zencrypt($raw_data);
                // $feedback_data_decrypted=zdecrypt($feedback_data);
                // echo '<div class="alert alert-info"><strong>Feedback Data: </strong> '.$feedback_data.'<br>'.$feedback_data_decrypted.'</div>';
                $feedback_link=$rowfaculty['faculty_id']."/".$feedback_code;
                // echo '<div class="alert alert-info"><strong>Feedback Link: </strong> '.$feedback_link.'</div>';
                $feedback_key=zencrypt($username);
                // $feedback_key_decrypted=zdecrypt($feedback_key);
                $data=array('feedback_link'=>$feedback_link,'feedback_key'=>$feedback_key,'feedback_data'=>$feedback_data,'data_status'=>'t');
                // errordisplay($error_main,'Registration disabled.');//Enable this to close registration during development, also disable underlying code
                $query="SELECT sno,feedback_key FROM fb_data WHERE feedback_link='$feedback_link'";
                $ressno=mysqli_query($conn,$query);
                if($rowsno = $ressno->fetch_assoc()){
                    if(zdecrypt($rowsno['feedback_key'])==$username){
                        if(updatedb('fb_data',$data,$rowsno['sno']))
                            $flag=2;
                        else
                            $error_info='Server Error, please try again later.';
                    }
                    else{
                        if(insertintodb('fb_data',$data))
                            $flag=1;
                        else
                            $error_info='Server Error, please try again later.';
                    }
                }
                else{
                    if(insertintodb('fb_data',$data))
                        $flag=1;
                    else
                        $error_info='Server Error, please try again later.';
                }
            }
        }
        else
            $error_info="Invalid Feedback Code";
        if($flag==0)
            errordisplay($error_main,$error_info);
        else if($flag==1)
            echo '<div class="alert alert-info"><strong>Submitted Successfully!</strong></div>';
        else if($flag==2)
            echo '<div class="alert alert-info"><strong>Updated Successfully!</strong></div>';
        else
            errordisplay($error_main,"Unknown fatal error.");
    }
}
else{
	header("Location:../index.php");
}


?>