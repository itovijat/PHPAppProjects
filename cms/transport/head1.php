<?php  

include_once "../dbconnect.php";

if ($_SESSION['email']=="" OR $_SESSION['role']!="transport"){

  echo "  <script>location.replace('../".$_SESSION['role']."/index.php')</script>";
   die();

}


?>
