<?php
include 'db.php';
$username = $_GET['username'];


// Update user status
$sql = "UPDATE users SET status='online' WHERE username='$username'";
if ($conn->query($sql) === TRUE) {
    // echo "User status updated successfully";
} else {
    echo "Error updating user status: " . $conn->error;
}
// Fetch user details
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
 <?php
        session_start();
        $_SESSION['username'] = $username;
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Lobby</title>
    <script>
        function updatePlayers() {



            fetch('update_players.php?username=<?php echo $username; ?>')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('players').innerHTML = data;
                });
        }

        function updatePlayersgame() {

            fetch('update_playersgame.php?username=<?php echo $username; ?>')
                .then(response => response.text())
                .then(data => {
                    if (data.indexOf('game.php') === 0) {
                        window.location.href = data;
                    } else {
                      
                    }
                  
                });
}

        function checkChallenges() {
            fetch('check_challenges.php?username=<?php echo $username; ?>')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('challenges').innerHTML = data;
                });
        }

        function challenge(challenged) {
            fetch('challenge.php?challenger=<?php echo $username; ?>&challenged=' + challenged)
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    updatePlayers(); // Refresh the player list after setting a challenge
                    checkChallenges(); // Refresh the challenge list after setting a challenge
                });
        }

        function acceptChallenge(challengeId) {
            fetch('accept_challenge.php?challenge_id=' + challengeId)
                .then(response => response.text())
                .then(data => {
                    if (data.indexOf('game.php') === 0) {
                        window.location.href = data;
                    } else {
                        alert(data);
                    }
                    updatePlayers(); // Refresh the player list after accepting a challenge
                    checkChallenges(); // Refresh the challenge list after accepting a challenge
                });
        }

        setInterval(updatePlayers, 5000);
        setInterval(checkChallenges, 5000);
        setInterval(updatePlayersgame, 1000);
    </script>
</head>
<body>
    <h1>Welcome, <?php echo $user['username']; ?>!</h1>
    <p>Points: <?php echo $user['points']; ?></p>
    <div id="challenges"></div>
    <div id="players"></div>
   

   
    <script>updatePlayers();updatePlayersgame(); checkChallenges();</script>
</body>
</html>

