loginconfirm.php

<?php
if (isset($_POST['un1']) && isset($_POST['p1']) )
{

    $un=$_POST['un1']; //rony
    $p=$_POST['p1'];
    $p=md5($p);

//connect

$server="localhost";
$username="root";
$password="";
$database="test";

$conn = mysqli_connect($server,$username,$password,$database);
if($conn){
echo "connected";

$sql="SELECT PASS FROM user WHERE UN='$un'";
$r=mysqli_query($conn,$sql);

if($r){

    $row=mysqli_fetch_array($r);

    if($row['PASS']==$p){
        echo "Login Successful";
        header("location:home.php");

    }
    else{
        echo "<h1>Incorrect Password</h1>";
    }


}
else{
echo "Not Found UN";
}
  
}


}

?>