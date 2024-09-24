<?php
include 'db.php';
$challenge_id = $_GET['challenge_id'];

// Update challenge status
$sql = "UPDATE challenges SET status='accepted', created_at=NOW() WHERE id=$challenge_id";
if ($conn->query($sql) === TRUE) {
    // Fetch challenger and challenged usernames
    $challenge_query = "SELECT u1.username AS challenger, u2.username AS challenged FROM challenges c JOIN users u1 ON c.challenger_id = u1.id JOIN users u2 ON c.challenged_id = u2.id WHERE c.id = $challenge_id";
    $challenge_result = $conn->query($challenge_query);
    $challenge = $challenge_result->fetch_assoc();

    // Redirect to game
    echo ("game.php?challenge_id=" . $challenge_id);
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
