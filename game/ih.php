<?php
include 'db.php';

if(!isset($_SESSION['username'])){
  header("location: login.php");
  die();
}
$username = $_SESSION['username'];


?>

<?php

// Update user status
$sql = "UPDATE users SET status='online' WHERE username='$username'";
if ($conn->query($sql) === TRUE) {
    // echo "User status updated successfully";
} else {
   // echo "Error updating user status: " . $conn->error;
}
// Fetch user details
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Tap & Earn</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="tip2.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">





        <style>
    

        @media screen and (max-width: 600px) {
        
            body {
                width: 80%;
                overflow: hidden;
            }
        }

        body {
                background-color: #1a1a1a;
                font-family: 'Comic Neue', 'Comic Sans MS', 'Comic Sans', cursive;
                font-weight: bold;
                color: #fff;
            }

        
      

    .navbar {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background-color: #333;
        border-radius: 10px;
    }

    .navbar a {
        margin-right: 30px;
        color: white;
        text-decoration: none;
        font-size: 30px;
    }

    .navbar img {
        height: 30px;
        vertical-align: middle;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #444;
        border-radius: 10px;
        padding: 10px;
        top: 30px;
        right: 0;
    }

    .navbar .dropdown-content a {
        display: block;
        margin-bottom: 10px;
        color: white;
        text-decoration: none;
        font-size: 30px;
    }

    @media only screen and (max-width: 600px) {
        .navbar .dropdown-content a {
            font-size: 15px;
        }

        .navbar  a {
     
            font-size: 10px;
            display: block;
            text-align: center;
        }
        

  
    }

    #onlineblink {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: green;
        display: inline-block;
    }
    @keyframes blink {
                0% {
                    opacity: 1;
                }
                50% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }

    .logo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 120px;
        }

        .logo h1:first-child {
            font-size: 77px;
        }
        .logo h1:last-child {
            display: flex;
            align-items: center;
        }
        .logo h1:last-child span {
            display: inline-block;
            width: 35px;
            height: 35px;
            background-color: #ff9900;
            border-radius: 50%;
            line-height: 30px;
            text-align: center;
margin-left: 10px;
margin-right: 2px;
        }
        .logo h1:last-child a {
            margin-left: 20px;
            color: #fff;
            text-decoration: none;
        }
.coinlogo{


    display: inline-block; width: 100px; height: 100px; background-color: #ff9900; margin-right: -20px; border-radius: 50%; font-size: 100px; line-height: 100px; text-align: center;

}
        
        @media only screen and (max-width: 600px) {
            .logo {
                height: 50px;
            }
            .logo h1:first-child {
                font-size: 30px;
            }
            .logo h1:last-child {
                display: flex;
                align-items: center;
                font-size: 15px;
            }
            .logo h1:last-child span {
                width: 25px;
                height: 25px;
                margin-right: -15px;
                line-height: 20px;
            }
            .logo h1:last-child a {
                margin-left: 15px;
            }
            .coinlogo{

                width:30px; height: 30px; line-height: 30px; font-size: 30px;

            }
            .logo h1:last-child span {
           
            width: 15px;
            height: 15px;
            background-color: #ff9900;

            line-height: 15px;
            font-size: 15px;
            margin-left: 5px;
margin-right: 1px;
         
        }
        }
  
</style>
</head>
<body style="display: flex;justify-content: center;flex-direction: column; align-items: center; padding: 20px;">
   
   <div style="width: 100%;">

    <style>
   
    </style>
    <div class="logo">
        <h1> <span class="coinlogo">tiparu</span> </h1>
        <h1><?php echo $user['username']; ?> <span>t</span> 
            <small><?php echo $user['points']; ?></small>
            <a href="logout.php">Logout</a>
        </h1>
    </div>
<div class="navbar" style="display: flex; justify-content: center; align-items: center;">
    <a href="lobby.php" style="margin: 0 10px;">
        <img src="img/l.png" alt="Lobby">
        Lobby
    </a>
    <div class="dropdown" style="margin: 0 10px;">
        <a>
            <img src="img/c.png" alt="Coins">
            Coins
        </a>
        <div class="dropdown-content">
            <a href="send_coin.php">Send Coin</a>
            <a href="buy_coin.php">Buy Coins</a>
            <a href="widthdraw.php" >Widthdraw</a>
        </div>
    </div>
    <a href="online.php" style="margin: 0 10px;">
        <span id="onlineblink"></span>
        <span id="onlinenotification">Online</span>
        
    </a>
    <a href="challenges.php" style="margin: 0 10px;">
        <img id="challengesnotify" src="img/f.png" alt="Challenges">
        <span id="challengesnotification">Challenges
        </span>
    </a>
</div>

<script>
    const dropdown = document.querySelector('.dropdown');
    const dropdownContent = document.querySelector('.dropdown-content');

    dropdown.addEventListener('click', () => {
        dropdownContent.style.display = dropdownContent.style.display === 'none' ? 'block' : 'none';
    });

    // Close the dropdown if the user clicks outside of it
    window.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    });
</script>

<script>
    function updateLastSeen() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
            }
        };
        xhttp.open("GET", "update_last_seen.php", true);
        xhttp.send();
    }
    setInterval(updateLastSeen, 5000);
</script>

  
