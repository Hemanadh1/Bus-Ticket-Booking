<?php
// sign-in.php
// Start session
session_start();

// Database connection
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists
    $sql = "SELECT * FROM Users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['user_id'];
            echo "<script>alert('Sign in successful!'); window.location.href='user.php';</script>";
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href='sign-in.php';</script>";
        }
    } else {
        echo "<script>alert('Username does not exist!'); window.location.href='sign-in.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
