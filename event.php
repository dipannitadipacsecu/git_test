<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('event.jpg'); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="">
    <div class="p-5 h-screen">
        <h4 class="text-center font-semibold text-xl mb-2">Upcoming Events</h4>


    <?php    if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') { ?>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full absolute top-0 right-0 mt-4 mr-4" id="button">
            Create Event
        </button>
    <?php }?>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full absolute top-0 right-0 mt-4 mr-44" id="Home">
            Home
        </button>

        <div class="overflow-auto rounded-lg shadow hidden md:block">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Event Name</th>
                        <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Place</th>
                        <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">Time</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Date</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">City</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Description</th>
                        
                    </tr>
                </thead>
                <?php
// Retrieve serialized row data from URL parameters
$serialized_row = $_SERVER['QUERY_STRING'];

// Decode serialized row data
$row = [];
parse_str($serialized_row, $row);

// Display data
foreach ($row as $item) {?>
    <tr class="bg-white">

    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['E_Name'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['Place'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['Time'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['Date'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['City'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['Description'])?></td>

</tr>
<?php } ?> 

                </tbody>
            </table>
        </div>


    </div>
    <script>
        var buttonElement = document.getElementById('button');
        if (buttonElement) {
            // If it exists, add the event listener
            buttonElement.addEventListener('click', function() {
                window.location.href = 'eventform.html';
            });
        }

        document.getElementById('Home').addEventListener('click', function() {
            window.location.href = 'dashboard.php';
        });
    </script>
</body>

</html>
