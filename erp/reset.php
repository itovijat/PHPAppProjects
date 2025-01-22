Reset

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label>Username:</label>
    <input type="text" name="username" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <input type="submit" value="Submit">
</form>


<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Process the username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username != "1" || $password != "1") {
        die("Invalid username or password.");
    }
    
    // Add your logic here for handling the username and password

    include_once "db.php";

 
// Disable foreign key checks to allow dropping tables
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Get all table names in the sales database
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Drop each table if it exists
foreach ($tables as $table) {
    $conn->query("DROP TABLE IF EXISTS $table");
}

// Re-enable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 1");


    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(10) NOT NULL,
        password VARCHAR(40) NOT NULL,
        role VARCHAR(10) NOT NULL,
        company VARCHAR(15) NOT NULL,
        status BOOLEAN DEFAULT 1,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Check if the username already exists
    $checkUserSql = "SELECT * FROM users WHERE username = 'itovijat'";
    $result = $conn->query($checkUserSql);

    if ($result->num_rows === 0) {
        // Insert the new user if not exists
        $insertUserSql = "INSERT INTO users (username, password, role, company) VALUES ('itovijat', '" . md5('KRkush5877') . "', 'superadmin', 'None')";
        if ($conn->query($insertUserSql) === TRUE) {
            echo "New user inserted successfully";
        } else {
            echo "Error inserting user: " . $conn->error;
        }
    } else {
        echo "User itovijat already exists.";
    }







}


?>