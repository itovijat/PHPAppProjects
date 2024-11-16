<?php include_once "head1.php"; ?>
<title>EOvijat Admin</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src='https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js'></script>
<link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon-16x16.png">
<link rel="manifest" href="../assets/site.webmanifest">

<?php
$copy = "";
if (isset($_GET['copy']))
{
    $copy = $_GET['copy'];

    echo "<style>
                            .copydiv {
                                position: fixed;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                background-color: #fefefe;
                                padding: 20px;
                                border: 1px solid #888;
                                border-radius: 10px;
                                box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
                                z-index: 9999;
                                text-align: center;
                            }
                            .copytext {
                                text-align: center;
                                font-size: 1.5em;
                            }
                            </style>";
    $baseUrl = $_SERVER['SERVER_NAME']; // Use server's base name
    echo "<div class='copydiv'><p class='copytext' id='copytext'>Open App or Visit: <br>$baseUrl<br>User Name: $copy<br>Password: $copy</p>
                            <button class='btn btn-primary' data-clipboard-target='#copytext' id='copyBtn'>Copy</button>
                            </div>";
    echo "<script>
                            var clipboard = new ClipboardJS('#copyBtn');
                            clipboard.on('success', function(e) {
                                console.log(e);
                                alert('Text copied');
                                location.replace('index.php');
                            });
                            clipboard.on('error', function(e) {
                                console.log(e);
                            });
                            </script>";
    echo "";
}

