<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tic_tac_toe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create tables if not exists
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    status VARCHAR(10) NOT NULL
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS games (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    player1 INT(6) UNSIGNED,
    player2 INT(6) UNSIGNED,
    board VARCHAR(9) NOT NULL,
    turn INT(1) NOT NULL,
    status VARCHAR(10) NOT NULL
)";
$conn->query($sql);
?>
