<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>My Profile</title>
            <link rel="stylesheet" href="myprofile.css">
            <!-- Include Bootstrap CSS (optional, if needed) -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">

        </head>

        <body>
            <div class="container-fluid">
                    <div class="container-fluid">
        <!-- Rest of your HTML content -->

        <!-- Logout link at the top right corner -->
        <a href="update_profile.php?logout=true" class="btn btn-info float-right mt-4 mr-2">Logout</a>
    </div>
                <div class="row">
                    <!-- Left Sidebar -->
                    <div class="col-md-3 mt-4">
                        <div class="list-group">
                            <a href="#basic-info" class="list-group-item list-group-item-action active" data-toggle="tab">Basic
                                Info</a>
                            <a href="#upload-photo" class="list-group-item list-group-item-action" data-toggle="tab">Upload
                                Photo</a>
                            <a href="#change-password" class="list-group-item list-group-item-action" data-toggle="tab">Change
                                Password</a>
                            <a href="#change-info" id="load_info" class="list-group-item list-group-item-action" data-toggle="tab">Change Info</a>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-md-9">
                        <!-- Your HTML structure -->
        <?php
            session_start();
            if(isset($_SESSION["profileResponse"]) && ($_SESSION["profileResponse"]!='')){ 
        ?>
            <div id="response-message" class="alert alert-success fade show" role="alert">
                <?php
                    echo $_SESSION["profileResponse"];
                    // Optionally, clear the session variable
                    unset($_SESSION["profileResponse"]);
                ?>
            </div>
        <?php } ?>

                        <h2 class="text-center mt-3">My Profile</h2>

                        <!-- Tab Content -->
                        <div class="tab-content mt-3">
                            <!-- Basic Info Tab -->
    <!-- Basic Info Tab -->

<div class="tab-pane fade show active" id="basic-info">
    <div class="text-center mt-3">
        <!-- Profile Picture Container with Fixed Size -->
        <div style="width: 200px; height: 200px; overflow: hidden; margin: 0 auto; border-radius: 50%;">
            <!-- Profile Picture -->
            <img src="" alt="Profile Picture" class="img-fluid" id="profile-image">
        </div>
    </div>

    <div class="text-center mt-3 mb-2">
        <!-- User Information -->
        <h4 id="username"></h4>
        <p style="text-align: left;"><strong>Email: </strong><span id="email"></span></p>
        <p style="text-align: left;"><strong>Phone Number:</strong> <span id="phoneNumber"></span></p>
    </div>

    <!-- Additional User Information -->
    <div class="row mt-4">
        <div class="col-md-6">
            <p><strong>Country:</strong> <span id="country"></span></p>
            <p><strong>State:</strong><span id="state"></span></p>
            <p><strong>City:</strong><span id="city"></span></p>
            <p><strong>Role:</strong><span id="role"></span></p>
        </div>
    </div>
