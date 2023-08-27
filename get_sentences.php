<?php
session_start();
header('Content-Type: application/json'); // Set JSON header

include 'connection.php';

$selectedLang = $_POST['lang'];
$selectedLevel = $_POST['level'];

$q = "SELECT sentence FROM sentences WHERE Langid = $selectedLang AND Levelid = $selectedLevel";
// $q = "SELECT sentence FROM sentences WHERE Langid = 1 AND Levelid = 1";

$result = mysqli_query($conn, $q);

$sentences = array();
while ($row = mysqli_fetch_assoc($result)) {
    $sentences[] = $row;
}

echo json_encode($sentences); // Echo JSON data
?>

