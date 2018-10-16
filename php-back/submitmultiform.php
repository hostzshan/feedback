<?php
include 'functions.php';
include 'connection.php';
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
        if($type=="faculty"){
            $table='form';
            $parameter_name='faculty_id';
        }
        if($type=="access"){
            $table='access';
            $parameter_name='access_code';
        }
        if($action=="delete")
        {
            $data=array('feedback_code'=>$control, $parameter_name=>$parameter);
            // errordisplay($error_main,'Deletion disabled.');//Enable this to close deletion during development
            if(deletefromdb($table,$data))
                successdisplay($success_main,'Deleted feild from this form.');
            else
                errordisplay($error_main,'Server Error, please try again later.');
        }
        else if($action=="edit")
        {
            $find=array('feedback_code'=>$control, $parameter_name=>$parameter);
            $data=array('faculty_desc'=>$faculty_desc);
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
                // errordisplay($error_main,'Deletion disabled.');//Enable this to close edit during development
                if(updatedb($table,$data,$sno))
                    successdisplay($success_main,'Edited feild description on this form.');
                else
                    errordisplay($error_main,'Server Error, please try again later.');
            }
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

$conn->close();
?>