<?php
session_start();

// Validate and sanitize the user input
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];

if (!$email || !$password) {
    // Invalid input
    header('Location: Login.html');
    exit();   
}

// Connect to the MySQL database
$host = 'localhost';
$db = 'websec';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);    
}

// Fetch the user's hashed password from the database
$query = "SELECT password FROM user WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->bind_result($hashedPassword);
$stmt->fetch();
$stmt->close();

// Verify the password
if (password_verify($password, $hashedPassword)) {
    // Authentication successful
    $_SESSION['email'] = $email;
    header('Location: student_details.php');
} else {
    // Invalid credentials
    header('Location: login.html');
}

$conn->close();
?>
