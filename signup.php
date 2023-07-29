<?php
include 'links.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>
<body>
    <div class="box">
        <div class="container">
          <div class="top_header">
            <header>Create your account</header>
          </div>
              <form action="login.php">
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
                  <input type="password" class="input" name="password" placeholder="Re-type Password" required />
                  <i aria-hidden="true" class="fa fa-lock"></i>
                </div>
                
                <div class="bottom">
                  <div class="left">
                    <input type="checkbox" id="check">
                    <label for="check">I agree with <a href="#">terms & conditions</a></label>
                    </div>
                </div>
                <span>
                <input class="submit" type="submit" value="Register" />
                </span>
              </form>
          </div>
        </div>
      </div>
</body>
</html>