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
include_once "db.php";
$sql = "CREATE TABLE IF NOT EXISTS applyvisa (
    amount DECIMAL(10,2) NOT NULL,
    msg VARCHAR(255) NOT NULL,
    bank VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    // echo "Table applyvisa created successfully";
} else {
    echo "<script>alert('error');</script>";
}

?>
<?php
if(isset($_POST['amount']) && isset($_POST['msg']) && isset($_POST['bank'])){
    $amount = $_POST['amount'];
    $msg = $_POST['msg'];
    $bank = $_POST['bank'];

    $sql = "SELECT * FROM applyvisa";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE applyvisa SET amount='$amount', msg='$msg', bank='$bank'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record updated successfully');</script>";
        } else {
            echo "<script>alert('Record updated error');</script>";
        }
    } else {
        $sql = "INSERT INTO applyvisa (amount,msg,bank) VALUES ('$amount','$msg','$bank')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record updated successfully');</script>";
        } else {
            echo "<script>alert('Record updated error');</script>";
        }
    }
}

$sql = "SELECT * FROM applyvisa";
$result = $conn->query($sql);
    $amount = "";
    $msg = "";
    $bank = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $amount = $row['amount'];
    $msg = $row['msg'];
    $bank = $row['bank'];
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="amount">Amount: USD</label>
    <input type="number" id="amount" name="amount" value="<?php echo $amount; ?>" required><br><br>
    <label for="msg">Message:</label>
    <textarea required id="msg" name="msg" rows="4" cols="50"><?php echo $msg; ?></textarea><br><br>
    <label for="bank">Bank:</label>
    <textarea id="bank" name="bank" rows="4" cols="50" required><?php echo $bank; ?></textarea><br><br>
    <input type="submit" value="Update">
</form>

