<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username='$username' ";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Create new user
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $conn->query($sql);
        $_SESSION['username'] = $username;
        echo '<div class="popup" style="z-index: 9999; background-color: rgba(0, 0, 0, 0.7); position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; ">
                <div class="popup-content" style="margin-top: 10%; display: flex; justify-content: center;">
                    <h2 style="text-align: center;">User created successfully</h2>
                </div>
            </div>
            <script>
                function closePopup() {
                    document.querySelector(".popup").remove();
                }
                setTimeout(closePopup, 2000);
                window.location.href = "lobby.php";
                
            </script>';

    }
    else {
     
        $user = $result->fetch_assoc();
        if ($password== $user['password']) {
            $_SESSION['username'] = $username;
            echo '<div class="popup" style="z-index: 9999; background-color: rgba(0, 0, 0, 0.7); position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; ">
                    <div class="popup-content" style="margin-top: 10%;display: flex; justify-content: center;">
                        <h2 style="text-align: center;">Login successful</h2>
                    </div>
                </div>
                <script>
                    function closePopup() {
                        document.querySelector(".popup").remove();
                    }
                    setTimeout(closePopup, 2000);
                    window.location.href = "lobby.php";
                    
                </script>';
        } else {
            echo '<div class="popup" style="z-index: 9999; background-color: rgba(0, 0, 0, 0.7); position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; ">
                    <div class="popup-content" style="margin-top: 10%;display: flex; justify-content: center;">
                        <h2 style="text-align: center;">Incorrect password</h2>
                    </div>
                </div>
                <script>
                    function closePopup() {
                        document.querySelector(".popup").remove();
                    }
                    setTimeout(closePopup, 2000);
                    
                </script>';
        }
    }

   
}
if(isset($_SESSION['username'])){
    header("location: lobby.php");
    die();
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="tip2.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">


</head>
<head>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
             background-color: #1a1a1a;
             color: #fff;
        font-family: 'Comic Neue', 'Comic Sans MS', 'Comic Sans', cursive;
        font-weight: bold;
        }
        .coming-soon {
            margin-bottom:5%;

            font-size: 2.5em;
            text-align: center;
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input {
            padding: 20px;
            font-size: 2em;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 20px 40px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 2em;
            max-width: 500px;
        }

        @media only screen and (max-width: 600px) {
            input {
                font-size: 1.5em;
            }
            button {
                font-size: 1.5em;
            }
            .coming-soon {
            margin-bottom:5%;

            font-size: 1em;
            text-align: center;
            animation: blink 1s infinite;
        }
        }
    </style>
</head>
<body>

    <div style="display: flex; flex-direction: column; align-items: center;">

    <h1 style="font-size: 95px;"> <span class="coinlogo"style="display: inline-block; width: 100px; height: 100px; background-color: #ff9900; margin-left: -100px; border-radius: 50%; line-height: 100px; text-align: center;">tiparu</span> </h1>

<div class="coming-soon">Play and Earn Money with your Tap</div>

        <form method="post">
            <h1>Login/Register</h1>
            <input type="text" maxlength="20" name="username" placeholder="Username" required><br>
            <input type="password" maxlength="20" name="password" placeholder="Password" required><br>
            <button type="submit">Enter Lobby</button>
        </form>
    </div>
</body>

</html>
