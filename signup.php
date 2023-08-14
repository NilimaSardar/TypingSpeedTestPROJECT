<?php
include 'links.php';
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
<?php

include 'connection.php';

if(isset($_POST['submit'])){
  $fname = mysqli_real_escape_string($conn,$_POST['fname']);
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);
  $Rpassword = mysqli_real_escape_string($conn,$_POST['Rpassword']);

  $pass = password_hash($password, PASSWORD_BCRYPT);
  $Rpass = password_hash($Rpassword, PASSWORD_BCRYPT);

  $usernamequery = " select * from registration where username = '$username'";
  $Uquery = mysqli_query($conn,$usernamequery);

  $usercount = mysqli_num_rows($Uquery);

  $emailquery = " select * from registration where email = '$email'";
  $query = mysqli_query($conn,$emailquery);

  $emailcount = mysqli_num_rows($query);

  if($usercount>0){
    echo "username already exists";
  }elseif($emailcount>0){
      echo "email already exists";
    }else{
    if($password === $Rpassword){

      $insertquery = "insert into registration(fullname,username,email,password,Rpassword)
       values('$fname','$username','$email','$pass','$Rpass')";

      $iquery = mysqli_query($conn,$insertquery);

      if($iquery){
          ?>
          <script>
          alert ("Inserted successful");
          </script>
          <?php
      }else{
          //echo "No Inserted";
          die("No Inserted".mysqli_connect_error());
      }

    }else{
      //echo "password are not matching";
      ?>
      <script>
        alert ("password are not matching");
      </script>
      <?php
    }
  }
}
?>

    <div class="box">
        <div class="container">
          <div class="top_header">
            <header>Create your account</header>
          </div>
              <form action="" method="POST">
                <div class="input_field">
                  <input type="text" class="input" name="fname" placeholder="Full Name" />
                  <i aria-hidden="true" class="fa fa-user"></i>
                </div>
                <div class="input_field">
                  <input type="text" class="input" name="username" placeholder="User Name" required />
                  <i aria-hidden="true" class="fa fa-user"></i>
                </div>
                <div class="input_field"> 
                  <input type="email" class="input" name="email" placeholder="Email" required />
                  <i aria-hidden="true" class="fa fa-envelope"></i>
                </div>
                <div class="input_field">
                  <input type="password" class="input" name="password" placeholder="Password" required />
                  <i aria-hidden="true" class="fa fa-lock"></i>
                </div>
                <div class="input_field">
                  <input type="password" class="input" name="Rpassword" placeholder="Re-type Password" required />
                  <i aria-hidden="true" class="fa fa-lock"></i>
                </div>
                
                <div class="bottom">
                  <div class="left">
                    <input type="checkbox" id="check">
                    <label for="check">I agree with <a href="#">terms & conditions</a></label>
                    </div>
                </div>
                <span>
                <input class="submit" type="submit" name="submit" value="Register" />
                </span>
              </form>
          </div>
        </div>
      </div>
</body>
</html>