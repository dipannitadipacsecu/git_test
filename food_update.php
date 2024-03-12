<?php
include("connect.php");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which form was submitted based on the form_type parameter
    if (isset($_POST['form_type'])) {
        $form_type = $_POST['form_type'];

        // Process the first form
        if ($form_type === 'search_restaurant') {
            // Retrieve parameters from the POST data
            $city = isset($_POST['location']) ? trim($_POST['location']) : "";

            // Process the parameters
            if ($city != '') {
                // Escape the city variable
                $escaped_city = mysqli_real_escape_string($conn, $city);

                // Construct the SQL query
                $sql = "SELECT * FROM restaurant WHERE City = '$escaped_city';";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result) {
                    // Fetch the data
                    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $serialized_row = http_build_query($row);
                    header('Location: restaurant.php?' . $serialized_row);
                    exit();
                } else {
                    // If the query failed, display an error
                    echo "Error in SQL query: " . mysqli_error($conn);
                }
            } else {
                // If city is empty, handle accordingly
                echo "City parameter is empty";
            }
        }
        else if ($form_type === 'update_restaurant') {
            
            $name = mysqli_real_escape_string($conn, $_POST["r_name"]);
            $type = mysqli_real_escape_string($conn, $_POST["type"]);
            $address = mysqli_real_escape_string($conn, $_POST["add"]);
            $country = mysqli_real_escape_string($conn, $_POST["country"]);
            $city = mysqli_real_escape_string($conn, $_POST["city"]);
            $state = mysqli_real_escape_string($conn, $_POST["state"]);
            $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
             $sql_res = "INSERT INTO restaurant (R_Name, Type,Address, Country, City, State, Phone) VALUES ('$name', '$type','$address', '$country', '$city', '$state', '$phone')";
    if (mysqli_query($conn, $sql_res)) {
        // Redirect back to accommodation page after successful submission
        // header("Location: accommodation.php");
        // exit();
        header("Location: restaurant.php");
        $_SESSION['word']="food";
    } else {
        echo "Error: " . $sql_res . "<br>" . mysqli_error($conn);
    }

        }
        // Process the second form
        elseif ($form_type === 'form2') {
            // Handle form2 submission
        }

        // If form_type is neither 'search_restaurant' nor 'form2'
        else {
            echo "Invalid form type";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
