<?php  

include_once "../dbconnect.php";

if ($_SESSION['email']=="" OR $_SESSION['role']!="transport"){

    //redirect
  echo "  <script>location.replace('logout.php')</script>";
   die();

}


?>
