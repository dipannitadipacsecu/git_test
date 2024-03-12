<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    <title>Restaurant Finder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('vorta.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* Set minimum height of the body to full viewport height */
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5); /* Lighten the background image */
            z-index: -1; /* Move the pseudo-element behind other content */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            /* background-color: rgba(255, 255, 255, 0.9); */
            /* border-radius: 10px; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); */
            position: relative;
            z-index: 2;
            margin-bottom: 90px; /* Add margin to the bottom to accommodate the footer */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            
            padding: 10px 20px;
            text-align: center;
        } */

        @media only screen and (max-width: 600px) {
            input[type="text"] {
                width: 100%;
            }
        }

        /* Style for the button */
        .top-right-button {
            position: absolute;
            top: 20px;
            /* right: 18px; */
            right: 46px;

            margin: 12px ;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 2; /* Ensure the button is above other content */
        }

       

        #button {
            right: 159px; 
            /* Update position to avoid overlap  159*/
        }

        /* Style for the home button */
        #homeButton {
            right: 20px;
        }

        /* .table-container {
            
            margin: 0 auto; 
            max-width: 1200px; 
            padding: 20px;
        } */

        .table-container {
            
            margin: 0 59px; /* Center the table horizontally with a left and right margin of 20px */
            max-width: 800px; /* Set maximum width for the table container to accommodate the margins */
            padding: 20px;
            display: block;
}
    </style>
</head>

<body>

     <?php 
     if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') { ?>
    <button  id="button" class="top-right-button">Update Restaurants</button>
    <?php }?>
    <button id="homeButton" class="top-right-button" style="right: 91px;">Home</button>

    <div class="container">
        <h1>Find Restaurants Near You</h1>
        <form id="searchForm" action="food_update.php" method="post">
            <input type="text" id="location" name="location" placeholder="Enter your location">
            <input type="hidden" name="form_type" value="search_restaurant">
            <input type="submit" value="Search">
        </form>
        <ul id="restaurantList"></ul>
        <div class="table-container">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Restaurant Name</th>
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Cuisine Type</th>
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Address</th>
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Country</th>
                        <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">City</th>
                        <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">State</th>
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Phone</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                <?php
                // Retrieve serialized row data from URL parameters
                $serialized_row = $_SERVER['QUERY_STRING'];

                // Decode serialized row data
                $row = [];
                parse_str($serialized_row, $row);
                // Display data

                foreach ($row as $item) {?>
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><?php echo isset($item['R_Name']) ? trim($item['R_Name']) : '' ?></td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><?php echo isset($item['Type']) ? trim($item['Type']) : '' ?></td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><?php echo isset($item['Address']) ? trim($item['Address']) : '' ?></td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><?php echo isset($item['Country']) ? trim($item['Country']) : '' ?></td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><?php echo isset($item['City']) ? trim($item['City']) : '' ?></td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><?php echo isset($item['State']) ? trim($item['State']) : '' ?></td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><?php echo isset($item['Phone']) ? trim($item['Phone']) : '' ?></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>
    </div>

    <!-- <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <p>Email: example@example.com</p>
                    <p>Phone: 123-456-7890</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Your Website. All Rights Reserved.</p>
                <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            </div>
        </div>
    </footer> -->

    <script>
        var buttonElement = document.getElementById('button');
        if (buttonElement) {
            // If it exists, add the event listener
            buttonElement.addEventListener('click', function() {
                window.location.href = 'res_form.php';
            });
        }

        document.getElementById('homeButton').addEventListener('click', function() {
            window.location.href = 'dashboard.php';
        });
    </script>
</body>

</html>