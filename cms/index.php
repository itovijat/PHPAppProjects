<?php
include_once "dbconnect.php";

if (isset($_SESSION['role']) && $_SESSION['role'] !== "") {
    echo "<script>location.replace('" . $_SESSION['role'] . "');</script>";
    exit;
}

if (isset($_POST['loginbtn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
    
    $sql = "SELECT role, company, status, password FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['password'] !== $password) {
                session_unset();
                session_destroy();
                echo "<script>location.replace('index.php?msg=Invalid%20Password');</script>";
                exit;
            }
            if ($row['status'] != 0) {
                session_start();
                session_unset();
                session_destroy();
                echo "<script>location.replace('error.php?msg=Access%20denied%20due%20to%20status%20restrictions');</script>";
                exit;
            }

            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];
            $_SESSION['company'] = $row['company'];



            if ($_POST['email'] == $_POST['pass']) {
                $_SESSION['cp'] = true;
            } else {
                $_SESSION['cp'] = false;
            }

            echo "<script>location.replace('" . $row['role'] . "');</script>";
            exit;
        }
    } else {
        session_unset();
        session_destroy();
        echo "<script>location.replace('index.php?msg=Invalid%20Username');</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EOvijat Login</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
            margin: 0;
        }
        .form.login {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 300px;
            width: 100%;
            text-align: center;
        }
        .form.login header {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form.login img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
        .form.login input[type="text"],
        .form.login input[type="password"],
        .form.login input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form.login input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .form.login input[type="submit"]:hover {
            background-color: #45a049;
        }
        .password-container {
            position: relative;
            width: 100%;
        }
        .password-container input[type="password"] {
            padding-right: 30px;
        }
        .password-container .toggle-password {
            position: absolute;
            right: 10px;
            top: 40%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
        }
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
        @media (max-width: 768px) {
            .form.login { max-width: 100%; margin: 0 20px; }
        }
    </style>
</head>
<body>
    <div class="form login">
        <img src="assets/eovijatlogo.png" alt="EOvijat.com" />
        <h1>EOvijat.com</h1>
        <?php if (isset($_GET['msg'])): ?>
            <p class="message"><?php echo $_GET['msg']; ?></p>
        <?php endif; ?>
        <header>Login</header>
        <form method="POST">
            <input type="text" placeholder="Username" name="email" required>
            <div class="password-container">
                <input type="password" placeholder="Password" name="pass" required id="pass">
                <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>
            <input type="submit" name="loginbtn" value="Enter">
        </form>
    </div>
    <style>
    .password-container {
            position: relative;
            width: 100%;
        }
        .password-container input[type="password"] {
            padding-right: 30px;
        }
        .password-container .toggle-password {
            position: absolute;
            right: 10px;
            top: 40%;
            transform: translateY(-50%);
            cursor: pointer;
        }</style>
    <script>
        function togglePassword() {
            var passField = document.getElementById("pass");
            var toggleIcon = document.querySelector(".toggle-password");
            if (passField.type === "password") {
                passField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