if (isset($_GET['deleteid']))
{
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM user WHERE email='$deleteid'";
    if (mysqli_query($conn, $sql))
    {
        echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
    }
    else
    {
        echo "<script>alert('Error'); location.replace('index.php');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']))
{
    $email = $_POST['email'];
    $password = md5($email);
    $role = $_POST['role'];
    $company = $_POST['company'];
    $status = $_POST['status'];

    $sqlcheck = "SELECT email FROM user WHERE email='$email'";
    $resultcheck = mysqli_query($conn, $sqlcheck);
    if (mysqli_num_rows($resultcheck) > 0)
    {
        echo "<script>alert('User already exists'); location.replace('index.php');</script>";
        die();
    }
    $sql = "INSERT INTO user (email, password, role, company, status) VALUES ('$email', '$password', '$role', '$company', '$status') ON DUPLICATE KEY UPDATE status='$status', role='$role', company='$company', password='$password'";
    if (mysqli_query($conn, $sql))
    {
        echo "<script>alert('Record for $email updated successfully'); location.replace('index.php?copy=$email');</script>";

    }
    else
    {
        echo "<script>alert('Error'); location.replace('index.php');</script>";
    }
}

if (isset($_GET['activateid']))
{
    $activeid = $_GET['activateid'];
    $sql = "UPDATE user SET status=IF(status='0','1','0') WHERE email='$activeid'";
    if (mysqli_query($conn, $sql))
    {
        echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
    }
    else
    {
        echo "<script>alert('Error'); location.replace('index.php');</script>";
    }
}
if (isset($_GET['resetid']))
{
    $resetid = $_GET['resetid'];
    $sql = "UPDATE user SET password=MD5('$resetid') WHERE email='$resetid'";
    if (mysqli_query($conn, $sql))
    {
        echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
    }
    else
    {
        echo "<script>alert('Error'); location.replace('index.php');</script>";
    }
}

if (isset($_GET['loginid']))
{

    $loginid = $_GET['loginid'];
    $sql = "SELECT * FROM user WHERE email='$loginid'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['company'] = $row['company'];
        $_SESSION['cp'] = false;
        echo "<script>alert('Login successfully'); location.replace('../$_SESSION[role]');</script>";
    }
}

?>



<div class="container-fluid">

<div class="container d-flex flex-column justify-content-center align-items-center">
    <div class="d-flex align-items-center p-3" style="border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
        <img src="../assets/eovijatlogo.png" alt="EOvijat Logo" style="width: 50px; height: 50px; margin-right: 15px;">
        <h2 class="mb-0">EOvijat Admin Panel</h2>
    </div>
</div>

<br>
<div>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-3 d-flex justify-content-center">
                            <div class="form-group">
                                <label for="tablename" class="form-label">Table Name</label>
                                <select class="form-control" id="tablename" name="tablename" required style="width: 250px;">
                                    <?php
// Assuming you have a connection to the database in $conn
$sql = "SHOW TABLES ";
$result = mysqli_query($conn, $sql);
if ($result)
{
    $selected = isset($_POST['tablename']) ? $_POST['tablename'] : 'none';
    while ($row = mysqli_fetch_row($result))
    {
        $selected_attr = ($selected == $row[0]) ? 'selected' : '';
        if ($row[0] != 'user')
        {
            echo '<option value="' . htmlspecialchars($row[0]) . '"' . $selected_attr . '>' . htmlspecialchars($row[0]) . '</option>';
        }
    }
}
?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : 0; ?>" required style="width: 250px;">
                            </div>

                            <div class="form-group">
                                <label for="search" class="form-label">Search</label>
                                <input type="text" class="form-control" id="search" name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>" placeholder="Search by name or id" style="width: 250px;">
                            </div>

                            <button type="submit" name="v" class="btn btn-warning" style="width: 150px;">View</button>
                        </form>
                        </div>

                            <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tdeletebtn']))
{
    if (isset($_POST['tablename'], $_POST['delete_id']))
    {
        $tablename = $_POST['tablename'];
        $id = $_POST['delete_id'];

        $sql = "DELETE FROM $tablename WHERE id=$id";
        if (mysqli_query($conn, $sql))
        {
            echo "<script>alert('Record deleted successfully');</script>";
        }
        else
        {
            echo "<script>alert('Error deleting record');</script>";
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tablename'], $_POST['id']))
{
    $tablename = $_POST['tablename'];
    $id = $_POST['id'];

    if ($id == 0)
    {
        $sql = "SELECT * FROM $tablename";
    }
    else
    {
        $sql = "SELECT * FROM $tablename WHERE id=$id";
    }
    $columns = array();
    $result_columns = mysqli_query($conn, "SHOW COLUMNS FROM $tablename");
    while ($row = mysqli_fetch_assoc($result_columns))
    {
        $columns[] = $row['Field'];
    }

    if (isset($_POST['search']) && !empty($_POST['search']))
    {
        $search = $_POST['search'];
        $sql = "SELECT * FROM $tablename WHERE " . implode(" LIKE '%$search%' OR ", $columns) . " LIKE '%$search%'";
    }

    $result = mysqli_query($conn, $sql);
    if ($result)
    {
        echo '<h3 style="text-align: center;">Table Name: ' . htmlspecialchars($tablename) . '</h3>';

        echo '<table class="table table-bordered table-responsive w-100 ">';
        echo '<thead>';
        echo '<tr>';
        $fields = mysqli_fetch_fields($result);
        foreach ($fields as $field)
        {
            echo '<th>' . htmlspecialchars($field->name) . '</th>';
        }
        echo '<th>Action</th>'; // Add a new column for actions
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result))
        {
            echo '<tr>';
            foreach ($row as $cell)
            {
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }
            echo '<td>';
            echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" style="display:inline;">';
            echo '<input type="hidden" name="tablename" value="' . htmlspecialchars($tablename) . '">';
            echo '<input type="hidden" name="delete_id" value="' . htmlspecialchars($row['id']) . '">';
            echo '<button type="submit" name="tdeletebtn" class="btn btn-danger btn-sm">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    else
    {
        echo 'Error: ' . mysqli_error($conn);
    }

}
?>
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
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<div class='list-group-item d-flex justify-content-between align-items-center'><strong>Role:</strong><span class='badge badge-info'>" . htmlspecialchars(strtoupper($row['role'])) . "</span></div>";
        echo "<div class='list-group-item d-flex justify-content-between align-items-center'><strong>Status:</strong><span class='badge badge-" . ($row['status'] == 0 ? 'success' : 'danger') . "'>" . ($row['status'] == 0 ? 'Active' : 'Blocked') . "</span></div>";
        echo "<div class='list-group-item d-flex justify-content-between align-items-center'><strong>Company:</strong><span class='badge badge-secondary'>" . htmlspecialchars($row['company']) . "</span></div>";
    }
}
else
{
    echo "<div class='list-group-item list-group-item-danger'>No results found.</div>";
}
?>
                </div>

                <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading"><i class="fas fa-users"></i> User Summary</h4>
                <?php
$sql = "SELECT company, status, role, COUNT(DISTINCT email) AS total FROM user GROUP BY company, status, role";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
    echo "<p class='mb-2'><i class='fas fa-building'></i> <strong>Company:</strong> <span class='badge badge-secondary'>" . htmlspecialchars($row['company']) . "</span> - <i class='fas fa-circle'></i> <strong>Status:</strong> <span class='badge badge-" . ($row['status'] == 0 ? 'success' : 'danger') . "'>" . ($row['status'] == 0 ? 'Active' : 'Blocked') . "</span> - <i class='fas fa-user-tag'></i> <strong>Role:</strong> <span class='badge badge-info'>" . htmlspecialchars($row['role']) . "</span> - <i class='fas fa-user-friends'></i> <strong>Number of users:</strong> <span class='badge badge-light'>" . $row['total'] . "</span></p>";
}
?>
                </div>

<?php
$date = date('YmdHis');
$filename = "eovijatbackup-" . $date . ".csv";
?>

<div class="alert alert-info" role="alert">
    <h4 class="alert-heading"><i class="fas fa-download"></i> CSV Options</h4>
    <div class="row">
        <div class="col">
            <form method="POST" action="download_sql.php">
                <input type="hidden" name="filename" value="<?php echo $filename; ?>">
                <button type="submit" class="btn btn-success mb-2"><i class="fas fa-file-download"></i> Download SQL</button>
            </form>
        </div>
        <div class="col">
            <form method="POST" action="upload_sql.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="sqlFile" class="form-label"><i class="fas fa-file-upload"></i> Upload SQL</label>
                    <input type="file" class="form-control" id="sqlFile" name="sqlFile" accept=".sql" required>
                </div>
                <button type="submit" name="uploadSql" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
            </form>
        </div>
    </div>
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
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
                    <button type="submit" name="updatepassword" class="btn btn-warning w-100">Submit</button>
                </form>

                <?php
if (isset($_POST['updatepassword']))
{
    $oldpassword = md5($_POST['oldpassword']);
    $newpassword = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    if ($newpassword === $confirmpassword)
    {
        // Update password logic here
        $sql = "SELECT password FROM user WHERE email='" . $_SESSION['email'] . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] == $oldpassword)
            {
                $update_sql = "UPDATE user SET password='$newpassword' WHERE email='" . $_SESSION['email'] . "'";
                if (mysqli_query($conn, $update_sql))
                {
                    echo "<script>alert('Password updated successfully');</script>";
                }
                else
                {
                    echo "<script>alert('Error.');</script>";
                }
            }
            else
            {
                echo "<script>alert('Old password is incorrect.');</script>";
            }
        }
        else
        {
            echo "<script>alert('No results found.');</script>";
        }
    }
    else
    {
        echo "<script>alert('New password and confirm password do not match.');</script>";
    }
}
?>
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
                <div class="col-md-6 ">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5>User Management</h5>
                        </div>
                        <div class="card-body">
                            
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control" id="role" name="role" required>
                                    <?php

