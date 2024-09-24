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
?>