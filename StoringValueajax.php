<?php
session_start();
?>

<?php
include 'connection.php';

// Check if the table exists
$username = $_SESSION['username'];
$sql_check_table = "SHOW TABLES LIKE '$username'";
$result = mysqli_query($conn,$sql_check_table);

if (mysqli_num_rows($result) === 0) {
    // Table doesn't exist, so create it
    $sql_create_table = "CREATE TABLE $username (
        Gameid INT(6) AUTO_INCREMENT PRIMARY KEY,
        Speed VARCHAR(30),
        Correctword VARCHAR(30),
        Outof VARCHAR(30),
        TimeTaken VARCHAR(30),
        Lang VARCHAR(30),
        Level VARCHAR(30),
    )";

    if (mysqli_query($conn,$sql_create_table) === TRUE) {
        echo "Table $username created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}

// Data to insert into the table
$Speed=$_POST['speed'];
$correctWord=$_POST['correct_Word'];
$Outof=$_POST['Outof'];
$Totaltime=$_POST['totaltime'];

$Language=$_SESSION['language'];
$Level=$_SESSION['level'];

// SQL query to insert data into the table
$insert = "insert into $username(Speed,Correctword,Outof,TimeTaken,Lang,Level)
 values('$Speed','$correctWord','$Outof','$Totaltime','$Language','$Level')";

if (mysqli_query($conn,$insert) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>