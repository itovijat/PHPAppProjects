home.php
WELCOME

<?php

$server="localhost";
$username="root";
$password="";
$database="test";

$conn = mysqli_connect($server,$username,$password,$database);
if($conn){
echo "connected<br>";

$sql="SELECT * FROM user";
$r=mysqli_query($conn,$sql);

if($r){

    while($i=mysqli_fetch_array($r)){
        echo $i['UN'];
        echo " ";
        echo $i['PASS'];
        echo "<br>";
    }
}

}


?>