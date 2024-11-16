<?php
include_once "head1.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$filename = "eovijatbackup-" . date('YmdHis') . ".sql";

// Get all table names
$tables = [];
$result = $conn->query("SHOW TABLES");

while ($row = $result->fetch_row())
{
    $tables[] = $row[0];
}

$sqlContent = "";

// Iterate through the tables and create SQL dump
foreach ($tables as $table)
{
    $result = $conn->query("SELECT * FROM $table");
    $numColumns = $result->field_count;

    $sqlContent .= "DROP TABLE IF EXISTS `$table`;\n";
    $createTableResult = $conn->query("SHOW CREATE TABLE $table");
    $createTableRow = $createTableResult->fetch_row();
    $sqlContent .= $createTableRow[1] . ";\n\n";

    for ($i = 0;$i < $numColumns;$i++)
    {
        while ($row = $result->fetch_row())
        {
            $sqlContent .= "INSERT INTO `$table` VALUES(";
            for ($j = 0;$j < $numColumns;$j++)
            {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = str_replace("\n", "\\n", $row[$j]);
                if (isset($row[$j]))
                {
                    $sqlContent .= '"' . $row[$j] . '"';
                }
                else
                {
                    $sqlContent .= '""';
                }
                if ($j < ($numColumns - 1))
                {
                    $sqlContent .= ', ';
                }
            }
            $sqlContent .= ");\n";
        }
    }
    $sqlContent .= "\n\n";
}

// Download the SQL content to the user's computer
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . $filename . "\"");
echo $sqlContent;

// Save the SQL content to a file
file_put_contents('psql/' . $filename . '.sql', $sqlContent);

echo "Backup saved";

$conn->close();
?>
