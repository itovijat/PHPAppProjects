<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM map_data ORDER BY datetime DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['username']}</td>
                <td>{$row['latitude']}</td>
                <td>{$row['longitude']}</td>
                <td>{$row['datetime']}</td>
              </tr>";
    }
}
$conn->close();
?>
