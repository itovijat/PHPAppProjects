

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EOvijat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
            margin: 0;
        }
        .login-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 300px;
            width: 100%;
            text-align: center;
        }
        .login-form h2 {
            margin-bottom: 20px;
        }
        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .login-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-form">
       
        <?php
include_once "db.php";


if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    // Add your logic here for handling the username and password

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND status = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       $_SESSION['username'] = $row['username'];
       $_SESSION['userid'] = $row['id'];
       $_SESSION['role'] = $row['role'];
       $_SESSION['company'] = $row['company'];
       echo "<script> location.replace('$_SESSION[role]');</script>";


    } else {
        echo "Invalid username or password.<br>Or User is blocked";
    }
}

?>
 <h2>Login</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

