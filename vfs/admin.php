<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}
include_once "db.php";

?>



<header>
    <div class="username"><?php echo $_SESSION['username']; ?></div>
    <div class="logout"><a style="color:white;text-decoration:none" href="logout.php">Logout</a></div>
</header>

<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #333;
        color: white;
    }

    .username {
        font-size: 20px;
    }

    .logout {
        cursor: pointer;
    }

    .logout i {
        font-size: 25px;
    }

    
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
<nav style="display: flex; justify-content: space-around; align-items: center; background-color: #333; color: white; padding: 10px; margin-bottom: 20px;">
<a style="color: white; text-decoration: none; font-size: 20px;" href="admin.php">Home</a>
<a style="color: white; text-decoration: none; font-size: 20px;" href="apply_visa.php">Apply Visa</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="user_apply.php">User Apply</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="profile_list.php">Profile List</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="add_profile.php">Add New Profile</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="user_file.php">User File</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="doc.php">Doc</a>
    <a style="color: white; text-decoration: none; font-size: 20px;" href="photo.php">Photo</a>

</nav>
  
<h2 style="text-align: center; margin-bottom: 20px;">Update Password</h2>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="display: flex; justify-content: center; align-items: center;">
                <label for="oldpassword">Old Password:</label>
                <input type="password" id="oldpassword" name="oldpassword" required><br><br>
                <label for="newpassword">New Password:</label>
                <input type="password" id="newpassword" name="newpassword" required><br><br>
                <input type="submit" value="Update Password">
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST['oldpassword']) || empty($_POST['newpassword'])) {
                    echo "<script>alert('Please fill in all the fields.');</script>";
                } else {
                $oldpassword = md5($_POST['oldpassword']);
                $newpassword = md5($_POST['newpassword']);
                $sql = "UPDATE user SET password='$newpassword' WHERE username='".$_SESSION['username']."' AND password='$oldpassword'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Password updated successfully');</script>";
                } else {
                    echo "<script>alert('Error updating password: " . $conn->error . "');</script>";
            }}}
            ?>
    
         
         
                <h2 style="text-align: center; margin-bottom: 20px;">Add New User</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="display: flex; flex-direction: column; align-items: center; width: 300px; margin: 0 auto;">
                    <div class="form-group" style="width: 100%; margin-bottom: 20px;">
                        <label for="username" style="display: block; text-align: center; margin-bottom: 10px;">New Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required style="width: 100%;">
                    </div>
                    <div class="form-group" style="width: 100%; margin-bottom: 20px;">
                        <label for="password" style="display: block; text-align: center; margin-bottom: 10px;">New Password:</label>
                        <div style="position: relative;">
                            <input type="password" class="form-control" id="password" name="password" required style="width: 100%;">
                            <i style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" class="fa fa-eye" id="togglePassword"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 20px;">Add New User</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST['username']) || empty($_POST['password'])) {
                        echo "<script>alert('Please fill all the fields.');</script>";
                    } else {
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);

                    $sql = "SELECT * FROM user WHERE username='$username'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo "<script>alert('Username already exists.');</script>";
                    } else {
                        $sql = "INSERT INTO user (username, password)
                        VALUES ('$username', '$password')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('New record created successfully');</script>";
                        } else {
                            echo "<script>alert('Error: $sql <br> $conn->error');</script>";
                    }
                }
            
            }
        
        }
                ?>


                <h2 style="text-align: center; margin-top: 20px;">All Users</h2>
                <style>
                    table {
                        background-color: #333;
                        color: #fff;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.5);
                    }
                    th, td {
                        padding: 10px;
                        border: 1px solid #444;
                    }
                    th {
                        background-color: #444;
                    }
                    td {
                        background-color: #333;
                    }
                </style>
                <table class="table" style="margin: 0 auto; text-align: center;">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT username FROM user";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["username"]. "</td>
                                        <td><a style='color:white;' href='admin.php?deleteid=" . $row["username"]. "'>delete</a></td>
                                    </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                if (isset($_GET['deleteid'])) {
                    $deleteid = $_GET['deleteid'];
                    $sql = "DELETE FROM user WHERE username='$deleteid'";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Record deleted successfully');</script>";
                        echo "<script>window.location.href='admin.php';</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
                
        



