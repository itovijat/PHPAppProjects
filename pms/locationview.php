<?php
include 'dbconnect.php';



// Fetch data
$sql = "SELECT * FROM map_data";
$result = $conn->query($sql);

// Fetch last known locations
$sql_last = "SELECT username, latitude, longitude, MAX(datetime) as datetime FROM map_data GROUP BY username";
$result_last = $conn->query($sql_last);
?>


    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map1, #map2 {
            height: 400px;
            width: 45%;
            display: inline-block;
            margin:20px;
        }
        #data-table {
            margin-top: 20px;
        }
        .container {
            display: flex;
            justify-content: space-between;
        }
    </style>


<div id="mapdivall" style="display: flex; flex-direction: column; align-items: center;">
    <div class="container" style="width: 100%;">
        <div id="map1" style="height: 400px; width: 100%;"></div>
        <div id="map2" style="height: 400px; width: 100%;"></div>   
    </div>
    
    
    <div style="display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; padding: 10px; border-radius: 10px;">
        <button type="button" onclick="window.location.href='locationview.php'" style="margin: 20px; background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Show All</button>
        <form action="" method="post" id="search-form" style="display: flex; flex-direction: row; align-items: center; margin-left: 20px;">
            <label for="search_username" style="margin-right: 10px; font-weight: bold;">Username: </label>
            <input type="text" id="search_username" name="search_username" value="<?php echo isset($_REQUEST['search_username']) ? $_REQUEST['search_username'] : ''; ?>" oninput="searchFormValidate()" style="margin-right: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <label for="search_start" style="margin-right: 10px; font-weight: bold;">Start Date: </label>
            <input type="datetime-local" id="search_start" name="search_start" value="<?php echo isset($_REQUEST['search_start']) ? $_REQUEST['search_start'] : ''; ?>" oninput="searchFormValidate()" style="margin-right: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <label for="search_end" style="margin-right: 10px; font-weight: bold;">End Date: </label>
            <input type="datetime-local" id="search_end" name="search_end" value="<?php echo isset($_REQUEST['search_end']) ? $_REQUEST['search_end'] : ''; ?>" oninput="searchFormValidate()" style="margin-right: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <button type="submit" id="search-btn" style="display: none; margin-top: 20px; background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Search</button>
        </form>
    </div>



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


    <style>
        #data-table {
            border-collapse: collapse;
            width: 100%;
        }

        #data-table td, #data-table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #data-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #data-table tr:hover {
            background-color: #ddd;
        }

        #data-table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>

    <table id="data-table" style="margin-top: 20px;">
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
            if (isset($_REQUEST['search_username']) && $_REQUEST['search_username'] != '') {
                $where[] = "username LIKE '%".$_REQUEST['search_username']."%'";
            }
            if (isset($_REQUEST['search_start']) && $_REQUEST['search_start'] != '') {
                $where[] = "datetime >= '".$_REQUEST['search_start']."'";
            }
            if (isset($_REQUEST['search_end']) && $_REQUEST['search_end'] != '') {
                $where[] = "datetime <= '".$_REQUEST['search_end']."'";
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
            var map2 = L.map('map2').setView([23.8103, 90.4125], 7);
          

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '  OpenStreetMap contributors'
            }).addTo(map1);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '  OpenStreetMap contributors'
            }).addTo(map2);


     

            var userPaths = {};
            var colors = [];
            for (var i = 0; i < 360; i += 60) {
                colors.push('hsl(' + i + ', 100%, 50%)');
            }
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

                var fontColor = userPaths[username].color === 'white' ? 'black' : 'white';
                row.css({
                    'background-color': userPaths[username].color,
                    'color': fontColor
                });

                if (lastMarkers[username]) {
                    lastMarkers[username].remove();
                }




                var box = L.divIcon({
                    className: 'user-box',
                    html: `<div style="
                        background-color: ${userPaths[username].color}; 
                        width: 10px; height: 10px; 
                        border: 1px solid black;
                    "><a href="locationview.php?search_username=${username}">${username}: ${datetime}</a></div>`,
                    iconSize: [10, 10],
                    iconAnchor: [5, 5],
                    popupAnchor: [0, -5],
                    className: 'user-icon'
                });
                lastMarkers[username] = L.marker([latitude, longitude], {icon: box}).addTo(map1)
                    .bindPopup(username + "<br>" + latitude + ", " + longitude + "<br>" + datetime);
                var bounds = L.latLngBounds();
                $.each(userPaths, function(username, pathInfo) {
                    bounds.extend(L.latLngBounds(pathInfo.path));
                });
                map1.fitBounds(bounds, {maxZoom: 30});













// Draw markers and polyline
userPaths[username].path.forEach(function(point, index) {
    setTimeout(function() {
        var k;
        if (index === 0) {

            map2.fitBounds(L.latLngBounds(userPaths[username].path), {maxZoom: 25});
            k = L.marker(point, {
                icon: L.divIcon({
                    html: `<div style="
                        background-color: ${userPaths[username].color}; 
                        width: 12px; height: 12px; 
                        border: 1px solid black;
                    ">${username}: ${datetime}</div>`,
                    className: 'user-icon'
                })
            });
        } else if (index === userPaths[username].path.length - 1) {
            k = L.marker(point, {
                icon: L.divIcon({
                    html: `<div style="
                        background-color: ${userPaths[username].color}; 
                        width: 17px; height: 17px; 
                        border: 1px solid black;
                    ">${username}: ${datetime}</div>`,
                    className: 'user-icon'
                })
            });
           
        } else {
            k = L.marker(point, {
                icon: L.divIcon({
                    html: `<div style="
                        background-color: ${userPaths[username].color}; 
                        width: 2px; height: 2px; 
                        border: 1px solid black;
                    ">${datetime.substr(11)}</div>`,
                    className: 'user-icon'
                })
            });
        }

        if (userPaths[username].path.length > 1) {
            var polyline = L.polyline([], {
                color: userPaths[username].color,
                weight: 2,
                opacity: 0.5
            }).addTo(map2);
            var points = [];
            for (var i = 0; i <= index; i++) {
                points.push(userPaths[username].path[i]);
            }
            polyline.setLatLngs(points);
            polyline.setStyle({
                dashArray: '5, 5',
                dashOffset: index * 50
            });
            polyline.on('add', function() {
                polyline.setStyle({
                    dashOffset: 0
                });
            });
        }



        
        k.addTo(map2);
        k.bindPopup(`${index + 1}. ${username}`);
    }, index * 500);
});



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

