<?php
session_start();

include 'connection.php';

$username = $_SESSION['username'];

// Retrieve the user's current information
$query = "SELECT * FROM registration WHERE username='$username'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

$userData = mysqli_fetch_assoc($result);

// Handle form submission to update the profile
if (isset($_POST['submit'])) {
    $newFullname = $_POST["fullname"];
    $newUsername = $_POST["username"];
    $newEmail = $_POST["email"];

    // Update the user's information in the database
    $updateQuery = "UPDATE registration SET fullname='$newFullname', username='$newUsername', email='$newEmail' WHERE username='$username'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Update session variables with new data
        $_SESSION['fullname'] = $newFullname;
        $_SESSION['username'] = $newUsername;
        $_SESSION['email'] = $newEmail;

        echo '<script>alert("Profile updated successfully!");</script>';
        echo '<script>window.location.href = "profile.php";</script>';
    } else {
        echo '<script>alert("Profile update failed. Please try again later.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Your Profile</h1>
    <form method="POST" action="">
        <div>
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $userData['fullname']; ?>" required>
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required>
        </div>
        <div>
            <input type="submit" name="submit" value="Update">
        </div>
    </form>
    <a href="changepassword.php">Change Password</a>
    <a href="profile.php">Back to Your Profile</a>
</body>
</html>
