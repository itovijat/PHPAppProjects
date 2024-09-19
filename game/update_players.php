<?php
include 'db.php';
$username = $_GET['username'];

// Fetch online players
$sql = "SELECT * FROM users WHERE username != '$username' AND status = 'online'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['username']} - Points: {$row['points']} ";
    if ($row['status'] == 'playing') {
        echo "Playing";
    } else {
        echo "<button onclick=\"challenge('{$row['username']}')\">Challenge</button>";
    }
    echo "</p>";
}



?>

<script>
function challenge(challenged) {
    fetch('challenge.php?challenger=<?php echo $username; ?>&challenged=' + challenged)
        .then(response => response.text())
        .then(data => {
            alert(data);
            updatePlayers(); // Refresh the player list after setting a challenge
        });
}
</script>
