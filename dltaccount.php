<?php
session_start();
$page_title="Delete Account";

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
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        .input,a{
            text-decoration: none;
        background: var(--clr-box);
        color: var(--clr-text2);
        padding: 1rem 2rem;
        letter-spacing: 0.5rem;
        font-size: 1.4rem;
        transition: 0.4s;
        display: inline-block;
        margin-top: 1rem;

}
    </style>
</head>
<body>
<div class="section-performance">
        <div class="section-profile">
            <h1 class="section-common-heading">
                Delete Account
            </h1>

            <div class="section-performance--content">
                <p class="section-common-subheading">Are you sure you want to delete your account? This action cannot be undone.</p>
                
            </div>
            <div class="delete">
                <div class="login_reg">
                <form method="POST">
                    <input type="submit" class="input" name="delete" value="Delete Account">
                </form>
                </div>
                <div class="login_reg">
                <a href="profile.php">Cancel</a>
                </div>
            </div>
        </div>     
        </div>
    
</body>
</html>
