<?php
include "../php-back/".'connection.php'; //connect the connection page

session_start();

if ($_SERVER['REQUEST_METHOD']=='POST'){
	
extract($_POST);

$l_username = mysqli_real_escape_string($conn, $username);
$l_password = mysqli_real_escape_string($conn, $pass);


$resultsum=mysqli_query($conn,"SELECT usertype FROM regist WHERE username='$l_username' and pass='$l_password'");
	if($row = $resultsum->fetch_assoc())
	{
			extract($row);
			$_SESSION['usertype']=$usertype;
            $_SESSION['username']=$l_username;
            echo '<script>window.location="dashboard.php"</script>';
			// header("Location:dashboard.php");
	}		
	else
	{
        echo '<div class="alert alert-danger">
            <strong>Login Failed!</strong> Either username or Password incorrect.
        </div>';
        include '../php-front/n/signin.php';
	}
	

mysqli_close($conn); // Closing Connection with Server
}
else{
	echo '<script>window.location="index.php"</script>';
}

?>