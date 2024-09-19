<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tic Tac Toe Lobby</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .player { margin: 10px; padding: 10px; border: 1px solid #000; display: inline-block; }
    </style>
</head>
<body>
    <h1>Welcome to Tic Tac Toe</h1>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Enter your username" required>
        <button type="submit">Register</button>
    </form>
    <h2>Online Players</h2>
    <div id="players">
        <?php
        $result = $conn->query("SELECT * FROM users WHERE status='online'");
        while($row = $result->fetch_assoc()) {
            echo "<div class='player' data-id='".$row['id']."'>".$row['username']."</div>";
        }
        ?>
    </div>
    <script>
        document.querySelectorAll('.player').forEach(player => {
            player.addEventListener('click', function() {
                let opponentId = this.getAttribute('data-id');
                window.location.href = 'game.php?opponent=' + opponentId;
            });
        });
    </script>
</body>
</html>
