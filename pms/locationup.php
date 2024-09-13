<?php
include_once "dbconnect.php";
// create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS map_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    latitude FLOAT(10, 6),
    longitude FLOAT(10, 6),
    datetime DATETIME
)";
if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
}
if (isset($_POST['latitude']) && isset($_POST['longitude']) ) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $username = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT INTO map_data (username, latitude, longitude, datetime) VALUES ('$username', '$latitude', '$longitude', NOW())";
    $conn->query($sql);
}
?>
