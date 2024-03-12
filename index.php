<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="">

  <style>
    /* Import Google font - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  height: fit-content;
  width: 100%;
  background: #4682B4;
}
.container{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  max-width: 430px;
  width: 100%;
  background: #fff;
  border-radius: 7px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.3);
}
.container .form{
  padding: 2rem;
}
header{
  font-size: 1.7rem;
  font-weight: 500;
  text-align: center;
  margin-bottom: 1.0rem;
} 
 .form input{
   height: 50px;
   width: 100%;
   padding: 0 15px;
   font-size: 17px;
   margin-bottom: 0.8rem;
   border: 1px solid #ddd;
   border-radius: 6px;
   outline: none;
 }
 .form input:focus{
   box-shadow: 0 1px 0 rgba(0,0,0,0.2);
 }
.form a{
  font-size: 16px;
  color: #009579;
  text-decoration: none;
}
.form a:hover{
  text-decoration: underline;
}
.form input.button{
  color: #fff;
  background: #4682B4;
  font-size: 1.2rem;
  font-weight: 500;
  letter-spacing: 1px;
  margin-top: 0.8rem;
  cursor: pointer;
  transition: 0.4s;
}
.form input.button:hover{
  background:  #009579;
}
#country {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}
#state {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}
#city {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}
#role {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}
</style>


</head>
<body>
  <div class="container">
    <div class="registration form">
      <header>Signup</header>
      <form action="process.php" method="post">
        <input type="text" name="name" placeholder="Username">
        <input type="text" name="email" placeholder="Enter your email" required>
        <select id="country" name="country">
          <option value="" disabled selected>Select your country</option>
          <option value="USA">United States</option>
          <option value="Australia">Australia</option>
          
        </select>
        <select id="state" name="state">
          <option value="" disabled selected>Select your State</option>
          <!-- States will be dynamically populated based on selected country -->
        </select>
        <select id="city" name="city">
          <option value="" disabled selected>Select your City</option>
          <!-- Cities will be dynamically populated based on selected state -->
        </select>
        <select id="role" name="role">
          <option value="" disabled selected>Joining as</option>
          <option value="Admin">Admin</option>
          <option value="Member">Member</option>
          
        </select>
        <input type="tel" name="phone" placeholder="Enter Phone Number">
        <input type="password" name="password" placeholder="Create a password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" class="button" name="signup" value="Signup">
      </form>
      <div class="signup">
      <a href="login.html">Already have an account? Login here</a>

      </div>
    </div>
  </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#country').change(function(){
        var country = $(this).val();
        if(country){
          $.ajax({
            url: 'process.php', // URL to your backend script
            type: 'POST',
            data: {country: country},
            success: function(response){
              $('#state').html(response);
              $('#city').html('<option value="">Select City</option>'); // Clear city dropdown
            }
          });
        } else {
          $('#state').html('<option value="">Select State</option>'); // Clear state dropdown
          $('#city').html('<option value="">Select City</option>'); // Clear city dropdown
        }
      });

      $('#state').change(function(){
        var state = $(this).val();
        if(state){
          $.ajax({
            url: 'process.php', // URL to your backend script
            type: 'POST',
            data: {state: state},
            success: function(response){
              $('#city').html(response);
            }
          });
        } else {
          $('#city').html('<option value="">Select City</option>'); // Clear city dropdown
        }
      });
    });
  </script>