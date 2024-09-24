<?php
include 'db.php';

$sql = "SELECT COUNT(*) AS count FROM users WHERE username != '".$_SESSION['username']."' AND status = 'online' AND last_seen > NOW() - INTERVAL 15 SECOND";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo $row['count'];
?>