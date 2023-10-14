<?php
session_start();
include 'links.php';
include 'connection.php';

$errorMessages = array();

if(isset($_POST['submit'])){
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Password validation checks
    $password_min_length = 8; // Minimum password length
    $password_complexity = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/';

    if (strlen($password) < $password_min_length) {
        $errorMessages[] = "Password is too short. It must be at least $password_min_length characters long.";
    } elseif (!preg_match($password_complexity, $password)) {
        $errorMessages[] = "Password must include at least one lowercase letter, one uppercase letter, one number, and one special character.";
    } elseif ($password !== $confirmPassword) {
        $errorMessages[] = "Passwords do not match.";
    } else {
        $email = $_SESSION['email'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $updatePasswordQuery = "UPDATE registration SET password = '$hashedPassword' WHERE email = '$email'";
        if (mysqli_query($conn, $updatePasswordQuery)) {
            // Password changed successfully

            ?>
              <script>
              alert("Password changed successfully");
              window.location = 'login.php'; // Redirect after showing the alert
              </script>
          <?php
        } else {
            $errorMessages[] = "Failed to change the password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>

<div class="box">
    <div class="container">
        <div class="top_header">
            <header>Change Password</header>
        </div>
        <?php
        foreach($errorMessages as $errorMessage) {
            echo '<div class="error-message">' . $errorMessage . '</div>';
        }
        ?>
        <form action="" method="POST">
            <div class="input_field">
                <input type="password" class="input" name="password" placeholder="New Password" required />
                <i aria-hidden="true" class="fa fa-lock"></i>
            </div>
            <div class="input_field">
                <input type="password" class="input" name="confirm_password" placeholder="Confirm Password" required />
                <i aria-hidden="true" class="fa fa-lock"></i>
            </div>

            <span>
                <input class="submit" type="submit" name="submit" value="Change Password" />
            </span>
        </form>
    </div>
</div>
</body>
</html>
