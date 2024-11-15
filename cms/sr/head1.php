<?php  
date_default_timezone_set('Asia/Dhaka');
include_once "../dbconnect.php";

if ($_SESSION['email']=="" OR $_SESSION['role']!="sr"){

    //redirect
  echo "  <script>location.replace('logout.php')</script>";
   die();

}


?>
