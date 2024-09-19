<?php
include 'db.php';
$username = $_GET['username'];

// Fetch user ID
$user_id_query = "SELECT id FROM users WHERE username='$username'";
$user_id_result = $conn->query($user_id_query);
$user_id = $user_id_result->fetch_assoc()['id'];

// Fetch pending challenges
$sql = "SELECT c.id, u.username AS challenger FROM challenges c JOIN users u ON c.challenger_id = u.id WHERE c.challenged_id = $user_id AND c.status = 'pending'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<p>Challenge from {$row['challenger']} <button onclick=\"acceptChallenge({$row['id']})\">Accept</button></p>";
}
?>

<script>
function acceptChallenge(challengeId) {
    fetch('accept_challenge.php?challenge_id=' + challengeId)
        .then(response => response.text())
        .then(data => {
            alert(data);
            window.location.reload();
        });
}
</script>
