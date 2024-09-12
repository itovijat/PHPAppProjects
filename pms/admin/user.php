<?php include_once "head2.php"; ?>

<div class="content">
        <!-- Main content goes here -->

       
        <div class="row">
        <div class="col-6">
        <?php

        if (isset($_GET['deleteid'])) {
            $deleteid = $_GET['deleteid'];
            $sql = "DELETE FROM user WHERE email='$deleteid'";
            if (mysqli_query($conn, $sql)) {
                echo "Record deleted successfully";
                header("location:user.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        
        if (isset($_POST['email'])) {


            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $role = $_POST['role'];
            $company = $_POST['company'];
            $status = $_POST['status'];
            $sql = "INSERT INTO user (email, password, role, company, status) VALUES ('$email', '$password', '$role', '$company', '$status') ON DUPLICATE KEY UPDATE status='$status',
             role='$role', company='$company', password='$password'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('New record created successfully');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        if (isset($_GET['activateid'])) {
            $activeid = $_GET['activateid'];
            $sql = "UPDATE user SET status=IF(status='0','1','0') WHERE email='$activeid'";
            if (mysqli_query($conn, $sql)) {
                echo "Record activated successfully";
                header("location:user.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

     
        ?>

        <form action="<?php echo basename($_SERVER['PHP_SELF']);?>" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" class="form-control" id="role" name="role" placeholder="Enter role" required>
            </div>
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" name="company" placeholder="Enter company" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" placeholder="Enter status" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        <div class="col-6">
        <table class="table table-bordered">
          <thead>
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
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['role']."</td>";
                echo "<td>".$row['company']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "<td><a href='user.php?activateid=".$row['email']."' class='btn btn-primary'>".($row['status']==1 ? 'Active' : 'Deactive')."</a> <a href='user.php?deleteid=".$row['email']."' class='btn btn-danger'>Delete</a></td>";
                echo "</tr>";
              }
            } else {
              echo "0 results";
            }
            ?>
          </tbody>
        </table>
        </div>
        </div>
        </div>
        













       

    </div>

    <?php include_once "foot.php"; ?>