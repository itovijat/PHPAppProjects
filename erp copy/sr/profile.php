<?php
include_once 'head2.php';

?>



<div class="content2">
    <div class="row g-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h2 class="h5 mb-0">Your Profile</h2>
                </div>
                <div class="card-body">
                    <h3 class="h5 mb-3">Your Information</h3>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-user fa-2x mr-2"></i>
                        <p class="mb-0"><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-user-tag fa-2x mr-2"></i>
                        <p class="mb-0"><strong>Role:</strong> <?php echo htmlspecialchars(strtoupper($_SESSION['role'])); ?></p>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-building fa-2x mr-2"></i>
                        <p class="mb-0"><strong>Company:</strong> <?php echo htmlspecialchars($_SESSION['company']); ?></p>
                    </div>
                    
                    <?php
                    $sql = "SELECT * FROM users WHERE id='" . $_SESSION['userid'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="oldpassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="oldpassword" name="oldpassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newpassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newpassword" name="newpassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <?php
                    } else {
                        echo "<p class='text-danger'>No results found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['confirmpassword'])) {
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($newpassword != $confirmpassword) {
        echo "<script>alert('New password and confirm password do not match.');</script>";
    } else {
        $sql = "SELECT * FROM users WHERE id='" . $_SESSION['userid'] . "'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($row['password'] == md5($oldpassword)) {

                $update_sql = "UPDATE users SET password='" . md5($newpassword) . "' WHERE id='" . $_SESSION['userid'] . "'";

                if (mysqli_query($conn, $update_sql)) {
                    $_SESSION['cp'] = false;

                    echo "<script>alert('Password updated successfully'); window.location.href = 'index.php';</script>";
                } else {
                    echo "<p class='text-danger'>Error updating password.</p>";
                }
            } else {
                echo "<script>alert('Old password is incorrect.');</script>";
            }
        } else {
            echo "<p class='text-danger'>No results found.</p>";
        }
    }
}
?>


<?php
include_once 'hfoot.php';

?>