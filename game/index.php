<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Create new user
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $conn->query($sql);
    }

    header("Location: lobby.php?username=$username");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Enter Lobby</button>
    </form>
</body>
</html>
