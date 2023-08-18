<?php
include 'connection.php';

$nameid= $_POST['datapost'];

$q="select * from level where Langid='$nameid'";
$result = mysqli_query($conn,$q);
                        
while($rows = mysqli_fetch_array($result)){
        ?>
    <option><?php echo $rows['level']; ?></option>
        <?php
}
?>