<?php
include 'db.php';
$challenger = $_GET['challenger'];
$challenged = $_GET['challenged'];

// Fetch challenger and challenged user IDs
$challenger_id_query = "SELECT id FROM users WHERE username='$challenger'";
$challenged_id_query = "SELECT id FROM users WHERE username='$challenged'";

$challenger_id_result = $conn->query($challenger_id_query);
$challenged_id_result = $conn->query($challenged_id_query);

if ($challenger_id_result->num_rows > 0 && $challenged_id_result->num_rows > 0) {
    $challenger_id = $challenger_id_result->fetch_assoc()['id'];
    $challenged_id = $challenged_id_result->fetch_assoc()['id'];

    // Check if there is already a pending challenge
    $sql = "SELECT * FROM challenges WHERE (((challenger_id = $challenger_id AND challenged_id = $challenged_id) OR (challenger_id = $challenged_id AND challenged_id = $challenger_id)) AND status = 'pending') 
    OR (challenger_id=$challenger_id AND status='pending')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Challenge already set";
    } else {
        // Insert challenge
        $sql = "INSERT INTO challenges (challenger_id, challenged_id) VALUES ($challenger_id, $challenged_id)";
        if ($conn->query($sql) === TRUE) {
            echo "Challenge set successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }





} else {
    echo "Error: User not found";
}
?>
