<?php
include_once "dbconnect.php";
// create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS map_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(10),   
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

    $latitude = 25.9363 + (mt_rand(0, 5)-mt_rand(0, 8)) / 1000;
    $longitude = 88.8407 + (mt_rand(0, 5)-mt_rand(0, 8)) / 1000;
    
    $sql = "INSERT INTO map_data (username, latitude, longitude, datetime) VALUES ('llll', '$latitude', '$longitude', NOW())";
    $conn->query($sql);
}
?>
