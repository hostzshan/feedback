<?php
include 'connection.php'; //connect the connection page
  
session_start();

if ($_SERVER['REQUEST_METHOD']=='POST'){
$usertype='n';
extract($_POST);
extract($_SESSION);
// echo $usertype;
// echo $username;
//echo $approvet;
	include "../php-front/".$usertype.'/approveT.php';
}
else{
	header("location: ../index.php");
}

?>