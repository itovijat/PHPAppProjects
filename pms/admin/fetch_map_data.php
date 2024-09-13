<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, latitude, longitude, datetime FROM map_data ORDER BY datetime DESC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$paths = [];
foreach ($data as $row) {
    $paths[$row['username']][] = [$row['latitude'], $row['longitude']];
}

$response = [];
foreach ($paths as $username => $path) {
    $response[] = [
        'username' => $username,
        'path' => $path,
        'latitude' => end($path)[0],
        'longitude' => end($path)[1],
        'datetime' => $data[0]['datetime']
    ];
}

echo json_encode($response);
$conn->close();
?>
