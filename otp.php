<?php
session_start();
include 'links.php';
include 'connection.php';

$errorMessages = array();

if(isset($_POST['submit'])){
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    $check_otp= "SELECT * FROM registration WHERE otp='$otp'";
    $check_otp_run = mysqli_query($conn, $check_otp);

    if(mysqli_num_rows($check_otp_run)>0){
        $row = mysqli_fetch_array($check_otp_run);
        
        $get_otp = $row['otp'];

        $_SESSION['email'] = $row['email'];

        if($otp==$get_otp){
          ?>
              <script>
              alert("OTP matched..Change your password");
              window.location = 'change_password.php'; // Redirect after showing the alert
              </script>
          <?php
        }else{
          $errorMessages[] = "OTP does not matched";
        }
    }else{
      $errorMessages[] = "Something went wrong.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="css/login_reg.css">
</head>
<body>
    <div class="box">
        <div class="container">
          <div class="top_header">
            <header>Verify OTP</header>
          </div>
          <?php
          foreach($errorMessages as $errorMessage) {
            echo '<div class="error-message">' . $errorMessage . '</div>';
          }
          ?>
              <form action="" method="POST">
                <div class="input_field"> 
                  <input type="text" class="input" name="otp" placeholder="OTP here" required />
                  <i class="fa fa-check-square" aria-hidden="true"></i>
                </div>
              
                <span>
                <input class="submit" type="submit" name="submit" value="Done" />
                </span>
              </form>
          </div>
        </div>
      </div>
</body>
</html>