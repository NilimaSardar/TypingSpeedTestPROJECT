<?php
session_start();
$page_title="Login";
?>

<?php
include 'links.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <?php
    include 'connection.php';

    $fname = $username = $email = '';
    $errorMessages = array();

    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        //for time spent
        $loginTime = date('Y-m-d H:i:s');
        $_SESSION['login_time'] = $loginTime;

        // Insert the login record into the user_activity table
        $insertLoginQuery = "INSERT INTO user_activity (username, login_time, logout_time, daily_usage)
                             VALUES ('$username', '$loginTime', 0 , 0)";
        mysqli_query($conn, $insertLoginQuery);

        $username_search = "select * from registration where username ='$username'";
        $query = mysqli_query($conn,$username_search);

        $username_count = mysqli_num_rows($query);

        if($username_count){
            $username_pass = mysqli_fetch_assoc($query);

            $db_pass = $username_pass['password'];

            $_SESSION['username'] = $username_pass['username'];
            $_SESSION['fullname'] = $username_pass['fullname'];
            $_SESSION['email'] = $username_pass['email'];

            $pass_decode = password_verify($password,$db_pass);

            if($pass_decode){
                //echo "login successful";
                //rememberme
                if(isset($_POST['rememberme'])){

                    setcookie('usernamecookie',$username,time()+86400);
                    setcookie('passwordcookie',$password,time()+86400);

                    header('location:typingTest.php');
                }else{
                    header('location:typingTest.php');
                }
            
            }else{
                $errorMessages[] = "Incorrect Password";
            }
        }else{
            $errorMessages[] = "Invalid Username";
        }
    }

    ?>
   <div class="box">
    <div class="container">
        <div class="top-header">
            <header>Login</header>
        </div>
        <?php
          foreach($errorMessages as $errorMessage) {
            echo '<div class="error-message">' . $errorMessage . '</div>';
          }
          ?>
        
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="input-field">
            <input type="text" name="username" class="input" id="name" placeholder="username">
            <i class="fa fa-user-o" aria-hidden="true"></i>
        </div>

        <div class="input-field">
            <input type="password" name="password" class="input" id="pass" placeholder="password">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </div>

        <div class="input-field">
            <input type="submit" name="submit" class="submit" value="Login">
        </div>

        <div class="bottom">
            <!--<div class="left">
                <input type="checkbox" id="check" name="rememberme">
                <label for="check">Remember Me</label>
            </div>-->
            <div class="right">
                <label><a href="forgot_password.php">Forgot password?</a></label>
            </div>
        </div>

        <span>
            Don't have account?
            <a href="signup.php">Sign Up</a>
        </span>
        </form>

        <?php 
        if(isset($_COOKIE['usernamecookie']) and isset($_COOKIE['passwordcookie'])){ 
            $name = $_COOKIE['usernamecookie'];
            $pass = $_COOKIE['passwordcookie'];

            echo "<script>
                document.getElementById('name').value = '$name';
                document.getElementById('pass').value = '$pass';
            </script>";
        } 
        ?>
    </div>
   </div>
</body>
</html>