</div>



    <!-- Upload Photo Tab -->
    <div class="tab-pane fade" id="upload-photo">
        <h5>Upload Profile Picture</h5>
            <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img src="default-avatar.jpg"  class="img-thumbnail mb-3" id="profile-image">
                    <form id="pictureForm" action="update_profile.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="profile-picture-input" class="mb-2">
                        <input type="hidden" name="form_type" value="upload_picture">
                        <button type="submit" class="btn btn-primary">Upload Picture</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



                            <!-- Change Password Tab -->
                            <div class="tab-pane fade" id="change-password">
                                <h5>Change Password</h5>
                                <form id="passwordForm" action="update_profile.php" method="post">
                                    <div class="form-group">
                                        <label for="current-password">Current Password</label>
                                        <input type="password" id="current-password" name="current-password"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password">New Password</label>
                                        <input type="password" id="new-password" name="new-password" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm New Password</label>
                                        <input type="password" id="confirm-password" name="confirm-password"
                                            class="form-control" required>
                                    </div>
                                    <input type="hidden" name="form_type" value="change_password">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </form>
                            </div>

                            <!-- Change Info Tab -->
                            <div class="tab-pane fade" id="change-info">
                                <h5>Change Info</h5>
                                <form id="infoForm" action="update_profile.php" method="post">
                                    <div class="form-group">
                                        <label for="name">Username</label>
                                        <input type="text" id="update_name" name="name" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="update_email" name="email" class="form-control"
                                            placeholder="Enter your email" required>
                                    </div>

                                    <div class="form-group">
                                        <select id="find_country" name="country" style="width: 100%">
                                            <option value="" disabled selected>Select your country</option>
                                            <option value="USA">United States</option>
                                            <option value="Australia">Australia</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select id="find_state" name="state" style="width: 100%">
                                            <option value="" disabled selected>Select your State</option>
                                            <!-- States will be dynamically populated based on selected country -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select id="find_city" name="city" style="width: 100%">
                                            <option value="" disabled selected>Select your City</option>
                                            <!-- Cities will be dynamically populated based on selected state -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select id="update_role" name="role" style="width: 100%">
                                            <option value="" disabled selected>Joining as</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Member">Member</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" id="update_phone" name="phone" class="form-control"
                                            placeholder="Enter Phone Number">
                                    </div>

                                    <input type="hidden" name="form_type" value="update_info">
                                    <button type="submit" class="btn btn-primary" name="save_changes">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Bootstrap JS (optional, if needed) -->
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Your existing script for the profile page -->
            <script>

            $(document).ready(function () {

            $('#basic-info').trigger('click');

            $('#find_country').change(function () {
            var country = $(this).val();
            if (country) {
                $.ajax({
                    url: 'process.php', // URL to your backend script
                    type: 'POST',
                    data: { country: country },
                    success: function (response) {
                        $('#find_state').html(response);
                        $('#find_city').html('<option value="">Select City</option>'); // Clear city dropdown
                    }
                });
            } else {
                $('#find_state').html('<option value="">Select State</option>'); // Clear state dropdown
                $('#find_city').html('<option value="">Select City</option>'); // Clear city dropdown
            }
        });


        $('#find_state').change(function () {
            var state = $(this).val();
            if (state) {
                $.ajax({
                    url: 'process.php', // URL to your backend script
                    type: 'POST',
                    data: { state: state },
                    success: function (response) {
                        $('#find_city').html(response);
                    }
                });
            } else {
                $('#find_city').html('<option value="">Select City</option>'); // Clear city dropdown
            }
        });
                        // Event listener for the "Change Info" tab click
                        $('#info-tab').click(function () {
                            // Debugging statement to check if the event is triggered
                            console.log("Change Info tab clicked");

                            // Send an AJAX request to fetch user information
                            $.ajax({
                                url: 'update_profile.php',
                                type: 'GET',
                                dataType: 'json',
                                success: function (userData) {
                                    // Debugging statement to check if this block is executed
                                    console.log("User data:", userData);

                                    // Update the form fields with the fetched data
                                    $('#name').val(userData.name);
                                    $('#email').val(userData.email);
                                    $('#phone').val(userData.phone);
                                },
                                error: function (error) {
                                    // Debugging statement to check if there's an error
                                    console.error('Error fetching user information:', error);

                                    // Handle the error or display an error message
                                    alert('Error fetching user information. See console for details.');
                                }
                            });
                        });

                        // Event listener for the "Change Password" form submission
                        $('#passwordForm').submit(function (event) {
                            // Retrieve the values from the password fields
                            var newPassword = $('#new-password').val();
                            var confirmPassword = $('#confirm-password').val();

                            // Compare the passwords
                            if (newPassword !== confirmPassword) {
                                // Display an alert if passwords do not match
                                alert("Passwords do not match. Please re-enter.");
                                // Prevent the form submission
                                event.preventDefault();
                            }
                        });

                        // Event listener for the "Change Info" form submission
$('#infoForm').submit(function (event) {
    // Check if form data is empty or null
    if (
        $('#update_name').val() === null ||
        $('#update_email').val() === null ||
        $('#update_phone').val() === null ||
        $('#update_role').val() === null ||
        $('#find_country').val() === null ||
        $('#find_state').val() === null ||
        $('#find_city').val() === null
    ) {
        alert("Please fill all required fields");
        event.preventDefault(); // Prevent the default form submission
    } else {
        // Your existing code to submit the form
    }
});


                        // Event listener for the left sidebar links
                        $('.list-group-item').on('click', function (e) {
                            e.preventDefault();

                            // Remove the 'active' class from all tabs
                            $('.list-group-item').removeClass('active');

                            // Add the 'active' class to the clicked tab
                            $(this).addClass('active');

                            // Get the target tab from the href attribute
                            var targetTab = $(this).attr('href');

                            // Show the target tab
                            $(targetTab).tab('show');
                            $('.tab-pane').not(targetTab).removeClass('show active');
                        });

                        // Initial load: Show Basic Info tab
                        $('#basic-info').tab('show');

                        // Event listener for the "Change Info" tab click
                        $('#load_info').click(function () {
                            // Debugging statement to check if the event is triggered
                            console.log("Change Info tab clicked");

                            // Send an AJAX request to fetch user information
                            $.ajax({
                                url: 'update_profile.php',
                                type: 'GET',
                                dataType: 'json',
                                success: function (userData) {
                                    // Debugging statement to check if this block is executed
                                    console.log("User data:", userData);

                                    // Update the form fields with the fetched data
                                    $('#update_name').val(userData.Username);
                                    $('#update_email').val(userData.Email);
                                    $('#update_phone').val(userData.Phone);
                                },
                                error: function (error) {
                                    // Debugging statement to check if there's an error
                                    console.error('Error fetching user information:', error);

                                    // Handle the error or display an error message
                                    alert('Error fetching user information. See console for details.');
                                }
                            });
                        });

                        // Event listener for the "Change Password" tab click
                        $('#change-password-link').click(function () {
                            // Debugging statement to check if the event is triggered
                            console.log("Change Password tab clicked");
                        });

                        // Event listener for the "Change Password" form submission
                        $('#passwordForm').submit(function (event) {
                            // Retrieve the values from the password fields
                            var newPassword = $('#new-password').val();
                            var confirmPassword = $('#confirm-password').val();

                            // Compare the passwords
                            if (newPassword !== confirmPassword) {
                                // Display an alert if passwords do not match
                                alert("Passwords do not match. Please re-enter.");
                                // Prevent the form submission
                                event.preventDefault();
                            }
                        });


                setTimeout(function () {
                $("#response-message").fadeOut("slow");
            }, 5000);

        

                    });
            function fetchUserData() {
        // AJAX code to fetch data
        $.ajax({
            url: 'update_profile.php',
            type: 'GET',
            dataType: 'json',
            success: function (userData) {
                // Update the content with the fetched data
                $('#profile-image').attr('src', userData.profile_picture);
                $('#username').text(userData.Username);
                $('#email').text(userData.Email);
                $('#phoneNumber').text(userData.Phone);
                $('#country').text(userData.Country);
                $('#state').text(userData.State);
                $('#city').text(userData.City);
                $('#role').text(userData.role);
            },
            error: function (error) {
                console.error('Error fetching user information:', error);
                // Handle the error or display an error message
            }
        });
    }

    // Call the function to fetch user data when the tab is clicked
    $('#basic-info').on('click', function () {
        fetchUserData();
    });

        </script>


        </body>

        </html>