<?php

include 'db.php';


?>

<head>
    <title>Tap & Earn</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="tip2.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
</head>
<?php
$user_name = $_SESSION['username'];

$user_id_sql = "SELECT id FROM users WHERE username='$user_name'";
$user_id_result = $conn->query($user_id_sql);
$user_id_row = $user_id_result->fetch_assoc();
$user_id = $user_id_row['id'];

$challenge_id = $_GET['challenge_id'];
$sql = "SELECT status FROM challenges WHERE id=$challenge_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row['status'] != 'accepted'){
    echo "<script>window.location.href='lobby.php?username=".$_SESSION['username']."';</script>";
    exit;
}

// Fetch opponent username
$sql = "SELECT challenger_id, challenged_id,created_at FROM challenges WHERE id=$challenge_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row['challenger_id'] == $user_id){
    $opponent = $row['challenged_id'];
} 
else if ($row['challenged_id'] == $user_id) {
    $opponent = $row['challenger_id'];
}

else {
    $opponent = "Error";
}

$start_time=strtotime($row['created_at'])+15;


// Fetch opponent username
$sql = "SELECT username FROM users WHERE id=$opponent";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$opponentn = $row['username'];

echo "<div class='top'>
    <div>".$user_name."</div>
    <div><img src='img/f.png'></div>
    <div>".$opponentn."</div>
</div>";

// Update challenge status
$sql = "UPDATE users SET status='playing' WHERE username='$user_name'";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error updating record: " . $conn->error;
}
$user_id_sql = "SELECT id FROM users WHERE username='$user_name'";
$user_id_result = $conn->query($user_id_sql);
$user_id_row = $user_id_result->fetch_assoc();
$user_id = $user_id_row['id'];




?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<div style="display: flex; justify-content: center; align-items: center; width: 100%; font-size: 2em;">
    <div style="width: 45%; text-align: center;" id="time"></div>

    <div id="status_text" style="width: 10%; text-align: center;">Starting</div>


    <div id="etime" style="width: 45%; text-align: center;"><?php echo date("h:i:s A", $start_time);?></div>

<style>
 
</style>
</div>


<link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
        font-family: 'Comic Neue', 'Comic Sans MS', 'Comic Sans', cursive;
        font-weight: bold;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        zoom: 1;
        -moz-transform: scale(1);
        -moz-transform-origin: 0 0;
    }

    .game-header{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 95%;
        font-size: 2em;
    }
    .game-header > div{
        width: 42%;
        text-align: center;
    }
    .game-header > div:first-child{
        background-color: green;
        color:white;
    }
    .game-header > div:nth-child(2){
        width: 10%;
        background-color: yellow;
    }
    .game-header > div:last-child{
        background-color: red;
        color:white;
    }

    .top{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 10%;
        font-size: 2em;
       
    }
    .top > div{
        width: 45%;
        text-align: center;
        margin-top:10%;
    }
    .top > div:first-child{
        background-color: green;
        color:white;
    }
    .top > div:nth-child(2){
        width: 10%;
        background-color: yellow;
    }
    .top > div:nth-child(2) > img{
        width: 10vw;
    }
    .top > div:last-child{
        background-color: red;
        color:white;
    }

    #tapButton {
        position: absolute;
        width: 200px;
        height: 200px;
        background-color: gold;
        border: 5px solid green;
        border-radius: 50%;
        text-align: center;
        line-height: 110px;
        font-size: 50px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    #tapButton:hover {
        transform: scale(1.1);
    }

    #tapButton.animate {
        animation: burst 0.2s ease-in-out;
    }
    @keyframes burst {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.3);
        }
        100% {
            transform: scale(1);
        }
    }

    #etime {
        width: 45%;
        text-align: center;
    }
    @media only screen and (max-width: 600px) {
        body {
            font-size: 0.5em;
        }
        #tapButton {
            width: 100px;
            height: 100px;
            font-size: 20px;
            line-height: 40px;

        }
    }
</style>

<div id="tapButton" >Tiparu <p style="margin-top: 10px;" id="tapCountText">Tap</p></div>


<script>

