<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="navbar.css?vg34">
    <link rel="stylesheet" href="login.css?x">
</head>
<body style="margin: 0px; background-color: rgb(58, 55, 55);">
<div class="header">
    <div class="navbar-container">
      <ul class="navbar">
        <li class="nav">
          <a class="nav-text" href="welcome.php">HOME</a>
        </li>
        <li class="nav">
          <a class="nav-text" href="#">ABOUT US</a>
        </li>
        <li class="nav">
          <a class="nav-text" href="#">CONTACT</a>
        </li>
        <li class="nav">
            <?php
              if (isset($_SESSION['username']) && $_SESSION['username']!='ukn') {
                echo '<a class="nav-text sign-in" href="user.php">'.$_SESSION['username'].'</a>';
              }
              else{
                echo '<a class="nav-text sign-in" href="sign-in.php">SIGN IN</a>';
              }
            ?>
        </li>
      </ul>
    </div>
  </div>
  
<div class="container">
    <h2>Sign In</h2>
    <form action="verify_user.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign In</button>
    </form>
    <a class="link" href="sign-up.php">Don't have an account? Sign Up</a>
</div>

</body>
</html>