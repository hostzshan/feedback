<?php
include 'functions.php';
include 'connection.php';
// include 'f_faculty_validate.php';

session_start();
$error_main='Status Change Failed';
$success_main='Status Changed';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    extract($_POST);//get all post parameters
    extract($_SESSION);//get all session parameters
    // var_dump($_POST);
    if($usertype=='a')
    {
        if($type=='user')
        {
            $table='regist';
            $data_key='userstatus';
            $find_key='username';
            $success_info="User status changed.";
            $error_info="User status not updated.";
        }
        else if($type=='feedback')
        {
            $table='form_info';
            $data_key='feedback_status';
            $find_key='feedback_code';
            $success_info="Form status changed.";
            $error_info="Form status not updated.";
        }

            $find=array($find_key=>$control);
            $data=array($data_key=>$status);
            $query = "SELECT sno FROM ".$table;
            $i=0;
            foreach($find as $x => $x_value){
                // echo $x."\n";
                // echo $x_value."\n";
                $query.=$i++==0?" WHERE ":" AND ";
                $query.=$x."='$x_value'";
            }
            $result=mysqli_query($conn,$query);
            if($row = $result->fetch_assoc()){
                $sno=$row['sno'];
                // errordisplay($error_main,'Status Change disabled.');//Enable this to close edit during development
                if(updatedb($table,$data,$sno))
                    successdisplay($success_main,$success_info);
                else
                    errordisplay($error_main,$error_info);
            }
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