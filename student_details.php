<?php
session_start();

if (!isset($_SESSION['email'])) {
    // User not authenticated, redirect to login page
    header('Location: Login.html');
    exit();
}

// Display the protected content of the student details page
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['email']; ?></h1>
    <p>Student details go here...</p>
    <a href="logout.php">Logout</a>
</body>
</html>
