<?php
//include_once "download_sql.php";
include_once "head1.php";
// Make sure your database connection details are defined here


$host = $servername;
$user = $username;
$password = $password;
$database = $dbname;

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['uploadSql']))
{
    if (isset($_FILES['sqlFile']))
    {
        $fileName = $_FILES['sqlFile']['tmp_name'];

        if (is_uploaded_file($fileName))
        {
            $sqlContent = file_get_contents($fileName);
            restoreDatabaseTables($sqlContent, $conn);
        }
    }

}

function restoreDatabaseTables($sqlContent, $conn)
{

    // Disable foreign key checks before dropping tables
    $conn->query("SET FOREIGN_KEY_CHECKS = 0");

    // Get all table names
    $result = $conn->query("SHOW TABLES");

    while ($row = $result->fetch_row())
    {
        // Drop each table
        $conn->query("DROP TABLE IF EXISTS `$row[0]`");
    }

    // Enable foreign key checks after dropping tables
    $conn->query("SET FOREIGN_KEY_CHECKS = 1");

    // Split the SQL file content into individual statements
    $sqlStatements = explode(";", $sqlContent);

    foreach ($sqlStatements as $statement)
    {
        $statement = trim($statement);
        // Skip any unintended non-SQL strings
        if (!empty($statement) && strpos($statement, 'Backup saved') === false)
        {
            if ($conn->query($statement) !== true)
            {
                echo "Error executing statement: " . $conn->error . "\n";
            }
        }
    }

    $conn->close();
    echo "Database restored successfully!";
}
?>
