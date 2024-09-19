<?php
include 'db.php';
$challenge_id = $_GET['challenge_id'];
$user_id= $_GET['user_id'];

$winner='';


$sql = "SELECT challenged_tap, challenger_tap FROM challenges WHERE id=$challenge_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['challenged_tap'] > $row['challenger_tap']) {
    $sql = "SELECT challenged_id, challenger_id FROM challenges WHERE id=$challenge_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $sql = "UPDATE challenges SET status='{$row['challenged_id']}' WHERE id=$challenge_id";
    $conn->query($sql);
    $winner=$row['challenged_id'];
 
} else if ($row['challenger_tap'] > $row['challenged_tap']) {
    $sql = "SELECT challenger_id,  challenged_id FROM challenges WHERE id=$challenge_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $sql = "UPDATE challenges SET status='{$row['challenger_id']}' WHERE id=$challenge_id";
    $conn->query($sql);
    $winner=$row['challenger_id'];

}
else{
    echo "Draw";
    exit;
}

if($winner==$user_id){

    $sql = "UPDATE users SET points=points+1 WHERE id=$user_id";
    $conn->query($sql);
    
    echo "You win";
} else {
    $sql = "UPDATE users SET points=points-1 WHERE id=$user_id";
    $conn->query($sql);
    echo "You lose";
}
?>