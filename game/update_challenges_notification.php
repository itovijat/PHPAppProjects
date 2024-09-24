<?php
include 'db.php';
$username = $_GET['username'];

$sql = "SELECT COUNT(*) AS count FROM challenges WHERE (challenger_id = (SELECT id FROM users WHERE username='$username') OR challenged_id = (SELECT id FROM users WHERE username='$username')) AND status = 'pending'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo $row['count'];
?>