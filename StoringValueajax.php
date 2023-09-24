<?php
// Start a session
session_start();

// Include the database connection
include 'connection.php';

// Check if the table 'game_data' exists, or create it if it doesn't
$sql_create_table = "CREATE TABLE IF NOT EXISTS game_data (
    Gameid INT(6) AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(30),
    Speed VARCHAR(30),
    Correctword VARCHAR(30),
    Outof VARCHAR(30),
    TimeTaken VARCHAR(30),
    Lang VARCHAR(30),
    Level VARCHAR(30)
)";

if (mysqli_query($conn, $sql_create_table) === TRUE) {
    echo "Table 'game_data' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Data to insert into the table
$Speed = $_POST['speed'];
$correctWord = $_POST['correct_Word'];
$Outof = $_POST['Outof'];
$Totaltime = $_POST['totaltime'];

$Language = $_SESSION['language'];
$Level = $_SESSION['level'];
$username = $_SESSION['username']; // Get the username from the session

// SQL query to insert data into the table
$insert = "INSERT INTO game_data (Username, Speed, Correctword, Outof, TimeTaken, Lang, Level)
           VALUES ('$username', '$Speed', '$correctWord', '$Outof', '$Totaltime', '$Language', '$Level')";

if (mysqli_query($conn, $insert) === TRUE) {
    echo "Data inserted successfully.<br>";
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
