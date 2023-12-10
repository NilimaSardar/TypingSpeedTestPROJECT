<?php
$page_title = "Register";
include 'links.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($page_title)){ echo "$page_title"; } ?> - Typing Speed Test</title>
    <link rel="stylesheet" href="css/form.css">
    <style>
  
    input:focus-visible{
        outline: 0.1rem solid  #B2C8BA;
    }
    </style>
</head>
<body>
<?php

include 'connection.php';

$fname = $username = $email = '';
$errorMessages = array();

if(isset($_POST['submit'])){
  $fname = mysqli_real_escape_string($conn,$_POST['fname']);
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);
  $Rpassword = mysqli_real_escape_string($conn,$_POST['Rpassword']);

   // Password requirements
   $password_min_length = 8; // Minimum password length
   $password_complexity = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/';
 
   // Email validation regular expression
   $email_regex = '/^\S+@\S+\.\S+$/';
 
   $pass = password_hash($password, PASSWORD_BCRYPT);
   $Rpass = password_hash($Rpassword, PASSWORD_BCRYPT);
 
   $usernamequery = "SELECT * FROM registration WHERE username = '$username'";
   $Uquery = mysqli_query($conn,$usernamequery);
 
   $usercount = mysqli_num_rows($Uquery);
 
   $emailquery = "SELECT * FROM registration WHERE email = '$email'";
   $query = mysqli_query($conn,$emailquery);
 
   $emailcount = mysqli_num_rows($query);

    if($usercount > 0){
      $errorMessages[] = 'user already exist!';
    }else{
      if($emailcount>0){
        $errorMessages[] = "Email already exists";
      }elseif(!preg_match($email_regex, $email)){
        $errorMessages[] = "Invalid email format. Please enter a valid email address.";
      }else{
        if($password  != $Rpassword ){
            $errorMessages[] = 'password not matched!';
        }elseif (strlen($password) < $password_min_length) {
          $errorMessages[] = "Password is too short. It must be at least $password_min_length characters long.";
        } elseif (!preg_match($password_complexity, $password)) {
          $errorMessages[] = "Password must include at least one lowercase letter, one uppercase letter, one number, and one special character.";
        }
        else{
          $insertquery = "INSERT INTO registration(fullname,username,email,password)
          VALUES('$fname','$username','$email','$pass')";
  
          $iquery = mysqli_query($conn,$insertquery);
  
          if($iquery){
            ?>
            <script>
            alert("Registered successfully");
            window.location = 'login.php'; // Redirect after showing the alert
            </script>
            <?php
          } else {
            die("Not inserted: " . mysqli_error($conn));
          }
        }
      }
    }
    

}
 ?>

    <div class="box">
        <div class="container">
          <div class="top_header">
            <header>Create your account</header>
          </div>
          <?php
          foreach($errorMessages as $errorMessage) {
            echo '<div class="error-message">' . $errorMessage . '</div>';
          }
          ?>
              <form action="" method="POST">
                <div class="input_field">
                  <input type="text" class="input" name="fname" placeholder="Full Name" autocomplete="off" value="<?php echo $fname; ?>" required/>
                  <i aria-hidden="true" class="fa fa-user"></i>
                </div>
                <div class="input_field">
                  <input type="text" class="input" name="username" placeholder="User Name" autocomplete="off" value="<?php echo $username; ?>" required/>
                  <i aria-hidden="true" class="fa fa-user"></i>
                </div>
                <div class="input_field"> 
                  <input type="email" class="input" name="email" placeholder="Email" autocomplete="off" value="<?php echo $email; ?>" required/>
                  <i aria-hidden="true" class="fa fa-envelope"></i>
                </div>
                <div class="input_field">
                  <input type="password" class="input" name="password" placeholder="Password" autocomplete="off" required/>
                  <i aria-hidden="true" class="fa fa-lock"></i>
                </div>
                <div class="input_field">
                  <input type="password" class="input" name="Rpassword" placeholder="Re-type Password" autocomplete="off" required/>
                  <i aria-hidden="true" class="fa fa-lock"></i>
                </div>
                
                <!--<div class="bottom">
                  <div class="left">
                    <input type="checkbox" id="check">
                    <label for="check">I agree with <a href="#">terms & conditions</a></label>
                  </div>
                </div>-->
                <span>
                <input class="submit" type="submit" name="submit" value="Register" />
                </span>
              </form>
          </div>
        </div>
      </div>
</body>
</html>