<?php
include "dbconnect.php";

$sql = "
CREATE TABLE  IF NOT EXISTS user(
    
    email VARCHAR(30) NOT NULL PRIMARY KEY,
    password VARCHAR(32) NOT NULL,
    role VARCHAR(10) NOT NULL,
    company VARCHAR(10) NOT NULL,
    status BOOLEAN NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
";
mysqli_query($conn, $sql);

$pss=md5('5877');
$sql = "
INSERT INTO user (email, password, role,company)
SELECT 'it.ovijat@gmail.com', '$pss','admin','ovijat'
WHERE NOT EXISTS (
    SELECT 1
    FROM user
    WHERE email = 'it.ovijat@gmail.com'
);
";
mysqli_query($conn, $sql);



$sql = "
CREATE TABLE  IF NOT EXISTS person(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    company VARCHAR(10) NOT NULL,
    photo VARCHAR(20) NOT NULL,
    phone VARCHAR(11) NOT NULL,
    pid VARCHAR(5) NOT NULL,
    bloodgroup VARCHAR(2) NOT NULL,
    issuedate VARCHAR(10) NOT NULL,
    status BOOLEAN NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    post VARCHAR(30) NOT NULL,
     dept VARCHAR(30) NOT NULL
    )
";
mysqli_query($conn, $sql);





$sql="
CREATE TABLE IF NOT EXISTS products  (
  id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(50) NOT NULL,
  company VARCHAR(10) NOT NULL
)";

if ($conn->query($sql) === TRUE) {

} else {
 echo "Error creating table: " . $conn->error;
}


$sql="
 TABLE IF NOT EXISTS persons  (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(50) NOT NULL,
  company VARCHAR(10) NOT NULL
)";

if ($conn->query($sql) === TRUE) {

} else {
echo "Error creating table: " . $conn->error;
}   

$sql="
CREATE TABLE IF NOT EXISTS inventory   (
 id INT AUTO_INCREMENT PRIMARY KEY,
 product_name VARCHAR(50) NOT NULL,
 in_quantity INT,
 out_quantity INT,
 entry_date DATE,
 person_name VARCHAR(50),
 expiry_date DATE,
 remark TEXT,
  company VARCHAR(10) NOT NULL
)";

if ($conn->query($sql) === TRUE) {

} else {
echo "Error creating table: " . $conn->error;
} 
$sql="
CREATE TABLE IF NOT EXISTS kpl (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_name VARCHAR(50) NOT NULL,
    driver_name VARCHAR(50) NOT NULL,
    entry_date DATE NOT NULL,
    oil_quantity FLOAT NOT NULL,
    oil_price FLOAT NOT NULL,
    distance FLOAT NOT NULL,
    km FLOAT NOT NULL,
     remark VARCHAR(20) NULL,
  company VARCHAR(10) NOT NULL
)";
 
 if ($conn->query($sql) === TRUE) {
 
 } else {
 echo "Error creating table: " . $conn->error;
 }


 $sql="
 CREATE TABLE IF NOT EXISTS vehicles  (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
   company VARCHAR(10) NOT NULL
 )";
 
 if ($conn->query($sql) === TRUE) {
 
 } else {
 echo "Error creating table: " . $conn->error;
 }











 
//close sql connection
mysql_close($conn);

?>

