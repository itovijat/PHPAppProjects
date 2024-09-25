<?php
include 'db.php';

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];

  $sql = "UPDATE users SET last_seen=NOW() WHERE username='$username'";
  if ($conn->query($sql) === TRUE) {
    // echo "User last seen updated successfully";
  } else {
    echo "Error updating last seen: " . $conn->error;
  }
}

if(isset($_SESSION['username'])){
  $sql = "SELECT points FROM users WHERE username='$username'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if($row['points'] == 0){
    $_SESSION['points'] = 0;
  } else {
    $_SESSION['points'] = $row['points'];
  }
}

// Delete old pending challenges
$sql = "DELETE FROM challenges WHERE status = 'pending'  AND created_at < NOW() - INTERVAL 10 SECOND";
$conn->query($sql);
?>