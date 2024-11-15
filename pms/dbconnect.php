<?php

date_default_timezone_set('Asia/Dhaka');
if($_SERVER['SERVER_NAME'] == "localhost" || strpos($_SERVER['SERVER_NAME'], "ngrok-free.app"))
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pms";
}
else
{
    $servername = "localhost";
    $username = "ovijattt_adminush";
    $password = "IGQyDmcP!gi1";
    $dbname = "ovijattt_pms";



  
}




try 
{
  mysqli_connect($servername, $username, $password, $dbname) or die ();
}
catch (Exception $e) 
{
  echo "<script> window.location.href = 'notification/?msg=database error'; </script>";
}
$conn = mysqli_connect($servername, $username, $password, $dbname);


session_start();



?>

