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

$sql = "CREATE TABLE IF NOT EXISTS doc (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
    doc VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    // echo "Table applyvisa created successfully";
} else {
    echo "<script>alert('error');</script>";
}
if(isset($_POST['submit'])){
    $datetime = date('YmdHis');
    $target_dir = "doc/";
    $target_file = $target_dir . $datetime . '.' . strtolower(pathinfo($_FILES["doc"]["name"],PATHINFO_EXTENSION));
    $uploadOk = 1;
    $docFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if doc file is a actual doc or fake doc
    $check = file_get_contents($_FILES["doc"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not a doc.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["doc"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($docFileType != "doc" && $docFileType != "docx" && $docFileType != "pdf" ) {
        echo "Sorry, only Doc, Docx & PDF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["doc"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        $sql = "INSERT INTO doc (doc) VALUES ('$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>


<h2>Document Upload Form</h2>

<form action="doc.php" method="post" enctype="multipart/form-data">
    <label for="doc">Document:</label>
    <input type="file" name="doc" id="doc" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" required><br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
$sql = "SELECT id, doc FROM doc ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $serial_number = 1;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $doc = $row["doc"];
        echo "<p>$serial_number. <a href='$doc' download>Download</a>   $doc</p>";
        $serial_number++;
    }
}
?>

