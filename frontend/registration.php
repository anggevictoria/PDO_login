<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="login-box">
        <form class= "form" action="../API/register_query.php" method="POST">
          
          <div class="user-box">
            <input type="text" name="firstname" required="">
            <label>First Name</label>
          </div>

          <div class="user-box">
            <input type="text" name="lastname" required="">
            <label>Last Name</label>
          </div>

          <div class="user-box">
            <input type="text" name="username" required="">
            <label>Username</label>
          </div>
          
          <div class="user-box">
            <input type="password" name="password" required="">
            <label>Password</label>
          </div>

          <input type="submit" value="Register" name="register">
        </form>
        
        <p class="text--center">Already have an account? <a href="../index.php">Proceed to Login</a> <svg class="icon">
</body>
</html>

