<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Dhaka');




if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tiparu";
} else {
    $servername = "localhost";
    $username = "u312077073_tip";
    $password = "Ft??iv4E;KH1";
    $dbname = "u312077073_tiparu";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
}

// Create tables if they don't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(35) NOT NULL,
    points INT DEFAULT 10,
    status VARCHAR(10) DEFAULT 'online',
    last_seen DATETIME
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS challenges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    challenger_id INT NOT NULL,
    challenged_id INT NOT NULL,
    status VARCHAR(10) DEFAULT 'pending',
    challenged_tap INT DEFAULT 0,
    challenger_tap INT DEFAULT 0,
    created_at DATETIME 
)";
$conn->query($sql);

session_start();

?>
