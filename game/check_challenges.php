<?php
include 'db.php';
$username = $_GET['username'];

// Fetch user ID
$user_id_query = "SELECT id FROM users WHERE username='$username'";
$user_id_result = $conn->query($user_id_query);
$user_id = $user_id_result->fetch_assoc()['id'];



// Fetch pending challenges
$sql = "SELECT c.id, u.username AS challenger, c.challenger_id, c.challenged_id FROM challenges c JOIN users u ON c.challenger_id = u.id WHERE (c.challenger_id = $user_id OR c.challenged_id = $user_id) AND c.status = 'pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['challenger_id'] == $user_id) {
            $username = $row['challenger'];
            $challenged_username = getChallengedUsername($conn, $row['challenged_id']);
            echo "<div style=\"background-color: red; padding: 10px; border-radius: 10px; margin: 10px auto; width: 50%; text-align: center;\">You have challenged <b style=\"color: #fff;\"> {$challenged_username} </b></div>";
        } else {
            echo "<div style=\"background-color: #333; padding: 10px; border-radius: 10px; margin: 10px auto; width: 50%; text-align: center;\"><b style=\"color: #fff;\"> {$row['challenger']} </b> has challenged you<button style=\"display: block; margin: 0 auto; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer;\" onclick=\"acceptChallenge({$row['id']})\">Accept</button></div>";
        }
    }
} else {
    echo "<div style=\"text-align: center;\">No Challenges</div>";
}

function getChallengedUsername($conn, $challenged_id) {
    $sql = "SELECT username FROM users WHERE id = $challenged_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['username'];
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
