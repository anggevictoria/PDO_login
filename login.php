<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <<div class="login-box">
        <h2>Welcome to UrSECRET</h2>
        <form class= "form">
          <div class="user-box">
            <input type="text" name="" required="">
            <label>Username</label>
          </div>
          <div class="user-box">
            <input type="password" name="" required="">
            <label>Password</label>
          </div>
          
          <input type="submit" value="Login">
        </form>
        
        <p class="text--center">Not a member? <a href="register.html">Register now</a> <svg class="icon">
              <use xlink:href="#icon-arrow-right"></use>
            </svg></p>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" class="icons">
      <symbol id="icon-arrow-right" viewBox="0 0 1792 1792">
            <path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
          </symbol>
</body>
</html>