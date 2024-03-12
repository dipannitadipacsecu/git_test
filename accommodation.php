<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('accommodation.jpg'); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="">
    <div class="p-5 h-screen">
        <h1 class="text-3xl mb-6">Recent Updates from Tenants</h1>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full absolute top-0 right-0 mt-4 mr-4" id="button">
            Add Rental Info
        </button>
        <button class="bg-blue-500 hover:bg-blue-700 text-center text-white font-bold py-1 px-4 rounded-full absolute top-0 right-0 mt-4 mr-44" id="Home">
            Home
        </button>

        <div class="overflow-auto rounded-lg shadow hidden md:block">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="w-24 p-3 text-sm text-xl font-semibold tracking-wide text-left">Apartment No.</th>
                        <th class="w-24 p-3 text-sm text-xl font-semibold tracking-wide text-left">Street No.</th>
                        <th class="w-24 p-3 text-sm text-xl font-semibold tracking-wide text-left">City</th>
                        <th class="w-32 p-3 text-sm text-xl font-semibold tracking-wide text-left">Rent</th>
                        <th class="w-24 p-3 text-sm text-xl font-semibold tracking-wide text-left">Phone</th>
                        <th class="w-24 p-3 text-sm text-xl font-semibold tracking-wide text-left">Address</th>
                        <th class="w-24 p-3 text-sm text-xl font-semibold tracking-wide text-left">Details</th>
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

    <td class="p-3 text-base text-black whitespace-nowrap"><?php echo trim($item['apartment_no'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['street_no'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['city'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['rent'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['phone'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['address'])?></td>
    <td class="p-3 text-base text-black-700 whitespace-nowrap"><?php echo trim($item['details'])?></td>

</tr>
<?php } ?> 

                </tbody>
            </table>
        </div>


    </div>
    <script>
        document.getElementById('button').addEventListener('click', function() {
            window.location.href = 'form.php';
        });
        document.getElementById('Home').addEventListener('click', function() {
            window.location.href = 'dashboard.php';
        });
    </script>
</body>

</html>
