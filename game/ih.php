<?php
include 'db.php';

if(!isset($_SESSION['username'])){
  header("location: login.php");
  die();
}
$username = $_SESSION['username'];


?>
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
    setInterval(updateLastSeen, 10000);
</script>
<?php

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


<!DOCTYPE html>
<html>
<head>
    <title>Lobby</title>
   




</head>
<body style="display: flex;justify-content: center;flex-direction: column; align-items: center; padding: 20px;">
   

   <div style="width: 100%;">


        
       


  

           

 
        <div style="display: flex; justify-content: space-between; align-items: center; height: 120px;">
       <h1 style="font-size: 77px;"> <span class="coinlogo"style="display: inline-block; width: 100px; height: 100px; background-color: #ff9900; margin-right: -20px; border-radius: 50%; line-height: 90px; text-align: center;">tiparu</span> </h1>









             <h1><?php echo $user['username']; ?> <span style="display: inline-block; width: 35px; height: 35px; background-color: #ff9900; margin-right: -20px; border-radius: 50%; line-height: 30px; text-align: center;">t</span> 
                 <small><?php echo $user['points']; ?></small>
            <a href="logout.php" style="color: #fff; text-decoration: none;">Logout</a></h1>
        </div>

        <style>
    

        @media screen and (max-width: 600px) {
            .navbar a {
                font-size: 14px;
            }
            body {
                width: 80%;
                overflow: hidden;
            }
        }

        body {
                background-color: #1a1a1a;
                font-family: 'Press Start 2P', cursive;
                color: #fff;
            }

            .blink {
                animation: blink 1s infinite;
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


    </style>
 
        
 <div class="navbar" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #333; border-radius: 10px;">
    <a href="lobby.php" style="margin-right: 30px; color: white; text-decoration: none; font-size: 30px;">
        <img src="img/l.png" alt="Lobby" style="width: 30px; vertical-align: middle;"> Lobby
    </a>
    <div class="dropdown" style="position: relative;">
        <a style="margin-right: 30px; color: white; text-decoration: none; cursor: pointer; font-size: 30px;">
            <img src="img/c.png" alt="Coins" style="width: 30px; vertical-align: middle;"> Coins
        </a>
        <div class="dropdown-content" style="display: none; position: absolute; background-color: #444; border-radius: 10px; padding: 10px; top: 30px; right: 0;">
            <a href="send_coin.php" style="display: block; margin-bottom: 10px; color: white; text-decoration: none; font-size: 30px;">Send Coin</a>
            <a href="buy.php" style="display: block;margin-bottom: 10px;color: white; text-decoration: none; font-size: 30px;">Buy Coin</a>

            <a href="widthdraw.php" style="display: block;margin-bottom: 10px; color: white; text-decoration: none; font-size: 30px;">Widthdraw</a>

        </div>
    </div>
    <a href="online.php" style="margin-right: 30px; color: white; text-decoration: none; font-size: 30px;">
        <span style="width: 20px; height: 20px; border-radius: 50%; background-color: green; display: inline-block; animation: blink 2s infinite;" id="onlineblink"></span> Online 
        <span id="onlinenotification" style="width: 20px; height: 20px;  display: inline-block; font-size: 20px"></span>
    </a>
    <a href="challenges.php" style="margin-right: 30px; color: white; text-decoration: none; font-size: 30px;">
        <img src="img/f.png" alt="Challenges" style="width: 30px; vertical-align: middle;">        
        
        Challenges 
        <span id="challengesnotification" style="width: 20px; height: 20px;  display: inline-block; "></span>
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

  
