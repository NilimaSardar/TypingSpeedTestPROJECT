<?php
include 'connection.php';

$Speed=$_POST['speed'];
$correctWord=$_POST['correct_Word'];
$Outof=$_POST['Outof'];
$Totaltime=$_POST['totaltime'];

$q = "insert into achievement(Speed,Correctword,Outof,TimeTaken)
 values('$Speed','$correctWord','$Outof','$Totaltime')";
 $query = mysqli_query($conn,$q);

?>