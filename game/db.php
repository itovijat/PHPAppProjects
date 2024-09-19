<?php
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

// Create tables if they don't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    points INT DEFAULT 0,
    status VARCHAR(10) DEFAULT 'online'
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS challenges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    challenger_id INT NOT NULL,
    challenged_id INT NOT NULL,
    status VARCHAR(10) DEFAULT 'pending'
)";
$conn->query($sql);
?>
