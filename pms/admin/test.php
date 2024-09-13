<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS map_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    latitude FLOAT(10, 6),
    longitude FLOAT(10, 6),
    datetime DATETIME
)
";
$result = $conn->query($sql);
$sql = "INSERT IGNORE INTO map_data (username, latitude, longitude, datetime) VALUES
('user1', 23.8103, 90.4125, '2024-09-01 10:00:00'), -- Dhaka
('user1', 22.3475, 91.8123, '2024-09-01 12:00:00'), -- Chittagong
('user2', 24.3636, 88.6241, '2024-09-02 09:00:00'), -- Rajshahi
('user2', 24.9045, 91.8611, '2024-09-02 11:00:00'), -- Sylhet
('user3', 22.7010, 90.3535, '2024-09-03 08:00:00'), -- Barisal
('user3', 23.4607, 91.1809, '2024-09-03 10:00:00'), -- Comilla
('user4', 25.7439, 89.2752, '2024-09-04 07:00:00'), -- Rangpur
('user4', 24.7471, 90.4203, '2024-09-04 09:00:00'), -- Mymensingh
('user5', 21.4339, 91.9870, '2024-09-05 06:00:00'), -- Cox's Bazar
('user5', 22.8456, 89.5403, '2024-09-05 08:00:00'), -- Khulna
('user6', 23.8103, 90.4125, '2024-09-06 10:00:00'), -- Dhaka
('user6', 22.3475, 91.8123, '2024-09-06 12:00:00'), -- Chittagong
('user7', 24.3636, 88.6241, '2024-09-07 09:00:00'), -- Rajshahi
('user7', 24.9045, 91.8611, '2024-09-07 11:00:00'), -- Sylhet
('user8', 22.7010, 90.3535, '2024-09-08 08:00:00'), -- Barisal
('user8', 23.4607, 91.1809, '2024-09-08 10:00:00'), -- Comilla
('user9', 25.7439, 89.2752, '2024-09-09 07:00:00'), -- Rangpur
('user9', 24.7471, 90.4203, '2024-09-09 09:00:00'), -- Mymensingh
('user10', 21.4339, 91.9870, '2024-09-10 06:00:00'), -- Cox's Bazar
('user10', 22.8456, 89.5403, '2024-09-10 08:00:00'), -- Khulna
('user1', 23.6850, 90.3563, '2024-09-11 10:00:00'), -- Narayanganj
('user2', 24.0065, 89.2498, '2024-09-11 12:00:00'), -- Tangail
('user3', 24.3745, 88.6042, '2024-09-12 09:00:00'), -- Pabna
('user4', 24.8481, 89.3730, '2024-09-12 11:00:00'), -- Bogura
('user5', 24.8990, 91.8719, '2024-09-13 08:00:00'), -- Habiganj
('user6', 24.3065, 91.7296, '2024-09-13 10:00:00'), -- Maulvibazar
('user7', 23.9162, 89.1193, '2024-09-14 07:00:00'), -- Faridpur
('user8', 23.1641, 89.2086, '2024-09-14 09:00:00'), -- Jessore
('user9', 22.8456, 89.5403, '2024-09-15 06:00:00'), -- Khulna
('user10', 22.3569, 91.7832, '2024-09-15 08:00:00'); -- Feni
";
//$result = $conn->query($sql);
// Fetch data
$sql = "SELECT * FROM map_data ORDER BY datetime DESC";
$result = $conn->query($sql);
$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map and Data Table</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 400px; }
        #map2 { height: 400px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    
    <style>
        #map, #map2 {
            width: 49%;
            display: inline-block;
        }
    </style>
    <div id="map"></div>
    <div id="map2"></div>
    <h1>Map and Data Table</h1>
    <button onclick="updateLocation()">Update My Location</button>
    <table id="data-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Datetime</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['latitude'] ?></td>
                    <td><?= $row['longitude'] ?></td>
                    <td><?= $row['datetime'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var map = L.map('map').setView([23.8103, 90.4125], 5);
        var map2 = L.map('map2').setView([23.8103, 90.4125], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map2);

        function updateTable() {
            $.ajax({
                url: 'fetch_data.php',
                method: 'GET',
                success: function(data) {
                    $('#data-table tbody').html(data);
                    updateMap();
                }
            });
        }

        function updateMap() {
            $.ajax({
                url: 'fetch_map_data.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    map.eachLayer(function (layer) {
                        if (!!layer.toGeoJSON) {
                            map.removeLayer(layer);
                        }
                    });
                    map2.eachLayer(function (layer) {
                        if (!!layer.toGeoJSON) {
                            map2.removeLayer(layer);
                        }
                    });
                    data.forEach(function(row) {
                        var color = '#'+(Math.random()*0xFFFFFF<<0).toString(16);
                        L.marker([row.latitude, row.longitude], {
                            icon: L.divIcon({
                                className: 'user-icon',
                                html: '<span style="background:' + color + '">' + row.username[0] + '</span>'
                            }),
                            title: row.username
                        }).addTo(map)
                            .bindPopup(row.username + '<br>' + row.datetime);
                        L.polyline(row.path, {color: color}).addTo(map2);
                    });
                }
            });
        }


        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    $.ajax({
                        url: 'update_location.php',
                        method: 'POST',
                        data: {
                            username: 'demo_user',
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        },
                        success: function() {
                            updateTable();
                        }
                    });
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        setInterval(updateTable, 5000);
        updateTable();
    </script>
</body>
</html>
