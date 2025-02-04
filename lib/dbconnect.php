<?php
$conn = mysqli_connect("localhost", "root", "", "librarium");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();


$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(50) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if (mysqli_query($conn, $sql)) {
    // echo "Table users created successfully";
} else {
    // echo "Error creating table: " . mysqli_error($conn);
}

$sql = "INSERT INTO users (username,password) SELECT * FROM (SELECT 'kush', md5('5877')) AS tmp WHERE NOT EXISTS (SELECT username FROM users WHERE username = 'kush') LIMIT 1";
if (mysqli_query($conn, $sql)) {
    // echo "New record created successfully";
} else {
    // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
