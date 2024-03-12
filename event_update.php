<?php
include("connect.php");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the keys exist in $_POST before using them
    $e_name = isset($_POST["name"]) ? mysqli_real_escape_string($conn, $_POST["name"]) : "";
    $time = isset($_POST["time"]) ? mysqli_real_escape_string($conn, $_POST["time"]) : "";
    $date = isset($_POST["date"]) ? mysqli_real_escape_string($conn, $_POST["date"]) : "";
    $place = isset($_POST["place"]) ? mysqli_real_escape_string($conn, $_POST["place"]) : "";
    $city = isset($_POST["city"]) ? mysqli_real_escape_string($conn, $_POST["city"]) : "";
    $des = isset($_POST["des"]) ? mysqli_real_escape_string($conn, $_POST["des"]) : "";

    // Check if all necessary fields are set
        $sql_event = "INSERT INTO event (E_Name, Time, Date, Place, City, Description) VALUES ('$e_name', '$time','$date', '$place', '$city', '$des')";
        if (mysqli_query($conn, $sql_event)) {
       
            $_SESSION['word'] = "event";
        } else {
            echo "Error: " . $sql_event . "<br>" . mysqli_error($conn);
        }
}
// Retrieve parameters from the URL
$userId = isset($_GET['userId']) ? trim($_GET['userId']) : trim($_SESSION['userId']);
$word = isset($_GET['word']) ? $_GET['word'] : trim($_SESSION['word']);

// Process the parameters
if ($userId != '' && $word == 'event') {

    // Add your processing logic here

    $sql = "select * from event where City=(Select City from state where
     State_id=(SELECT State_id FROM `users` WHERE Id=$userId)); ";
$result = mysqli_query($conn, $sql);



    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $serialized_row = http_build_query($row);
    header('Location: event.php?' . $serialized_row);
    exit();
    



// Close the database connection
mysqli_close($conn);
}     


?>
