<?php
//creating connection to the database
$servername="localhost";
$username="root";
$password="";
$database="typingTest";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    //echo "No connection";
    die("No connection".mysqli_connect_error());
}
?>
