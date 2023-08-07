<?php
session_start();
?>

<?php
include 'links.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login_reg.css">
</head>
<body>
    <?php
    include 'connection.php';

    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        $username_search = "select * from registration where username ='$username'";
        $query = mysqli_query($conn,$username_search);

        $username_count = mysqli_num_rows($query);

        if($username_count){
            $username_pass = mysqli_fetch_assoc($query);

            $db_pass = $username_pass['password'];

            $_SESSION['username'] = $username_pass['username'];

            $pass_decode = password_verify($password,$db_pass);

            if($pass_decode){
                echo "login successful";
                ?>
                <script>
                    location.replace("example.php");
                </script>
                <?php
            }else{
                echo "password Incorrect";
            }
        }else{
            echo "Invalid username";
        }
    }

    ?>
   <div class="box">
    <div class="container">
        <div class="top-header">
            <header>Login</header>
        </div>
        
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="input-field">
            <input type="text" name="username" class="input" placeholder="username" required>
            <i class="fa fa-user-o" aria-hidden="true"></i>
        </div>

        <div class="input-field">
            <input type="password" name="password" class="input" placeholder="password" required>
            <i class="fa fa-lock" aria-hidden="true"></i>
        </div>

        <div class="input-field">
            <input type="submit" name="submit" class="submit" value="Login">
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