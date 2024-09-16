<?php





$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vfs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE IF NOT EXISTS user (
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(32) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    // echo "Table user created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO user (username,password) VALUES ('admin',md5('1234')) ON DUPLICATE KEY UPDATE password=md5('1234')";
if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}






?>