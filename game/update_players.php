<?php
include 'db.php';
$name = $_SESSION['username'];
$sname = $_GET['sname'];

// Fetch online players
$sql = "SELECT * FROM users WHERE username != '$name' AND (status = 'online' OR status = 'playing') AND last_seen > NOW() - INTERVAL 30 SECOND ";

if ($sname) {
    $sql = "SELECT * FROM users WHERE username != '$name' AND username LIKE '%$sname%'  AND last_seen IS NOT NULL";
}

$result = $conn->query($sql);



if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='online-player'>";
        echo "<span>{$row['username']}</span>";
        echo "<span><span class='coin2' style='width: 15px; height: 15px; background-color: #ff9900; border-radius: 50%; display: inline-block; font-size: 15px; text-align: center; line-height: 15px'>t</span>{$row['points']} </span>";
        if ($row['status'] == 'playing') {
            echo "<span>Playing</span>";
        } else if ($row['points'] <= 0) {
            echo "<a href='sendcoin.php?send={$row['username']}'><span>Send <span class='coin2' style='width: 15px; height: 15px; background-color: red; border-radius: 50%; display: inline-block; font-size: 15px; text-align: center; line-height: 15px'>t</span> </span></a>";
        } else {

            if ($_SESSION['points'] > 0) {
            if (strtotime($row['last_seen']) < strtotime(date('Y-m-d H:i:s')) - 30) {
                echo "<button onclick=\"challenge('{$row['username']}')\">Challenge</button>";}

                else {
                    echo "<span>Offline</span>";


                }
            } else {
                echo "<a href='sendcoin.php?req={$row['username']}'><span>Request <span class='coin2' style='width: 15px; height: 15px; background-color: green; border-radius: 50%; display: inline-block; font-size: 15px; text-align: center; line-height: 15px'>t</span> </span></a>";
            }

        }
        echo "</div>";
    }
} else {
    echo "<p style='text-align: center; font-size: 25px; color: #888'>Getting Players</p>";
}



?>


