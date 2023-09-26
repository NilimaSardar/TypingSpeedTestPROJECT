<?php
// Start a session
session_start();

// Include the database connection
include 'connection.php';

// Data to insert into the table
$Speed = $_POST['speed'];
$correctWord = $_POST['correct_Word'];
$Outof = $_POST['Outof'];
$Totaltime = $_POST['totaltime'];

$Language = $_SESSION['language'];
$Level = $_SESSION['level'];
$username = $_SESSION['username']; // Get the username from the session

// SQL query to insert data into the table
$insert = "INSERT INTO test_data (Username, Speed, Correctword, Outof, TimeTaken, Langid, Levelid)
           VALUES ('$username', '$Speed', '$correctWord', '$Outof', '$Totaltime', '$Language', '$Level')";

if (mysqli_query($conn, $insert) === TRUE) {
    echo "Data inserted successfully.<br>";
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
