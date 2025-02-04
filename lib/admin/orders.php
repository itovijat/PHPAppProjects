<?php
include_once "../dbconnect.php";
if(!isset($_SESSION['username'])){
    header("Location: logout.php");
    exit;
}
include_once 'head.php';
?>
<h1>Admin Panel</h1>



<?php
include_once 'head.php';
?>