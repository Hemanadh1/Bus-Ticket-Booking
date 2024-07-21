<!-- <?php
  // passenger_details.php
  session_start();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $seatsInfo = json_decode($_POST['seats_info'], true);
      $_SESSION['seats_info'] = $seatsInfo;
      echo json_encode(['status' => 'success', 'message' => 'Data received']);
  }
  
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="navbar.css?vv12vg34">
    <link rel="stylesheet" href="passenger_details.css?vhh">
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
  
    <form action="view_ticket.php" method="post">
      <div class="container">
        <ul class="items_list" style="padding-left: 0px; margin: 0px 0px;">

          <?php
            $i=1;
            foreach($_SESSION['seats_info'] as $seat){
              echo '<li class="item" style="padding: 20px 20px; margin-bottom: 25px;">
                    <div style="display: flex;">
                      <div class="text break">Passenger '.$i.'</div>
                      <div class="text break" style="margin: 0px 5px;">|</div>
                      <div class="text" style="font-size: 14px; font-weight: 500;">Seat No '.$seat.'</div>
                    </div>  
                      <label for="name'.$i.'" class="text break">Name</label>
                      <div class="break"></div>
                      <input class="text break" style="width: 600px; height: 25px;" type="text" id="name'.$i.'" name="name'.$i.'" required><br>
                      <ul style="list-style-type: none; display: flex; padding-left: 0px;">
                          <li style="margin-right: auto;">
                              <label class="text break">Gender</label>
                              <div class="break"></div>
                              <input class="text" style="transform: scale(1.2);" type="radio" id="male'.$i.'" name="gender'.$i.'" value="male" required>
                              <label class="text" style="font-size: 15px;" for="male'.$i.'">Male</label>
                              <input class="text" style="transform: scale(1.2);" type="radio" id="female'.$i.'" name="gender'.$i.'" value="female" required>
                              <label class="text" style="font-size: 15px;" for="female'.$i.'">Female</label>
                          </li>
                          <li style="margin-bottom: 0px;">
                              <label class="text break" for="age'.$i.'">Age</label>
                              <div class="break"></div>
                              <input class="text" style="width: 180px; height: 21px;" type="number" id="age'.$i.'" name="age'.$i.'" required>
                          </li>
                      </ul>
                    </li>';
              $i++;
            }
          ?>
            
            <li style="width: fit-content; margin-left: auto;">
                <button class="text" style="width: 140px; height: 33px; font-size: 14px; cursor: pointer; background-color: #ffd24b; border-radius: 0px; border-color: #ffd24b; opacity: 100%; margin-top: 10px; color: black; border-width: 0px;" type="submit">CONFIRM BOOKING</button>
            </li>
        </ul>
      </div>

      </form>
</body>
</html>