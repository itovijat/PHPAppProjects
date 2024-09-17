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
 

<?php

$sql = "CREATE TABLE IF NOT EXISTS photo (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
    photo VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    // echo "Table applyvisa created successfully";
} else {
    echo "<script>alert('error');</script>";
}
if(isset($_POST['submit'])){
    $datetime = date('YmdHis');
    $target_dir = "photo/";
    $target_file = $target_dir . $datetime . '.' . strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        $sql = "INSERT INTO photo (photo) VALUES ('$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>


<h2>Application Form</h2>

<form action="photo.php" method="post" enctype="multipart/form-data">

    <label for="photo">Photo:</label>
    <input type="file" name="photo" id="photo" accept="image/*" required><br><br>

    <input type="submit" name="submit" value="Submit">

</form>

<?php
$sql = "SELECT id, photo FROM photo ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $serial_number = 1;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $photo = $row["photo"];
        echo "<p>$serial_number. <img src='$photo' width='100' height='100' />   $photo</p>";
        $serial_number++;
    }
}
?>
