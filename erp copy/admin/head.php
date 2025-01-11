<?php
include_once '../db.php';
if ($_SESSION['role'] != 'admin')
{
    echo "<script>location.replace('../');</script>";
    exit;
}
?>