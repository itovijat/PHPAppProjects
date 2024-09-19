<?php
include 'db.php';
$username = $_GET['username'];




// Check if any challenges is accepted for this id
$sql = "SELECT c.id FROM challenges c JOIN users u ON (c.challenger_id = u.id OR c.challenged_id = u.id) WHERE u.username='$username' AND c.status='accepted'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "game.php?challenge_id=" . $row['id']  ;
} else {
   
}
?>

