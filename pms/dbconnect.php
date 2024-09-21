<?php
if($_SERVER['SERVER_NAME'] == "localhost")
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



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pms";
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

