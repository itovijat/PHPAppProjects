<?php
include 'db.php';
$name = $_SESSION['username'];
$sname = $_GET['sname'];

// Fetch online players
$sql = "SELECT * FROM users WHERE username != '$name' AND (status = 'online' OR status = 'playing') AND last_seen > NOW() - INTERVAL 30 SECOND ";

if ($sname) {
    $sql = "SELECT * FROM users WHERE username != '$name' AND username LIKE '%$sname%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='display: flex; justify-content: space-between; align-items: center; margin-left: 0%; margin-right: 0%'>";
        echo "<span style='font-size: 20px; width: 40%'>{$row['username']}</span>";
        echo "<span style='font-size: 15px; width: 30%'><span class='coin2' style='width: 15px; height: 15px; background-color: #ff9900; border-radius: 50%; display: inline-block; font-size: 15px; text-align: center; line-height: 15px'>t</span>{$row['points']} </span>";
        if ($row['status'] == 'playing') {
            echo "<span style='margin-top: 5px;color: #888; width: 30%'>Playing</span>";
        } else if ($row['points'] <= 0) {
            echo "<a style='text-decoration: none; color: white;' href='sendcoin.php?send={$row['username']}'><span style='font-size: 15px; width: 30%'>Send <span class='coin2' style='width: 15px; height: 15px; background-color: red; border-radius: 50%; display: inline-block; font-size: 15px; text-align: center; line-height: 15px'>t</span> </span></a>";
        } else {

            if ($_SESSION['points'] > 0) {
                echo "<button style='border: none; background-color: #4CAF50; color: #fff; margin-top: 5px; padding: 5px 5px; border-radius: 5px; cursor: pointer; width: 30%;' onclick=\"challenge('{$row['username']}')\">Challenge</button>";
            } else {
                echo "<a style='text-decoration: none; color: white;' href='sendcoin.php?req={$row['username']}'><span style='font-size: 15px; width: 30%'>Request <span class='coin2' style='width: 15px; height: 15px; background-color: green; border-radius: 50%; display: inline-block; font-size: 15px; text-align: center; line-height: 15px'>t</span> </span></a>";
            }



        }
        echo "</div>";
    }
} else {
    echo "<p style='text-align: center; font-size: 25px; color: #888'>Getting Players</p>";
}



?>


