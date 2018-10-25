<?php
include 'functions.php';
include 'f_accesscode_validate.php';

session_start();
$error_main='Access Code Not Generated';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    $flag=validate($_POST);
    if($flag!='valid')
        errordisplay($error_main,$flag);
    else
    {
        extract($_POST);//get all post parameters
        $access=$department.$batch.$section;
        $access_code=generateaccesscode('ZAC');
        $data=array('access'=>$access,'access_code'=>$access_code,'allowed_users'=>$allowed_users,'department'=>$department,'batch'=>$batch,'section'=>$section,'sub_section'=>$sub_section);
        // errordisplay($error_main,'Registration disabled.');//Enable this to close registration during development, remember to disable code that follows this line
        if(insertintodb('cluster',$data))
            successdisplay('Access Code Generated:',$access_code);
        else
            errordisplay($error_main,'Server Error, please try again later.');
    }
}
else{
	header("Location:../index.php");
}


?>