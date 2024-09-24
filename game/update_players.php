<?php
include 'db.php';
$username = $_GET['username'];

// Fetch online players
$sql = "SELECT * FROM users WHERE username != '$username' AND status = 'online' AND last_seen > NOW() - INTERVAL 15 SECOND ";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='player' style='border: 1px solid #666; border-radius: 10px; padding: 10px; margin: 10px auto; width: 80%; display: flex; justify-content: space-between; align-items: center; font-size: 25px;'>
    
    
    <span style='width: 80%'>{$row['username']} 
    <span class='coin2' style='width: 20px; height: 20px; background-color: #ff9900; border-radius: 50%; display: inline-block; font-size: 20px; text-align: center; line-height: 20px'>$</span>{$row['points']}</span>";
    if ($row['status'] == 'playing') {
        echo "<span style='color: #888'>Playing</span>";
    } else if ($row['points'] <= 0) {

        echo "<span style='color: red'>Cannot play</span>";
    }
    
    
    else {
        echo "<button style='border: none; background-color: #4CAF50; color: #fff; padding: 10px 20px; border-radius: 5px; cursor: pointer;' onclick=\"challenge('{$row['username']}')\">Challenge</button>";
    }
    echo "</div>";
}



?>

<script>
function challenge(challenged) {
    fetch('challenge.php?challenger=<?php echo $username; ?>&challenged=' + challenged)
        .then(response => response.text())
        .then(data => {
            alert(data);
           
        });
}
</script>
