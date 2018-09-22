<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Feedback Portal - Mark, Analyse and Review Fedbacks and Grievances</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Validator   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script> 

<!-- universal css -->
<link rel="stylesheet" href="css/universal.css">
<!-- index css -->
<link rel="stylesheet" href="css/index.css">

<!-- index js -->
  <script src="js/index.js"></script>
</head>
<?php
include "php-back/"."connection.php"; //connect the connection page
session_start();

?>
<body>

<?php
  include 'php-front/ajaxloader.php';
  
  $canvas_heading='Feedback and Grievance Management';
  if(isset($_SESSION['usertype'])) { // if already login
    $usertype=$_SESSION['usertype'];
    $nav_type='dash';
    $canvas_paint=$usertype.'dashboard.php';
  }
  else{
    $nav_type='ind';
    $canvas_paint='login.php';
  }


  include 'php-front/nav_'.$nav_type.'.php';
  include 'php-front/canvaspainter.php';
  include 'php-front/footer.php'; 
?>
<script>
$( '.nav li a' ).on( 'click', function () {
$( '.nav' ).find( 'li.active' ).removeClass( 'active' );
$( this ).parent( 'li' ).addClass( 'active' );

$.ajax({
    url: "request/getfragment.php",
    type: "POST",
    data: "module="+$(this).data('module'),
    success: function(response){ 
        $('.review').html(response);
        //handle returned arrayList
    },
    error: function(e){  
        alert("error");
        //handle error
    } 
});


});
</script>
</body>
</html>

