<?php
    
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bus_ticket_booking";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO Bookings (user_id, schedule_id, booking_date, status) VALUES ( ?, ?, CURRENT_DATE, 'ok')";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Failed to prepare the SQL statement: " . $conn->error);
    }
    
    $stmt->bind_param("ii", $_SESSION['user_id'], $_SESSION['schedule_id']);
    
    $current_date=date("Y-m-d");

    if ($stmt->execute() === false) {
        // Handle execution error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

    // echo "Data 1 inserted successfully!";

    // Ensure seats_info is available in the session
    if (!isset($_SESSION['seats_info'])) {
        die("Session data not found.");
    }

    // Get the number of seats
    $num_seats = count($_SESSION['seats_info']);

    // Initialize an array to hold passenger details
    $passengerDetails = [];

    // Loop through the posted data
    for ($i = 1; $i <= $num_seats; $i++) {
        // Collect passenger details
        $name = $_POST['name' . $i];
        $gender = $_POST['gender' . $i];
        $age = $_POST['age' . $i];
        $seat = $_SESSION['seats_info'][$i - 1]; // Get seat number from session data

        // Add passenger details to the array
        $passengerDetails[] = [
            'name' => $name,
            'gender' => $gender,
            'age' => $age,
            'seat' => $seat
        ];
    }

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO Passengers (booking_id, seat_number, name, gender, age) VALUES (?, ?, ?, ?, ?)";

    // echo 'Hii';


    // Prepare the statement
    $stmt = $conn->prepare($sql);


    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Failed to prepare the SQL statement: " . $conn->error);
    }

    // Example booking_id
    $booking_id = $conn->insert_id; // You can get this value based on your logic

    // Loop through the passenger details and execute the insert query
    foreach ($passengerDetails as $passenger) {
        $stmt->bind_param("iissi", $booking_id, $passenger['seat'], $passenger['name'], $passenger['gender'], $passenger['age']);
        
        if ($stmt->execute() === false) {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="navbar.css?vg34">
    <link rel="stylesheet" href="view_ticket.css?kk">
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
  
  <div style="margin: auto; width: fit-content; color: #ffc107; font-size: 25px; margin-top: 0px; margin-bottom: 30px;" class="text">Ticket Booked Successfully : )</div>
  <div class="text1" style="background-color: white; width: fit-content; margin: auto; padding: 20px 20px; height: 825px; margin-bottom: 70px;">
    <div style="font-size: 20px; font-weight: 500; width: fit-content; margin-bottom: 15px;">Ticket Details</div>
    <ul style="list-style-type: none; padding-left: 0px; margin: 0px 0px; display: flex; border: 1px solid black; padding: 10px 0px;">
       <li class="width align"><div class="text2">Origin</div><div><?php echo $_SESSION['origin']; ?></div><div><?php echo $_SESSION['dep_time']; ?></div></li>
       <li class="align" style="width: 300px;"><div class="text2">Departure</div><div><?php echo $_SESSION['dep_date'].' ('.$_SESSION['dep_time'].')'; ?></div></li>
       <li class="width align"><div class="text2">Destination</div><div><?php echo $_SESSION['destination']; ?></div><div><?php echo $_SESSION['arr_time']; ?></div></li>
    </ul>
    <ul style="list-style-type: none; padding-left: 0px; display: flex; border: 1px solid black; padding: 10px 0px;">
        <li class="width align"><div class="text2">Booking Id</div><div><?php echo $booking_id; ?></div></li>
        <li class="align" style="width: 300px;"><div class="text2">Bus No</div><div><?php echo $_SESSION['bus_no']; ?></div></li>
        <li class="width align"><div class="text2">Type</div><div>AC</div></li>
     </ul>
     <ul style="list-style-type: none; padding-left: 0px; display: flex; border: 1px solid black; padding: 10px 0px;">
        <li class="width align"><div class="text2">Distance</div><div><?php echo $_SESSION['distance']; ?></div></li>
        <li class="align" style="width: 300px;"><div class="text2">Duration</div><div><?php echo $_SESSION['duration']; ?></div></li>
        <li class="width align"><div class="text2">Booking Date</div><div><?php echo $current_date; ?></div></li>
     </ul>
     <div>
        <div style="font-weight: 500; color: black; border: 1px solid black; padding: 2px 10px;">Passenger Details</div>
        <ul style="list-style-type: none; padding-left: 0px; display: flex; margin-top: 0px; border: 1px solid black;  border-top: none; padding: 10px 10px;">
            <li  style="display: flex; flex-direction: column; margin-right: 20px;"><div class="text2">#</div>
            <?php
            for ($i = 1; $i <= $num_seats; $i++) {
                echo '<div>'.$i.'.</div>';
            }
            ?>
            </li>
            <li  style="display: flex; flex-direction: column; margin-right: 20px;"><div class="text2">Name</div>
            <?php
            for ($i = 1; $i <= $num_seats; $i++) {
                echo '<div>'.$passengerDetails[$i-1]['name'].'</div>';
            }
            ?>
            </li>
            <li  class="width align"><div class="text2">Age</div>
            <?php
            for ($i = 1; $i <= $num_seats; $i++) {
                echo '<div>'.$passengerDetails[$i-1]['age'].'</div>';
            }
            ?>
            </li>
            <li  class="width align"><div class="text2">Gender</div>
            <?php
            for ($i = 1; $i <= $num_seats; $i++) {
                echo '<div>'.$passengerDetails[$i-1]['gender'].'</div>';
            }
            ?>            
            </li>
            <li  class="width align"><div class="text2">Status</div>
            <?php
            for ($i = 1; $i <= $num_seats; $i++) {
                echo '<div>CNF / seat no '.$passengerDetails[$i-1]['seat'].'</div>';
            }
            ?>
            </li>
         </ul>
     </div>
     <div>
        <div style="font-weight: 500; color: black; border: 1px solid black; padding: 2px 10px;">Payment Details</div>
        <ul style="list-style-type: none; padding-left: 0px; display: flex; margin: 0px 0px; border: 1px solid black; border-top: none; padding: 10px 10px;">
            <li  class="width" style="width: 300px; display: flex; flex-direction: column;"><div>Ticket Fare</div><div>Convenience Fee(Incl of GST)</div><div>Travel Insurance(Incl of GST)</div><div>Total Fare(all inclusive)</div></li>
            <li  class="width text2" style="font-weight: 400; display: flex; flex-direction: column;"><div>Rs <?php echo $num_seats*$_SESSION['price']*1.00; ?></div><div>Rs <?php echo $num_seats*16.20; ?></div><div>Rs 1.05</div><div>Rs <?php echo $num_seats*($_SESSION['price']+16.20)+1.05; ?></div></li>
         </ul>
     </div>
  </div>
</body>
</html>