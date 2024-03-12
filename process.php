<?php
include("connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["signup"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    $state = mysqli_real_escape_string($conn, $_POST["state"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $role = mysqli_real_escape_string($conn, $_POST["role"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    if ($password != null && $confirm_password != null && $password == $confirm_password) {
        // Insert data into 'state' table first
        $sql_state = "INSERT INTO state (Country, State, City) VALUES ('$country', '$state', '$city')";
        if (mysqli_query($conn, $sql_state)) {
            $state_id = mysqli_insert_id($conn); // Get the auto-generated state_id
            // Insert data into 'users' table
            $sql_users = "INSERT INTO users (Username, Email, State_id, Phone, role, Password)
             VALUES ('$name', '$email','$state_id', '$phone', '$role', '$password')";

            if (mysqli_query($conn, $sql_users)) {
                //echo "Records inserted successfully";
                header("Location: login.html");
            } else {
                die("Something went wrong: " . mysqli_error($conn));
            }
        } else {
            die("Something went wrong: " . mysqli_error($conn));
        }
    } else {
        echo ("Password didn't match");
    }
} elseif (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // This block handles AJAX requests
    if (isset($_POST['country'])) {
        $country = mysqli_real_escape_string($conn, $_POST['country']);

        // Fetch states based on country
        $sql = "SELECT DISTINCT State FROM city_detail WHERE Country = '$country'";
        $result = mysqli_query($conn, $sql);

        $options = '<option value="" disabled selected>Select your State</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['State'] . '">' . $row['State'] . '</option>';
        }

        echo $options;
    } elseif (isset($_POST['state'])) {
        $state = mysqli_real_escape_string($conn, $_POST['state']);

        // Fetch cities based on state
        $sql = "SELECT City FROM city_detail WHERE State = '$state'";
        $result = mysqli_query($conn, $sql);

        $options = '<option value="" disabled selected>Select your City</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['City'] . '">' . $row['City'] . '</option>';
        }

        echo $options;
    }
}
?>
