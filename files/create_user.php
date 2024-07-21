<?php
// sign-up.php
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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='sign-up.php';</script>";
        exit();
    }

    // Check if username already exists
    $sql = "SELECT * FROM Users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists! Please try another name.'); window.location.href='sign-up.php';</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $sql = "INSERT INTO Users (user_name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Sign up successful!'); window.location.href='sign-in.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='sign-up.php';</script>";
        }
    }

    $stmt->close();
}

$conn->close();
?>
