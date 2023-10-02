<?php
session_start();

include 'connection.php';

$username = $_SESSION['username'];

// Check if the user has submitted the delete account form
if (isset($_POST['delete'])) {
    // Delete user records from the 'test_data' table
    $deleteRecordsQuery = "DELETE FROM test_data WHERE Username='$username'";
    mysqli_query($conn, $deleteRecordsQuery);

    // Delete the user's account from the 'registration' table
    $deleteAccountQuery = "DELETE FROM registration WHERE username='$username'";
    mysqli_query($conn, $deleteAccountQuery);

    // Destroy the session and redirect to a confirmation page
    session_destroy();
    echo '<script>alert("Your account has been deleted successfully.");</script>';
    echo '<script>window.location.href = "index.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h1>Delete Account</h1>
    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
    <form method="POST">
        <input type="submit" name="delete" value="Delete Account">
    </form>
    <a href="profile.php">Cancel</a>
</body>
</html>
