regconfirm.php
<br>

<?php

if (isset($_POST['un1']) && isset($_POST['p1']) )
{

    $un=$_POST['un1'];
    $p=$_POST['p1'];

    $p=md5($p);
   

    $server="localhost";
    $username="root";
    $password="";
    $database="test";

    $conn = mysqli_connect($server,$username,$password,$database);
    if($conn){

        $sql="INSERT INTO user(UN,PASS) VALUES('$un','$p')";
        $r=mysqli_query($conn,$sql);

        if($r){
            echo "Registration successful";
        }
    }

}
else
{

    header("Location: reg.php");

}

?>
