<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pms";
try 
{
  mysqli_connect($servername, $username, $password, $dbname) or die ();
}
catch (Exception $e) 
{
  echo "<script> window.location.href = 'notification/?msg=database error'; </script>";
}
$conn = mysqli_connect($servername, $username, $password, $dbname);
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
    post VARCHAR(10) NOT NULL,
     dept VARCHAR(10) NOT NULL
    )
";
mysqli_query($conn, $sql);

$pss=md5('5877');
$sql = "INSERT INTO person (name, email, company,photo,
phone,pid,bloodgroup,issuedate,status,post,dept) SELECT 'kush','it.ovijat@gmail.com','ovijat','admin.png',
'1234567890','5877','A+','2022-01-01',0, 'Engineer', 'IT'
WHERE NOT EXISTS (
    SELECT 1
    FROM person
    WHERE pid = '5877'
)";
mysqli_query($conn, $sql);






session_start();


?>