<?php include_once "head1.php"; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container-fluid">



<div class="row">
    <div class="col-md-6">
        <!-- User Profile -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white">
                <h5>Your Profile</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Name:</strong>
                        <span class="badge badge-secondary"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
                    </div>
                    <?php
                    $sql = "SELECT * FROM user WHERE email='" . $_SESSION['email'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='list-group-item d-flex justify-content-between align-items-center'><strong>Role:</strong><span class='badge badge-info'>" . htmlspecialchars(strtoupper($row['role'])) . "</span></div>";
                            echo "<div class='list-group-item d-flex justify-content-between align-items-center'><strong>Status:</strong><span class='badge badge-" . ($row['status'] == 0 ? 'success' : 'danger') . "'>" . ($row['status'] == 0 ? 'Active' : 'Blocked') . "</span></div>";
                            echo "<div class='list-group-item d-flex justify-content-between align-items-center'><strong>Company:</strong><span class='badge badge-secondary'>" . htmlspecialchars($row['company']) . "</span></div>";
                        }
                    } else {
                        echo "<div class='list-group-item list-group-item-danger'>No results found.</div>";
                    }
                    ?>
                </div>

                <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading"><i class="fas fa-users"></i> User Summary</h4>
                <?php
                $sql = "SELECT company, status, role, COUNT(DISTINCT email) AS total FROM user GROUP BY company, status, role";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p class='mb-2'><i class='fas fa-building'></i> <strong>Company:</strong> <span class='badge badge-secondary'>" . htmlspecialchars($row['company']) . "</span> - <i class='fas fa-circle'></i> <strong>Status:</strong> <span class='badge badge-" . ($row['status'] == 0 ? 'success' : 'danger') . "'>" . ($row['status'] == 0 ? 'Active' : 'Blocked') . "</span> - <i class='fas fa-user-tag'></i> <strong>Role:</strong> <span class='badge badge-info'>" . htmlspecialchars($row['role']) . "</span> - <i class='fas fa-user-friends'></i> <strong>Number of users:</strong> <span class='badge badge-light'>" . $row['total'] . "</span></p>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Update Profile -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-warning text-white">
                <h5>Update Profile</h5>
            </div>
            <div class="card-body">
                <form method="POST">
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
                    <button type="submit" class="btn btn-warning
                     w-100">Submit</button>
                </form>
            </div>

            <div class="card-footer text-muted">
                <a href="logout.php" class="btn btn-danger w-100">Logout</a>
            </div>
        </div>
    </div>
</div>
    <div class="row">
    

        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5>User Management</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['deleteid'])) {
                                $deleteid = $_GET['deleteid'];
                                $sql = "DELETE FROM user WHERE email='$deleteid'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
                                } else {
                                    echo "<script>alert('Error'); location.replace('index.php');</script>";
                                }
                            }

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
                                $email = $_POST['email'];
                                $password = md5($_POST['password']);
                                $role = $_POST['role'];
                                $company = $_POST['company'];
                                $status = $_POST['status'];
                                $sql = "INSERT INTO user (email, password, role, company, status) VALUES ('$email', '$password', '$role', '$company', '$status') ON DUPLICATE KEY UPDATE status='$status', role='$role', company='$company', password='$password'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
                                } else {
                                    echo "<script>alert('Error'); location.replace('index.php');</script>";
                                }
                            }

                            if (isset($_GET['activateid'])) {
                                $activeid = $_GET['activateid'];
                                $sql = "UPDATE user SET status=IF(status='0','1','0') WHERE email='$activeid'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
                                } else {
                                    echo "<script>alert('Error'); location.replace('index.php');</script>";
                                }
                            }
                            if (isset($_GET['resetid'])) {
                                $resetid = $_GET['resetid'];
                                $sql = "UPDATE user SET password=MD5('$resetid') WHERE email='$resetid'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
                                } else {
                                    echo "<script>alert('Error'); location.replace('index.php');</script>";
                                }
                            }

                            ?>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" placeholder="Enter role" required>
                                </div>
                                <div class="mb-3">
                                    <label for="company" class="form-label">Company</label>
                                    <input type="text" class="form-control" id="company" name="company" placeholder="Enter company" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5>Users List</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Company</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT email, role, company, status FROM user";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                            echo "<td>
                                                    <a href='index.php?activateid=" . htmlspecialchars($row['email']) . "' class='btn btn-sm " . ($row['status'] == 0 ? 'btn-warning' : 'btn-danger') . "'>" . ($row['status'] == 0 ? 'Deactive' : 'Active') . "</a>
                                                    <a href='index.php?deleteid=" . htmlspecialchars($row['email']) . "' class='btn btn-sm btn-danger'>Delete</a>
                                                    <a href='index.php?resetid=" . htmlspecialchars($row['email']) . "' class='btn btn-sm btn-secondary'>Reset</a>
                                                  </td>";
                                        
                                        
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center'>No results found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

