<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$datetime = date('Y-m-d H:i:s');

$sql = "INSERT INTO map_data (username, latitude, longitude, datetime) VALUES ('$username', '$latitude', '$longitude', '$datetime')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
