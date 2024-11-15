<?php include_once "head2.php"; ?>
<div class="content">
    <!-- Main content goes here -->

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Your Profile</h2>
                </div>
                <div class="card-body">
                    <p>Name: <?php echo $_SESSION['email']; ?></p>

                    <?php
                    $sql = "SELECT * FROM user WHERE email='".$_SESSION['email']."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<p>Role: ". strtoupper($row['role'])."</p>";
                            
                            if($row['status'] == 0){
                                echo "<p>Status: Active</p>";
                            } else {
                                echo "<p>Status: Blocked</p>";
                            }
                            
                            echo "<p>Company: ".$row['company']."</p>";
                           
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Update Profile</h2>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_POST['email'])) {
                        $email = $_POST['email'];
                        $oldpassword = $_POST['oldpassword'];
                        $newpassword = $_POST['password'];
                        $confirmpassword = $_POST['confirmpassword'];
                        $oldpassword = md5($oldpassword);
                        $newpassword = md5($newpassword);
                        $confirmpassword = md5($confirmpassword);
                        $sql = "SELECT * FROM user WHERE email='".$_SESSION['email']."'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                if($row['password'] == $oldpassword){
                                    if($newpassword == $confirmpassword){
                                        $sql = "UPDATE user SET email='$email', password='$newpassword' WHERE email='".$_SESSION['email']."'";
                                        if (mysqli_query($conn, $sql)) {
                                            echo "<script>alert('Profile updated successfully');</script>";
                                            //update session email
                                            $_SESSION['email'] = $email;
                                           
                                        } else {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        }
                                    }else{
                                        echo "<script>alert('New password and confirm password do not match.');</script>";
                                    }
                                }else{
                                    echo "<script>alert('Old password is incorrect.');</script>";
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                    }
                    ?>
                    <form action="<?php echo basename($_SERVER['PHP_SELF']);?>" method="POST">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $_SESSION['email']; ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="oldpassword">Old Password</label>
                            <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter old password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" pattern="(?=.*\d)[A-Za-z\d]{8,}" title="Must contain at least 8 characters, including letters and numbers" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Enter confirm password" pattern="(?=.*\d)[A-Za-z\d]{8,}" title="Must contain at least 8 characters, including letters and numbers" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once "foot.php"; ?>
