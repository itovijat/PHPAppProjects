<?php
include 'dbconnect.php';

// Insert demo location
if (isset($_POST['insert_demo'])) {
    $lat = 25.7439 + (mt_rand(0, 100) - 50) / 1000;
    $lon = 89.2752 + (mt_rand(0, 100) - 50) / 1000;
    $ip = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT INTO map_data (username, latitude, longitude, datetime) VALUES ('$ip', '$lat', '$lon', NOW())";
    $conn->query($sql);
}

// Fetch data
$sql = "SELECT * FROM map_data";
$result = $conn->query($sql);

// Fetch last known locations
$sql_last = "SELECT username, latitude, longitude, MAX(datetime) as datetime FROM map_data GROUP BY username";
$result_last = $conn->query($sql_last);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map and Data Integration</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map1, #map2 {
            height: 400px;
            width: 45%;
            display: inline-block;
        }
        #data-table {
            margin-top: 20px;
        }
        .container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body><div style="height: 500px; width: 100%;" id="map3"></div>
    <div class="container">
        <div id="map1"></div>
        <div id="map2"></div>   
    </div>
 
    <form method="post">
        <button type="submit" name="insert_demo">Insert Demo Location</button>
    </form>
   
  
    <form action="" method="post" id="search-form">
        <label for="search_username">Username: </label>
        <input type="text" id="search_username" name="search_username" value="<?php echo isset($_POST['search_username']) ? $_POST['search_username'] : ''; ?>" oninput="searchFormValidate()">
        <label for="search_start">Start Date: </label>
        <input type="datetime-local" id="search_start" name="search_start" value="<?php echo isset($_POST['search_start']) ? $_POST['search_start'] : ''; ?>" oninput="searchFormValidate()">
        <label for="search_end">End Date: </label>
        <input type="datetime-local" id="search_end" name="search_end" value="<?php echo isset($_POST['search_end']) ? $_POST['search_end'] : ''; ?>" oninput="searchFormValidate()">
        <button type="submit" id="search-btn" style="display: none;">Search</button>
    </form>
    <script>
        function searchFormValidate() {
            var username = document.getElementById("search_username").value;
            var search_start = document.getElementById("search_start").value;
            var search_end = document.getElementById("search_end").value;
            if (username != "" || (search_start != "" && search_end != "")) {
                document.getElementById("search-btn").style.display = "inline-block";
            }
            else if ( (search_start != "" && search_end != "")) {
                document.getElementById("search-btn").style.display = "inline-block";
            } else {
                document.getElementById("search-btn").style.display = "none";
            }
        }
    </script>
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
            <?php
            $where = [];
            if (isset($_POST['search_username']) && $_POST['search_username'] != '') {
                $where[] = "username LIKE '%".$_POST['search_username']."%'";
            }
            if (isset($_POST['search_start']) && $_POST['search_start'] != '') {
                $where[] = "datetime >= '".$_POST['search_start']."'";
            }
            if (isset($_POST['search_end']) && $_POST['search_end'] != '') {
                $where[] = "datetime <= '".$_POST['search_end']."'";
            }
            $sql = "SELECT * FROM map_data ";
            if (!empty($where)) {
                $sql .= " WHERE " . implode(" AND ", $where);
            }
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['latitude']; ?></td>
                    <td><?php echo $row['longitude']; ?></td>
                    <td><?php echo $row['datetime']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>





       
        function mapf() {
            var map1 = L.map('map1').setView([23.8103, 90.4125], 6);
            var map2 = L.map('map2').setView([23.8103, 90.4125], 6);
            var map3 = L.map('map3').setView([23.8103, 90.4125], 7);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '  OpenStreetMap contributors'
            }).addTo(map1);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '  OpenStreetMap contributors'
            }).addTo(map2);


            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '  OpenStreetMap contributors'
            }).addTo(map3);

            var userPaths = {};
            var colors = ['red', 'blue', 'green'];
            var lastMarkers = {};

            $('#data-table tbody tr').each(function() {
                var row = $(this);
                var username = row.find('td:first-of-type').text();
                var latitude = parseFloat(row.find('td:eq(1)').text());
                var longitude = parseFloat(row.find('td:eq(2)').text());
                var datetime = row.find('td:last-of-type').text();

                if (!userPaths[username]) {
                    userPaths[username] = {
                        latitude: latitude,
                        longitude: longitude,
                        color: colors.shift() || getRandomColor()
                    };
                }

                userPaths[username].path = userPaths[username].path || [];
                userPaths[username].path.push([latitude, longitude]);

                row.css('background-color', userPaths[username].color);

                if (lastMarkers[username]) {
                    lastMarkers[username].remove();
                }

                var icon = L.icon({
                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-' + userPaths[username].color + '.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    className: 'user-icon'
                });
                lastMarkers[username] = L.marker([latitude, longitude], {icon: icon}).addTo(map1)
                    .bindPopup(username + "<br>" + latitude + ", " + longitude + "<br>" + datetime);

                L.polyline(userPaths[username].path, {color: userPaths[username].color}).addTo(map2);

                var firstPoint = userPaths[username].path[0];
                var lastPoint = userPaths[username].path[userPaths[username].path.length - 1];

                userPaths[username].path.forEach(function(point) {
                    var marker = L.marker(point, {
                        icon: L.icon({
                            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-' + userPaths[username].color + '.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            className: 'user-icon'
                        })
                    }).addTo(map2);
                    marker.bindPopup(username + "<br>" + latitude + ", " + longitude + "<br>" + datetime);
                });

                L.marker(firstPoint, {
                    icon: L.icon({
                        iconUrl: 'https://www.iconpacks.net/icons/2/free-location-map-icon-2956-thumb.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        className: 'user-icon'
                    }),
                    title: username + " Start"
                }).addTo(map2).bindPopup(username + "<br>Start: " + firstPoint[0] + ", " + firstPoint[1] + "<br>" + datetime);

                L.marker(lastPoint, {
                    icon: L.icon({
                        iconUrl: 'https://cdn-icons-png.flaticon.com/512/9356/9356230.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        className: 'user-icon'
                    }),
                    title: username + " End"
                }).addTo(map2).bindPopup(username + "<br>End: " + lastPoint[0] + ", " + lastPoint[1] + "<br>" + datetime);










// Function to draw the polyline slowly
function drawPolylineSlowly(latlngs, color, map) {
    let index = 0;
    let polyline = L.polyline([], { color: color }).addTo(map);

    function addNextSegment() {
        if (index < latlngs.length) {
            polyline.addLatLng(latlngs[index]);
            index++;
            setTimeout(addNextSegment, 500); // Adjust the delay as needed
        } else {
            // Zoom the map to the polyline once drawing is complete
            map.fitBounds(polyline.getBounds());
        }
    }

    addNextSegment();
}

// Draw markers and polyline
userPaths[username].path.forEach(function(point, index) {
    setTimeout(function() {
        var k = L.marker(point, {
            icon: L.icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-' + userPaths[username].color + '.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                className: 'user-icon'
            })
        }).addTo(map3);
        k.bindPopup(`${index + 1}. ${username}`);
    }, index * 1000);
});

// Slowly draw the polyline
drawPolylineSlowly(userPaths[username].path, userPaths[username].color, map3);
















            });



            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        }


        mapf();
      
    </script>
</body>
</html>

