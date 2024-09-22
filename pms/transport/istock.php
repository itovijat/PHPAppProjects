<?php  

include_once "../dbconnect.php";

if ($_SESSION['email']=="" OR $_SESSION['role']!="transport"){

    //redirect
  echo "  <script>location.replace('logout.php')</script>";
   die();

}


if(isset($_GET['product_name']) && $_GET['product_name'] != ''){
  $sql = "SELECT SUM(in_quantity - out_quantity) AS balance FROM inventory WHERE company = '".$_SESSION['company']."' AND product_name LIKE '%".$_GET['product_name']."%'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $balance = $row['balance'];

    echo  $balance;
  

}
?>