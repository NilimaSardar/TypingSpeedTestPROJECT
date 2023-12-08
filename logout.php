<?php
session_start();
include 'connection.php';

    $username = $_SESSION['username'];

    $logoutTime = date('Y-m-d H:i:s');
    $loginTime = $_SESSION['login_time'];

    // Calculate the usage time (in seconds)
    $usageTime = strtotime($logoutTime) - strtotime($loginTime);

    // Update the user_activity table with the logout time and usage time
    $updateLogoutQuery = "UPDATE user_activity
                         SET logout_time = '$logoutTime', daily_usage = $usageTime
                         WHERE username= '$username' AND login_time = '$loginTime'";
    mysqli_query($conn, $updateLogoutQuery);


session_destroy();

setcookie('usernamecookie','',time()-86400);
setcookie('passwordcookie','',time()-86400);

header('location:index.php');
?>