$files = array_diff(scandir(dirname(__FILE__, 2)) , array(
    '..',
    '.',
    '.git',
    '.idea',
    'vendor',
    'composer.json',
    'composer.lock',
    'assets',
    'person',
    'admin'
));
foreach ($files as $file)
{
    if (is_dir(dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . $file))
    {
        echo "<option value='$file'>$file</option>";
    }
}
?>
                                <option>admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Username" required>
                                </div>
                             
                                
                                
                                <div class="mb-3">
                                    <label for="company" class="form-label">Company</label>
                                    <input type="text" class="form-control" id="company" name="company" placeholder="Enter company" required>
                                </div>
                                <div class="mb-3" style="display: none;">
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
                                    $sql = "SELECT email, role, company, status FROM user where email != '$_SESSION[email]'";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0)
                                    {
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                            echo "<td>
                                                                                        <a href='index.php?activateid=" . htmlspecialchars($row['email']) . "' class='btn btn-sm " . ($row['status'] == 0 ? 'btn-warning' : 'btn-danger') . "'>" . ($row['status'] == 0 ? 'Deactive' : 'Active') . "</a>
                                                                                        <a href='index.php?deleteid=" . htmlspecialchars($row['email']) . "' class='btn btn-sm btn-danger'>Delete</a>
                                                                                        <a href='index.php?resetid=" . htmlspecialchars($row['email']) . "' class='btn btn-sm btn-secondary'>Reset</a>
                                                                                        <a href='index.php?loginid=" . htmlspecialchars($row['email']) . "' class='btn btn-sm btn-primary'>Login</a>
                                                                                    </td>";

                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
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
