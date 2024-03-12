<?php
$dbhost="localhost";
$dbUser= "root";
$dbPass="";
$dbName="login_reg";
$conn=mysqli_connect($dbhost,$dbUser,$dbPass,$dbName);
if(!$conn){
    die("something went wrong");
}
?>