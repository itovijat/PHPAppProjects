<?php
date_default_timezone_set('Asia/Dhaka');
include_once "../dbconnect.php";

if ($_SESSION['email'] == "" or $_SESSION['role'] != "sradmin")
{

    //redirect
    echo "  <script>location.replace('../" . $_SESSION['role'] . "/index.php')</script>";
    die();

}

?>
