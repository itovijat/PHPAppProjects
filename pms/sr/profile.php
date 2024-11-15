<?php include_once "head2.php"; ?>
<div class="content2">
    <!-- Main content goes here -->

    <div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h2 class="h5 mb-0">Your Profile</h2>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <?php
                $sql = "SELECT * FROM user WHERE email='" . $_SESSION['email'] . "'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<p class='mb-2'><strong>Role:</strong> " . htmlspecialchars(strtoupper($row['role'])) . "</p>";
                        echo "<p class='mb-2'><strong>Status:</strong> " . ($row['status'] == 0 ? 'Active' : 'Blocked') . "</p>";
                        echo "<p class='mb-2'><strong>Company:</strong> " . htmlspecialchars($row['company']) . "</p>";
                    }
                } else {
                    echo "<p class='text-danger'>No results found.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h2 class="h5 mb-0">Update Profile</h2>
            </div>
            <div class="card-body">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
                    $email = $_POST['email'];
                    $oldpassword = md5($_POST['oldpassword']);
                    $newpassword = md5($_POST['password']);
                    $confirmpassword = md5($_POST['confirmpassword']);
                    $sql = "SELECT * FROM user WHERE email='" . $_SESSION['email'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['password'] == $oldpassword) {
                            if ($newpassword == $confirmpassword) {
                                $update_sql = "UPDATE user SET email='$email', password='$newpassword' WHERE email='" . $_SESSION['email'] . "'";
                                if (mysqli_query($conn, $update_sql)) {
                                    echo "<script>alert('Profile updated successfully');</script>";
                                    $_SESSION['email'] = $email;
                                } else {
                                    echo "<p class='text-danger'>Error updating profile.</p>";
                                }
                            } else {
                                echo "<script>alert('New password and confirm password do not match.');</script>";
                            }
                        } else {
                            echo "<script>alert('Old password is incorrect.');</script>";
                        }
                    } else {
                        echo "<p class='text-danger'>No results found.</p>";
                    }
                }
                ?>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['PHP_SELF'])); ?>" method="POST">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="oldpassword" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter old password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" pattern="(?=.*\d)[A-Za-z\d]{8,}" title="Must contain at least 8 characters, including letters and numbers" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Enter confirm password" pattern="(?=.*\d)[A-Za-z\d]{8,}" title="Must contain at least 8 characters, including letters and numbers" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "foot.php"; ?>
