<?php
// login_process.php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include "connect.php";

    // Retrieve username and password from form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if user exists
    $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
    $result = mysqli_query($conn, $sql);

    // Check if user exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // User found, set session and redirect to dashboard or home page
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $row['Id'];
        $_SESSION['role'] = $row['role'];
        header("Location: dashboard.php"); // Redirect to dashboard page
        exit();
    } else {
        // User not found, redirect back to login page with error message
        $_SESSION['error'] = "Invalid username or password";
        header("Location: index.php"); // Redirect to login page
        exit();
    }
}
?>
