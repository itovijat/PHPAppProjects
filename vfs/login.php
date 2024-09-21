<?php
include_once "db.php";
if(isset($_POST['loginbtn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM user WHERE username='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['username'] = $email;
    
        header("location:admin.php");
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
    </style>
</head>
<body>
    <form action="<?php echo basename($_SERVER['PHP_SELF']);?>" method="POST" style="display: flex; flex-direction: column; align-items: center;">
        <div class="form-group" style="width: 100%; margin-bottom: 20px;">
            <label style="color: #666; display: block; text-align: center; margin-bottom: 10px;" for="email">Username</label>
            <input style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; width: 100%;" type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group" style="width: 100%; margin-bottom: 20px;">
            <label style="color: #666; display: block; text-align: center; margin-bottom: 10px;" for="password">Password</label>
            <div style="position: relative;">
                <input style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; width: 100%;" type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                <i style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" class="fa fa-eye" id="togglePassword"></i>
            </div>
        </div>
        <button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" type="submit" class="btn btn-primary" name="loginbtn">Login</button>
    </form>
</body>
