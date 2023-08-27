<?php
header('Content-Type: application/json'); // Set JSON header

include 'connection.php';

if(isset($_POST['lang'])){
    $languageid = $_POST['lang'];

    $q = "select * from level where Langid='$languageid'";
    $result = mysqli_query($conn, $q);
                            
    $levels = array();
    while($rows = mysqli_fetch_array($result)){
        $levels[] = array(
            'id' => $rows['Levelid'],
            'level' => $rows['level']
        );
    }
    echo json_encode($levels); // Echo JSON data
}
?>
