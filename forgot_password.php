<?php
session_start();
include 'links.php';
include 'connection.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_password_reset($name, $email, $otp){
    $mail = new PHPMailer(true);
    //$mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth   = true;   

    $mail->Host       = 'smtp.gmail.com'; 
    $mail->Username   = 'typingtest635@gmail.com';                
    $mail->Password   = 'mznh resf gyqe wexa';

    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587; 

    $mail->setFrom('typingtest635@gmail.com', $name);
    $mail->addAddress($email);

    $mail->isHTML(true);                                 
    $mail->Subject = 'Reset Password Notification';

    $email_template="
    <h2>Hello, {$name}</h2>
    <h5>You are receiving this email because we received a password reset request for your account.$otp</h5>
    ";

    $mail->Body    = $email_template;

    $mail->send();
}

$errorMessages = array();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());

    $check_email= "SELECT * FROM registration WHERE email='$email'";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run)>0){
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['fullname'];
        $get_email = $row['email'];
        $verification_otp = random_int(100000, 999999);

        $update_token = "UPDATE registration SET otp='$verification_otp' WHERE email='$get_email'";
        $update_token_run = mysqli_query($conn, $update_token);

        if($update_token_run){
            send_password_reset($get_name, $get_email, $verification_otp);
            ?>
              <script>
              alert("We e-mailed you a password verification otp.Please check your email");
              window.location = 'otp.php'; // Redirect after showing the alert
              </script>
            <?php
        }else{
          $errorMessages[] = "Something went wrong.";
        }
    }else{
      $errorMessages[] = "No Email found";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="box">
        <div class="container">
          <div class="top_header">
            <header>Recover Your Account</header>
          </div>
          <?php
          foreach($errorMessages as $errorMessage) {
            echo '<div class="error-message">' . $errorMessage . '</div>';
          }
          ?>
              <form action="" method="POST">
                <div class="input_field"> 
                  <input type="email" class="input" name="email" placeholder="Email" required />
                  <i aria-hidden="true" class="fa fa-envelope"></i>
                </div>
              
                <span>
                <input class="submit" type="submit" name="submit" value="Send Mail" />
                </span>
              </form>
          </div>
        </div>
      </div>
</body>
</html>