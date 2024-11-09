

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
   // echo "Table user created successfully";
} else {
   // echo "Error creating table: " . $conn->error;
}

?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM user WHERE name='$name' and password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        header("Location: home.php");
        exit;
    } else {
    
        echo '<div id="error" style="position:fixed;top:10%;left:40%;width:20%;height:10%;background-color:#ff3333;color:#fff;z-index:99999999;text-align:center;padding-top:10%;font-size:20px;border-radius:10px;">Invalid Credentials</div>';
        echo "<script>setTimeout(function(){document.getElementById('error').style.display='none';}, 3000);</script>";
    
    }

    mysqli_close($conn);
}
?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
        margin: 0;
    }
    form {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        padding: 20px;
        width: 350px;
        animation: fadein 2s ease-in-out forwards;
    }
    form > h2 {
        margin-top: 0;
        color: #333;
        text-align: center;
    }
    form > label {
        display: block;
        margin: 10px 0 5px;
        font-weight: bold;
        color: #555;
        animation: float 5s ease-in-out infinite;
        font-size: 10px;
    }
    @keyframes float {
        0% {
            transform: translateX(-5%);
        }
        50% {
            transform: translateX(25%);
        font-size: 16px;
        }
        100% {
            transform: translateX(-5%);
        font-size: 10px;
        }
    }
    form > input[type="text"],
    form > input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }
    form > input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        animation: scale 2s ease-in-out forwards;
    }
    form > input[type="submit"]:hover {
        background-color: #218838;
    }
    @keyframes fadein {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    @keyframes scale {
        0% { transform: scale(0.5); }
        100% { transform: scale(1); }
    }
</style>

<form method="post">
    <h2>Login</h2>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" id="submit" value="Submit">
</form>


    <script>
        const passwordInput = document.getElementById('password');
        passwordInput.maxLength = "10";
    </script>


<script>
    const nameInput = document.getElementById('name');

    function isEmail(email) {
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    nameInput.addEventListener('input', function() {
        if (isEmail(nameInput.value)) {
            nameInput.style.backgroundColor = 'inherit';
        } else {
            nameInput.style.backgroundColor = 'red';
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitButton = document.getElementById('submit');
        const nameInput = document.getElementById('name');
        const passwordInput = document.getElementById('password');

        function toggleSubmitButton() {
            if (nameInput.value.trim() === '' || passwordInput.value.trim() === '') {
                submitButton.style.display = 'none';
            } else {
                submitButton.style.display = 'block';
            }
        }

        nameInput.addEventListener('input', toggleSubmitButton);
        passwordInput.addEventListener('input', toggleSubmitButton);

        toggleSubmitButton(); // Initial check
    });
</script>