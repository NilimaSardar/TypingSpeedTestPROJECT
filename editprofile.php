<?php
session_start();
$page_title="Edit Profile";
include 'links.php';

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
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
    <link rel="stylesheet" href="css/form.css"> 
    <style>
        label{
            color: #1A1A40;
            font-weight: 600;
            font-size: 20px;
        }
        span a{
            justify-content: center;
            text-align: center;
            padding-bottom: 0px;
            color: black;
        }
       .submit{
            margin-bottom: -25px;
       }
    </style>
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top_header">
                <header>Edit Your Profile</header>
            </div>
            <!-- <?php
        //   foreach($errorMessages as $errorMessage) {
        //     echo '<div class="error-message">' . $errorMessage . '</div>';
        //   }
          ?> -->

            <form method="POST" action="">
                <div class="input_field">
                    <label for="fullname">Full Name:</label>
                    <input class="input" type="text" id="fullname" name="fullname" value="<?php echo $userData['fullname']; ?>" required>
                    <i aria-hidden="true" class="fa fa-user"></i>
                </div>
                <div class="input_field">
                    <label for="username">Username:</label>
                    <input class="input" type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" required>
                    <i aria-hidden="true" class="fa fa-user"></i>
                </div>
                <div class="input_field">
                    <label for="email">Email:</label>
                    <input class="input" type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required>
                    <i aria-hidden="true" class="fa fa-envelope"></i>
                </div>
                <span>
                    <input class="submit" type="submit" name="submit" value="Update">
                </span>
                <span>
                    <a href="change_password.php" class="submit">Change Password</a>
                </span>
                <span>
                    <a href="profile.php" class="submit">Back to Your Profile</a>
                </span>
            </form>

        </div>
    </div>
</body>
</html>
