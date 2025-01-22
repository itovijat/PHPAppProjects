<?php
include_once '../db.php';
if ($_SESSION['role'] != 'superadmin')
{
    echo "<script>location.replace('../');</script>";
    exit;
}
if (isset($_GET['resetid']) && isset($_GET['un']))
{

    
    $resetid = $_GET['resetid'];
    $un=$_GET['un'];
    $un=md5($un);

  
    $sql = "UPDATE users SET password='$un' WHERE id='$resetid'";
    if (mysqli_query($conn, $sql))
    {
        echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
    }
    else
    {
        echo "<script>alert('Error'); location.replace('index.php');</script>";
    }
}
if (isset($_GET['activateid']))
{
    $activeid = $_GET['activateid'];
    $sql = "UPDATE users SET status=IF(status='0','1','0') WHERE id='$activeid'";
    if (mysqli_query($conn, $sql))
    {
        echo "<script>alert('Record successfully'); location.replace('index.php');</script>";
    }
    else
    {
        echo "<script>alert('Error'); location.replace('index.php');</script>";
    }
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']) && isset($_POST['company']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $company = $_POST['company'];

    $sql = "INSERT INTO users (username, password, role, company) VALUES ('$username', '$password', '$role', '$company')";
    if (mysqli_query($conn, $sql))
    {
        echo "<script>alert('User added successfully'); location.replace('index.php');</script>";
    }
    else
    {
        echo "<script>alert('Error'); location.replace('index.php');</script>";
    }
}

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">


<div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5>User Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" id="role" value="<?php echo htmlspecialchars($_SESSION['role']); ?>" readonly>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>

            <div class="card-footer text-muted">
                <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
   
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5>Add User</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role" required>
                                    <option value="sr">SR</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">Super Admin</option>
                                        
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" class="form-control" id="company" name="company" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-block" value="Add User">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <h2 style="text-align: center; margin-top: 20px;">All Users</h2>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Role</th>
                <th>Company</th>
                <th>Status</th>
                <th>Created On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["id"]) . "</td>
                            <td>" . htmlspecialchars($row["username"]) . "</td>
                            <td>" . htmlspecialchars($row["role"]) . "</td>
                            <td>" . htmlspecialchars($row["company"]) . "</td>
                            <td>" . ($row["status"] ? 'Active' : 'Inactive') . "</td>
                            <td>" . htmlspecialchars($row["timestamp"]) . "</td>
                            <td>";
                               
                                if ($row["status"] == 1) {
                                    echo "<a href='index.php?activateid=" . htmlspecialchars($row["id"]) . "' class='btn btn-warning'>Block</a>";
                                } else {
                                    echo "<a href='index.php?activateid=" . htmlspecialchars($row["id"]) . "' class='btn btn-success'>Active</a>";
                                }
                                
                                echo " 
                                <a href='index.php?resetid=" . htmlspecialchars($row["id"]) . "&    un=" . htmlspecialchars($row["username"]) . "' class='btn btn-secondary'>Reset</a>
                            </td>
                            
                        </tr>";
                }
            }
            else
            {
                echo "<tr><td colspan='6' style='text-align: center'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

