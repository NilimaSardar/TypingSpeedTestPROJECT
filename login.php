<?php
include 'links.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <div class="box">
    <div class="container">
        <div class="top-header">
            <header>Login</header>
        </div>

        <form action="typingtest.php">
        <div class="input-field">
            <input type="text" name="username" class="input" placeholder="username" required>
            <i class="fa fa-user-o" aria-hidden="true"></i>
        </div>

        <div class="input-field">
            <input type="password" name="password" class="input" placeholder="password" required>
            <i class="fa fa-lock" aria-hidden="true"></i>
        </div>

        <div class="input-field">
            <input type="submit" class="submit" value="Login">
        </div>

        <div class="bottom">
            <div class="left">
                <input type="checkbox" id="check">
                <label for="check">Remember Me</label>
            </div>
            <div class="right">
                <label><a href="#"><a href="forget_password">Forgot password?</a></label>
            </div>
        </div>

        <span>
            Don't have account?
            <a href="signup.php">Sign Up</a>
        </span>
        </form>
    </div>
   </div>
</body>
</html>