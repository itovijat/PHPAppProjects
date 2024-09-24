<?php

date_default_timezone_set('Asia/Dhaka');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multiplayer_game";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// // Drop all tables
// $sql = "SET FOREIGN_KEY_CHECKS = 0";
// $conn->query($sql);

// $tables = array();
// $result = $conn->query("SHOW TABLES");
// while($row = $result->fetch_array(MYSQLI_NUM)) {
//     $tables[] = $row[0];
// }
// foreach($tables as $table) {
//     $sql = "DROP TABLE IF EXISTS $table";
//     $conn->query($sql);
// }

// $sql = "SET FOREIGN_KEY_CHECKS = 1";


// //$conn->query($sql);


// Create tables if they don't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    points INT DEFAULT 0,
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
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

session_start();
?>
