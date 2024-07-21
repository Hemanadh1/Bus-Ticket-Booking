<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="navbar.css?vgv34">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
  
  <div style="width: fit-content; margin: auto;">
  <button id="i" onclick="runPHPCode()" class="text" style="background-color: #ffd041; border-radius: 0%; padding: 5px 10px; border-style: solid; height: 60px; width: 200px; border-width: 0px; cursor: pointer;">Sign Out</button>
  </div>
  <div style="margin: auto; width: fit-content; color: #ffc107; font-size: 25px; margin-top: 50px;" class="text">Previous Bookings</div>

  
  <script>
    function runPHPCode() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "sign-out.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                  window.location.href='welcome.php';
                }
            };
            xhr.send();
        }
  </script>
</body>
</html>