<?php
include_once '../db.php';
if ($_SESSION['role'] != 'sr')
{
    echo "<script>location.replace('../');</script>";
    exit;
}
?>