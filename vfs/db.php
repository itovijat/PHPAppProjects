<?php





$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vfs";

if($_SERVER['SERVER_NAME'] != "localhost")
{
    $servername = "localhost";
    $username = "u312077073_vfs";
    $password = "I4mU!P&2&";
    $dbname = "u312077073_vfs";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}







$sql = "INSERT INTO user (username,password) VALUES ('adminkrkrkr',md5('krkrkr1234')) ON DUPLICATE KEY UPDATE password=md5('1234')";
if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}






?>