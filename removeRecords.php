<?php
session_start();
$page_title="Remove Records";

if(!isset($_SESSION['username'])){
    ?>
        <script>
            alert('You are logged out');
            window.location = 'login.php';
        </script>
    <?php
}

include 'connection.php';

$username = $_SESSION['username'];

if (isset($_POST['remove'])) {
    // Delete all records associated with the user in the 'test_data' table
    $deleteRecordsQuery = "DELETE FROM test_data WHERE Username='$username'";
    if (mysqli_query($conn, $deleteRecordsQuery)) {
        // Records were successfully removed, show an alert
        echo '<script>alert("Your previous records have been removed successfully.");</script>';
        echo '<script>window.location.href = "profile.php";</script>';
    } else {
        // Handle any errors that may occur during deletion
        echo '<script>alert("An error occurred while removing your records. Please try again later.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
</head>
<body>
    <h1>Remove All Previous Records</h1>
    <p>Are you sure you want to remove all your previous records? This action cannot be undone.</p>
    <form method="POST">
        <input type="submit" name="remove" value="Remove Records">
    </form>
    <a href="profile.php">Cancel</a>
</body>
</html>
