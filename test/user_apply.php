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
  
<div style="border: 1px solid #ccc; border-radius: 10px; padding: 20px;">
    <h2>Applications</h2>
    <?php $sql = "CREATE TABLE IF NOT EXISTS application (
                    visacountry VARCHAR(255) NOT NULL,
                    title VARCHAR(255) NOT NULL,
                    familyName VARCHAR(255) NOT NULL,
                    givenName VARCHAR(255) NOT NULL,
                    mobilePhone VARCHAR(20) NOT NULL,
                    dateOfBirth DATE NOT NULL,
                    sex VARCHAR(255) NOT NULL,
                    maritalStatus VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    confirmEmail VARCHAR(255) NOT NULL,
                    passportNo VARCHAR(255) NOT NULL,
                    passportIssueDate DATE NOT NULL,
                    passportCountry VARCHAR(255) NOT NULL,
                    passportExpireDate DATE NOT NULL,
                    address VARCHAR(255) NOT NULL,
                    suburbTown VARCHAR(255) NOT NULL,
                    country VARCHAR(255) NOT NULL,
                    file VARCHAR(255) NOT NULL
                )";
                if ($conn->query($sql) === TRUE) {
                                } else {
                    echo "<script>alert('t e');</script>";
                }
                
                
                
                ?>

    <?php
    $sql = "SELECT * FROM application";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table style='width:100%;'><tr><th>SN</th><th>Visa Country</th><th>Title</th><th>Family Name</th><th>Given Name</th><th>Mobile Phone</th><th>Date of Birth</th><th>Sex</th><th>Marital Status</th><th>Email</th><th>Confirm Email</th><th>Passport No</th><th>Passport Issue Date</th><th>Passport Country</th><th>Passport Expire Date</th><th>Address</th><th>Suburb/Town</th><th>Country</th><th>File</th></tr>";
        $serial_number = 1;
        while($row = $result->fetch_assoc()) {
            echo "<tr><td style='text-align: center;'>".$serial_number."</td><td style='text-align: center;'>".$row["visacountry"]."</td><td style='text-align: center;'>".$row["title"]."</td><td style='text-align: center;'>".$row["familyName"]."</td><td style='text-align: center;'>".$row["givenName"]."</td><td style='text-align: center;'>".$row["mobilePhone"]."</td><td style='text-align: center;'>".$row["dateOfBirth"]."</td><td style='text-align: center;'>".$row["sex"]."</td><td style='text-align: center;'>".$row["maritalStatus"]."</td><td style='text-align: center;'>".$row["email"]."</td><td style='text-align: center;'>".$row["confirmEmail"]."</td><td style='text-align: center;'>".$row["passportNo"]."</td><td style='text-align: center;'>".$row["passportIssueDate"]."</td><td style='text-align: center;'>".$row["passportCountry"]."</td><td style='text-align: center;'>".$row["passportExpireDate"]."</td><td style='text-align: center;'>".$row["address"]."</td><td style='text-align: center;'>".$row["suburbTown"]."</td><td style='text-align: center;'>".$row["country"]."</td><td style='text-align: center;'><img src='".$row["file"]."' height='100' width='100' /><br><a href='".$row["file"]."' download>Download</a> ".$row["file"]."</td></tr>";
            $serial_number++;
        }
        echo "</table>";
    } else {
       
    }
    ?>



</div>
