    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include("connect.php");
    session_start();
    if (!isset($_SESSION["userId"])) {
    // Redirect to the login page
    header("Location: login.html");
    exit(); // Stop further execution of the script
}

if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    // Perform logout actions
    session_unset();
    session_destroy();
    header("Location: login.html"); // Redirect to login page after logout
    exit();
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check which form was submitted
        if (isset($_POST["form_type"])) {
            $formType = $_POST["form_type"];

            // Handle Change Password form
            if ($formType === "change_password") {
                handlePasswordChange();
            }
            // Handle Update Info form
            elseif ($formType === "update_info") {
                handleUpdateInfo();
            }
            // Handle Picture Upload form
            elseif ($formType === "upload_picture") {
                handlePictureUpload();
            }
            // Add more conditions for additional forms if needed
            else {
                echo "Invalid form type.";
            }
        } else {
            echo "Form type not set.";
        }
    }elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Fetch user information from the database
        $userId = isset($_SESSION["userId"]) ? $_SESSION["userId"] : null; // Update this according to your setup

        if ($userId) {
            $sql_fetch_info = "SELECT u.*, s.Country,s.City,s.State FROM `users`AS u JOIN State AS s ON u.State_id=s.State_id where u.Id='$userId'";
            $result_fetch_info = mysqli_query($conn, $sql_fetch_info);

            if ($result_fetch_info) {
                $row = mysqli_fetch_assoc($result_fetch_info);

                // Return user information as a JSON object
                header('Content-Type: application/json');
                echo json_encode($row);
            } else {
                // Handle the error or return an appropriate response
                header('Content-Type: application/json');
                echo json_encode(array('error' => 'Error fetching user information: ' . mysqli_error($conn)));
            }
        } else {
            // Handle the case where userId is not set in the session
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'User ID not set in the session.'));
        }
    }
     else {
        // Handle invalid request method
        echo "Invalid request method.";
        // Include an exit statement here if needed
        exit();
    }

    function handlePasswordChange() {
        global $conn;

        // Assuming you have a valid database connection in $conn
        $currentPassword = $_POST["current-password"];
        $newPassword = $_POST["new-password"];
        $confirmPassword = $_POST["confirm-password"];

        // Validate input
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            echo "All fields are required.";
        } else {
            // Fetch the current user's username from your session or database
            $userId = isset($_SESSION["userId"]) ? $_SESSION["userId"] : null; // Update this according to your setup

            if ($userId) {
                // Fetch the current password from the database
                $sql_fetch_password = "SELECT password FROM users WHERE Id = '$userId'";
                $result_fetch_password = mysqli_query($conn, $sql_fetch_password);

                if ($result_fetch_password) {
                    $row = mysqli_fetch_assoc($result_fetch_password);
                    $storedPassword = $row["password"];

                    $sql_update_password = "UPDATE users SET Password = '$newPassword' WHERE Id = '$userId'";
                    $result_update_password = mysqli_query($conn, $sql_update_password);

                    if ($result_update_password) {
                        $responseMessage = "Password changed successfully!";
                    } else {
                        $responseMessage = "Error updating password: " . mysqli_error($conn);
                    }
                } else {
                    $responseMessage = "Error updating password: " . mysqli_error($conn);
                }
            } else {
                $responseMessage = "Error updating password: " . mysqli_error($conn);
            }
                            $_SESSION["profileResponse"] = $responseMessage;
                    header("Location: mypro.php");
                    exit();
        }
    }

    function handleUpdateInfo() {
        global $conn;

        // Assuming you have a valid database connection in $conn
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $country = mysqli_real_escape_string($conn, $_POST["country"]);
        $state = mysqli_real_escape_string($conn, $_POST["state"]);
        $city = mysqli_real_escape_string($conn, $_POST["city"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $role = mysqli_real_escape_string($conn, $_POST["role"]);

        // Fetch the current user's id from your session or database
        $userId = isset($_SESSION["userId"]) ? $_SESSION["userId"] : null; // Update this according to your setup

        if ($userId) {
            // Update the 'users' table
            $sql_update_users = "UPDATE users SET Username = '$name', Email = '$email', Phone = '$phone', role = '$role' WHERE Id = '$userId'";

            if (mysqli_query($conn, $sql_update_users)) {
                // Fetch the state_id from the updated user record
                $sql_fetch_state_id = "SELECT State_id FROM users WHERE Id = '$userId'";
                $result_fetch_state_id = mysqli_query($conn, $sql_fetch_state_id);

                if ($result_fetch_state_id) {
                    $row = mysqli_fetch_assoc($result_fetch_state_id);
                    $stateId = $row["State_id"];

                    // Update the 'state' table
                    $sql_update_state = "UPDATE state SET Country = '$country', State = '$state', City = '$city' WHERE State_id = '$stateId'";

                    if (mysqli_query($conn, $sql_update_state)) {
                        $responseMessage = "Information changed successfully!";
                    } else {
                        $responseMessage = "Error updating password: " . mysqli_error($conn);
                    }
                } else {
                    $responseMessage = "Error updating password: " . mysqli_error($conn);
                }
            } else {
                $responseMessage = "Error updating password: " . mysqli_error($conn);
            }
        } else {
            $responseMessage = "Error updating password: " . mysqli_error($conn);
        }
                                $_SESSION["profileResponse"] = $responseMessage;
                    header("Location: mypro.php");
                    exit();
    }


    function handlePictureUpload() {
            global $conn;
        // Get the timestamp for the file name
        $timestamp = time();

        // Original file name
        $originalFileName = $_FILES['profile-picture-input']['name'];

        // Get the file extension
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Construct the new file name with timestamp
        $newFileName = 'profile_picture_' . $timestamp . '.' . $fileExtension;

        // Specify the upload directory
        $uploadDirectory = 'profile_picture/';

        // Full path to the uploaded file
        $targetPath = $uploadDirectory . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['profile-picture-input']['tmp_name'], $targetPath)) {

        $userId = isset($_SESSION["userId"]) ? $_SESSION["userId"] : null;
        $sql = "UPDATE users SET profile_picture = '$targetPath' WHERE id = $userId";
        $result_upload_picture = mysqli_query($conn, $sql);
        // Execute the SQL query
        // Replace $conn with your actual database connection variable
        if ($result_upload_picture === TRUE) {
            // Database update successful
            $responseMessage = "Picture uploaded successfully!";
        } else {
            // Database update failed
                $responseMessage = "Error updating password: " . mysqli_error($conn);
        }

        // Close the database connection
        $conn->close();
        } else {
            // File upload failed
            
                $responseMessage = "Error updating password: " . mysqli_error($conn);
        }
        $_SESSION["profileResponse"] = $responseMessage;
        header("Location: mypro.php");
        exit();

    } 

    ?>
