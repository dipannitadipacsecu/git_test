<?php
include("connect.php");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apartment_no = mysqli_real_escape_string($conn, $_POST["apartment_no"]);
    $street_no = mysqli_real_escape_string($conn, $_POST["street_no"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $rent = mysqli_real_escape_string($conn, $_POST["rent"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $details = mysqli_real_escape_string($conn, $_POST["details"]);
    $sql_acc = "INSERT INTO accommodation (apartment_no, street_no, city, rent, address, phone, details) VALUES ('$apartment_no', '$street_no','$city', '$rent', '$address', '$phone', '$details')";
    if (mysqli_query($conn, $sql_acc)) {
        // Redirect back to accommodation page after successful submission
        // header("Location: accommodation.php");
        // exit();
   
        $_SESSION['word']="accommodation";
    } else {
        echo "Error: " . $sql_acc . "<br>" . mysqli_error($conn);
    }
}


// Retrieve parameters from the URL
$userId = isset($_GET['userId']) ? trim($_GET['userId']) : trim($_SESSION['userId']);
$word = isset($_GET['word']) ? $_GET['word'] : trim($_SESSION['word']);

// Process the parameters
if ($userId != '' && $word == 'accommodation') {

    // Add your processing logic here

    $sql = "select * from accommodation where City=(Select City from state where
     State_id=(SELECT State_id FROM `users` WHERE Id=$userId)); ";
$result = mysqli_query($conn, $sql);



    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $serialized_row = http_build_query($row);
    header('Location: accommodation.php?' . $serialized_row);
    exit();
    



// Close the database connection
mysqli_close($conn);
}     


?>