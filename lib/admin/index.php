<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<br><br><br>

<?php
include_once "../dbconnect.php";
if (isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
       
        header("Location: orders.php");
        exit;
    }
    else
    {
        echo "<div class='alert alert-danger text-center'>Invalid username or password</div>";
    }
}
?>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Librarium.com Admin Login</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div></div>
