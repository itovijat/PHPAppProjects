<?php include_once "head2.php"; ?>
<div class="content2">
    <!-- Main content goes here -->
    <?php if (isset($_SESSION['cp']) && $_SESSION['cp'] === true)
{ ?>
    <div class="alert alert-danger text-center" role="alert" style="animation: fadeIn 2s infinite ease-in-out ;">
        <strong>Please change the password first!</strong>
    </div>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    <?php
} ?>
    <div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h2 class="h5 mb-0">Your Profile</h2>
            </div>
            <div class="card-body">
                <h3 class="h5 mb-3">Your Information</h3>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user fa-2x mr-2"></i>
                    <p class="mb-0"><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                </div>
                <?php
$sql = "SELECT * FROM user WHERE email='" . $_SESSION['email'] . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
?>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-tag fa-2x mr-2"></i>
                            <p class="mb-0"><strong>Role:</strong> <?php echo htmlspecialchars(strtoupper($row['role'])); ?></p>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-circle fa-2x mr-2" style="color: <?php echo $row['status'] == 0 ? 'green' : 'red'; ?>"></i>
                            <p class="mb-0"><strong>Status:</strong> <?php echo $row['status'] == 0 ? 'Active' : 'Blocked'; ?></p>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-building fa-2x mr-2"></i>
                            <p class="mb-0"><strong>Company:</strong> <?php echo htmlspecialchars($row['company']); ?></p>
                        </div>
                        <?php
    }
}
else
{
?>
                    <p class="text-danger">No results found.</p>
                    <?php
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']))
{
    $email = $_POST['email'];
    $oldpassword = md5($_POST['oldpassword']);
    $newpassword = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    if ($newpassword == $confirmpassword)
    {
        $sql = "SELECT * FROM user WHERE email='" . $_SESSION['email'] . "'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);

            if ($row['password'] == $oldpassword)
            {
                if ($newpassword == $confirmpassword)
                {
                    $update_sql = "UPDATE user SET email='$email', password='$newpassword' WHERE email='" . $_SESSION['email'] . "'";

                    if (mysqli_query($conn, $update_sql))
                    {
                        $_SESSION['cp'] = false;

                        echo "<script>alert('Profile updated successfully'); window.location.href = 'index.php';</script>";
                        $_SESSION['email'] = $email;
                    }
                    else
                    {
                        echo "<p class='text-danger'>Error updating profile.</p>";
                    }
                }
                else
                {
                    echo "<script>alert('New password and confirm password do not match.');</script>";
                }
            }
            else
            {
                echo "<script>alert('Old password is incorrect.');</script>";
            }
        }
        else
        {
            echo "<p class='text-danger'>No results found.</p>";
        }
    }
    else
    {
        echo "<script>alert('New password and confirm password do not match.');</script>";
    }
}
?>

                <form action="<?php echo htmlspecialchars(basename($_SERVER['PHP_SELF'])); ?>" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="oldpassword" class="form-label">Password <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i></label>
                        <input type="password" class="form-control pass" id="oldpassword" name="oldpassword" placeholder="Enter old password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control pass" id="password" name="password" placeholder="Enter new password" pattern="(?=.*\d)[A-Za-z\d]{8,}" title="Must contain at least 8 characters, including letters and numbers" required>
                    </div>
                    <div class="mb-3">
                        
                        <div class="progress">
                            <div class="progress-bar" id="confirmPasswordMatch" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        
                        </div>
                        <div class="mt-2" id="confirmPasswordMatchText"></div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control pass" id="confirmpassword" name="confirmpassword" placeholder="Enter confirm password" pattern="(?=.*\d)[A-Za-z\d]{8,}" title="Must contain at least 8 characters, including letters and numbers" required>
                    </div>
                    <div class="mb-3">
                     
                        <div class="progress">
                            <div class="progress-bar" id="passwordStrength" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mt-2" id="passwordStrengthText"></div>
                    </div>
                   
                    

                    <script>
                        const passwordField = document.querySelector("#password");
                        const confirmPasswordField = document.querySelector("#confirmpassword");
                        const passwordStrengthBar = document.querySelector("#passwordStrength");
                        const passwordStrengthText = document.querySelector("#passwordStrengthText");
                        const confirmPasswordMatchBar = document.querySelector("#confirmPasswordMatch");
                        const confirmPasswordMatchText = document.querySelector("#confirmPasswordMatchText");

                        function checkPasswordStrength() {
                            const password = passwordField.value;
                            const passwordLength = password.length;
                            let passwordStrength = 0;

                            if (passwordLength > 7) {
                                passwordStrength += 25;
                            }
                            if (password.match(/[a-z]/)) {
                                passwordStrength += 25;
                            }
                            if (password.match(/[A-Z]/)) {
                                passwordStrength += 25;
                            }
                            if (password.match(/[0-9]/)) {
                                passwordStrength += 25;
                            }

                            let passwordStrengthText = "";
                            let passwordStrengthColor = "";
                            if (passwordStrength < 50) {
                                passwordStrengthText = "Weak";
                                passwordStrengthColor = "red";
                            } else if (passwordStrength >= 50 && passwordStrength < 75) {
                                passwordStrengthText = "Medium";
                                passwordStrengthColor = "yellow";
                            } else {
                                passwordStrengthText = "Strong";
                                passwordStrengthColor = "green";
                            }

                            passwordStrengthBar.style.width = passwordStrength + "%";
                            passwordStrengthBar.style.backgroundColor = passwordStrengthColor;
                            passwordStrengthText.textContent = passwordStrengthText;
                        }

                        function checkConfirmPasswordMatch() {
                            const password = passwordField.value;
                            const confirmPassword = confirmPasswordField.value;
                            const confirmPasswordMatch = password === confirmPassword;
                            const confirmPasswordMatchText = confirmPasswordMatch ? "Match" : "Not Match";

                            confirmPasswordMatchBar.style.width = confirmPasswordMatch ? "100%" : "0%";
                            confirmPasswordMatchText.textContent = confirmPasswordMatchText;
                        }

                        passwordField.addEventListener("input", checkPasswordStrength);
                        confirmPasswordField.addEventListener("input", checkConfirmPasswordMatch);

                        
                    </script>

                    <button type="submit" class="btn btn-danger w-100">Submit</button>
                </form>
                

                    
    <script>
        function togglePassword() {
            var passField = document.querySelector(".pass");
            var toggleIcon = document.querySelector(".toggle-password");
            const passFields = document.querySelectorAll(".pass");
            passFields.forEach(field => {
                if (field.type === "password") {
                    field.type = "text";
                    toggleIcon.classList.remove("fa-eye");
                    toggleIcon.classList.add("fa-eye-slash");
                } else {
                    field.type = "password";
                    toggleIcon.classList.remove("fa-eye-slash");
                    toggleIcon.classList.add("fa-eye");
                }
            });
        }
    </script>
            </div>
        </div>
    </div>
</div>

<?php include_once "foot.php"; ?>
