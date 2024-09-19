<?php

include 'db.php';

// Create tables if they don't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    points INT DEFAULT 0,
    status VARCHAR(10) DEFAULT 'online'
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS challenges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    challenger_id INT NOT NULL,
    challenged_id INT NOT NULL,
    challenger_tap INT NOT NULL,
    challenged_tap INT NOT NULL,
    status VARCHAR(10) DEFAULT 'pending'
)";
$conn->query($sql);
session_start();
$user_name = $_SESSION['username'];

$challenge_id = $_GET['challenge_id'];
$sql = "SELECT status FROM challenges WHERE id=$challenge_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row['status'] != 'accepted'){
    echo "<script>window.location.href='lobby.php?username=".$_SESSION['username']."';</script>";
    exit;
}

echo "User ID: ".$user_name;

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

<button id="tapButton">Tap Me</button>
<script>
    var tapCount = 0;
    var tapped = false;
    document.getElementById('tapButton').addEventListener('click', function(){
        tapCount++;
        console.log(tapCount);
        tapped = true;
    });
    setTimeout(function(){
        if(tapped){
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
        }
    }, 10000);

    setTimeout(function(){
        var fullScreenWaiting = document.createElement('div');
        fullScreenWaiting.id = "fullScreenWaiting";
        fullScreenWaiting.style.position = "fixed";
        fullScreenWaiting.style.top = "0";
        fullScreenWaiting.style.left = "0";
        fullScreenWaiting.style.width = "100%";
        fullScreenWaiting.style.height = "100%";
        fullScreenWaiting.style.background = "rgba(0,0,0,0.5)";
        fullScreenWaiting.style.zIndex = "10000";
        fullScreenWaiting.style.display = "flex";
        fullScreenWaiting.style.justifyContent = "center";
        fullScreenWaiting.style.alignItems = "center";
        fullScreenWaiting.innerHTML = "Waiting for results...";
        document.body.appendChild(fullScreenWaiting);
        
        setTimeout(function(){
            document.body.removeChild(fullScreenWaiting);
            document.body.removeChild(tapButton);
            var resultDiv = document.createElement('div');
            resultDiv.id = "resultDiv";
            resultDiv.style.position = "fixed";
            resultDiv.style.top = "0";
            resultDiv.style.left = "0";
            resultDiv.style.width = "100%";
            resultDiv.style.height = "100%";
            resultDiv.style.background = "rgba(0,0,0,0.5)";
            resultDiv.style.zIndex = "10000";
            resultDiv.style.display = "flex";
            resultDiv.style.justifyContent = "center";
            resultDiv.style.alignItems = "center";
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_challenge.php?challenge_id=<?php echo $challenge_id; ?>&user_id=<?php echo $user_id; ?>', true);
            xhr.send();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    resultDiv.innerHTML =tapCount +'<br>'+ xhr.responseText+'<br><br>';
                    var button = document.createElement('button');
                    button.style.position = "absolute";
                    button.style.bottom = "10px";
                    button.style.left = "50%";
                    button.style.transform = "translate(-50%, 0)";
                    button.innerHTML = "Go to Lobby";
                    button.onclick = function(){
                        window.location.href = "lobby.php?username=" + '<?php echo $user_name; ?>';
                    }
                    resultDiv.appendChild(button);

                }
            }
            document.body.appendChild(resultDiv);
           
        }, 3000);
    }, 10000);
  
</script>

  