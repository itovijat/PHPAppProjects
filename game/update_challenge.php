<?php
include 'db.php';
$challenge_id = $_POST['challenge_id'];
$user_id = $_POST['user_id'];
$tap_count = $_POST['tap_count'];




// Check if user_id is challenged_id or challenger_id
$sql = "SELECT challenged_id, challenger_id FROM challenges WHERE id=$challenge_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($user_id == $row['challenged_id']){
    $sql = "UPDATE challenges SET challenged_tap=$tap_count WHERE id=$challenge_id";
} else {
    $sql = "UPDATE challenges SET challenger_tap=$tap_count WHERE id=$challenge_id";
}
$conn->query($sql);



?>
