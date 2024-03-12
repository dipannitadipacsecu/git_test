<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
   <link rel="stylesheet" href="styles/buttons.css">
   <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  
  <body>
    
    <div class="bg-[url('backg.png')] bg-center bg-cover w-screen h-screen" >
    <!-- <div class="container-fluid">
        <a href="update_profile.php?logout=true" class="btn btn-info float-right mt-4 mr-4">Logout</a>
    </div> -->

      <nav class="flex items-center">
        <ul class="flex-1 text-center">
          
    <?php
    session_start();
    $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';
    $accommodation = 'accommodation';
    $profile = 'profile';
    $food = 'food';
    $event = 'event';
    $url = "acc_update.php?userId=$userId&word=$accommodation";
    $url1 = "mypro.php?userId=$userId&word=$profile";
    $url2 = "restaurant.php?userId=$userId&word=$food";
    $url3 = "event_update.php?userId=$userId&word=$event";
    ?>
     <li class="list-none inline-block px-20 py-6">
    <a href="<?php echo $url; ?>" class="no-underline text-white text-2xl font-bold" id="accommodation"> ACCOMMODATION </a>
</li>


          <li class="list-none inline-block px-20 py-6">
            <a href="<?php echo $url2; ?>" class="no-underline text-white text-2xl font-bold" id="food">  RESTAURANTS </a> 
          </li>
          <li class="list-none inline-block px-20 py-6">
            <a href="<?php echo $url3; ?>" class="no-underline text-white text-2xl font-bold" id="event">  EVENTS</a> 
          </li>
           <li class="list-none inline-block px-20 py-6">
            <a href="<?php echo $url1; ?>" class="no-underline text-white text-2xl font-bold" id="profile"> MyProfile </a>
           </li>
      </ul>
      </nav>

      <div class="text-white	 mt-64">
        <h1 class="font-serif text-8xl font-bold leading-normal text-center">Probash-Bondhu</h1>
      <p class="font-serif font-bold leading-normal text-center text-2xl py-72">Connecting via our roots,<br>
    This is a community to help each other on a foreign land.<br>
    In this community,Feel free to help each other to acheive individual goals.</p>

      </div>


    </div>

    

  </body>
</html>