var start_time = <?php echo $start_time; ?>*1000;
var end_time = start_time + (1000*10);

var tapCount = 0;
var tapped = false;

var button = document.getElementById('tapButton');
button.style.display = "none";

var left1 = 30;
        var top1 =  30;
        button.style.left = left1 + '%';
        button.style.top = top1 + '%';
   
   

setInterval(function(){
    var d = new Date();
    var now = d.toLocaleTimeString();


  var started=false;
    

    document.getElementById("time").innerHTML = now;



    

        if(d >= start_time && d <= end_time && !started){
            
        
            started=true;
            gg();
            document.getElementById("status_text").innerHTML = "Started";
            button.style.display = "block";
            document.getElementById("etime").innerHTML = Math.round((end_time - d)/1000) + ' sec';               

        } else  if(d > end_time){

            document.getElementById("status_text").innerHTML = "Ended";
            document.getElementById("etime").innerHTML = new Date(end_time  ).toLocaleTimeString();               
                     button.style.display = "none";
        }
        else  if(d < start_time){

document.getElementById("etime").innerHTML = Math.round((start_time - d)/1000) + ' sec';               
         button.style.display = "none";
}




    }, 1000);


   
    

        function gg(){
    
       
        





        button.addEventListener('click', function(){
            if(!tapped){
                tapCount++;
                console.log(tapCount);
                tapped = true;
      
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_challenge.php', true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("challenge_id=<?php echo $challenge_id; ?>&user_id=<?php echo $user_id; ?>&tap_count=" + tapCount);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                      //  alert(xhr.responseText);
                      tapped = false;
                    
                    }
                }
                
                
                left2 = Math.floor(Math.random() * (70 - 30 + 1) + 30);
                top2 =  Math.floor(Math.random() * (60 - 30 + 1) + 30);
                button.style.left = left2 + '%';
                button.style.top = top2 + '%';
                document.getElementById('tapCountText').innerHTML = tapCount;
                button.classList.add('animate');
                var audio = new Audio('tap.mp3');
                audio.play();
                setTimeout(function(){
                    button.classList.remove('animate');
                }, 200);
            }
        });
        
        setTimeout(function(){
            button.style.visibility = 'hidden';
            var countingText = document.createElement('div');
            countingText.id = "countingText";
            countingText.style.position = "fixed";
            countingText.style.top = "50%";
            countingText.style.left = "50%";
            countingText.style.transform = "translate(-50%, -50%)";
            countingText.style.textAlign = "center";
            countingText.style.fontSize = "50px";
            countingText.innerHTML = "Counting";
            document.body.appendChild(countingText);
        }, 10000);
        
        setTimeout(function(){
            var resultDiv = document.createElement('div');
            resultDiv.id = "resultDiv";
            resultDiv.style.position = "fixed";
            resultDiv.style.top = "0";
            resultDiv.style.left = "0";
            resultDiv.style.width = "100%";
            resultDiv.style.height = "100%";
            resultDiv.style.zIndex = "10000";
            resultDiv.style.display = "flex";
            resultDiv.style.justifyContent = "center";
            resultDiv.style.alignItems = "center";
            resultDiv.style.background = "#1a1a1a";
            resultDiv.style.color = "#fff";
            resultDiv.style.fontFamily = "'Press Start 2P', cursive";
           
           
            if(!resultDiv.innerHTML){
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'get_challenge.php?challenge_id=<?php echo $challenge_id; ?>&user_id=<?php echo $user_id; ?>&opponent_id=<?php echo $opponent; ?>', true);
                xhr.send();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        resultDiv.innerHTML = `<div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                            <h1 style="font-size: 50px;">` + xhr.responseText + `</h1>
                            <button style="background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer;" onclick="window.location.href='lobby.php?username=<?php echo $user_name; ?>';">Back to lobby</button>
                        </div>`;
                        resultDiv.onclick = function(){
                            window.location.href = "lobby.php?username=" + '<?php echo $user_name; ?>';
                        }
                    }
                }
            }

            document.body.appendChild(resultDiv);
        }, 15000);
         
        }
        
  

  
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