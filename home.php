<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Login or Register</title>
</head>
<body>
    <?php
        require_once 'header.php';

   ?>

   <main>

       <!-- For login section -->
       <div class="login">
           <h1>Login</h1>
           <form action="db.php" method="post">
               <input type="text" name="username" id="username" placeholder="Mobile Number" required>
               <input type="password" name="login_password" id="login_password" placeholder="Password" required>
               <input type="submit" name="Login" value="Login">
           </form>
       </div>

       <!-- For registeration section -->
        <div class="register">
            <h1>Register</h1>
           <form action="db.php" method="post">
           <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="text" name="phonenumber" id="phonenumber" placeholder="Mobile Name" required>
            <input type="password" name="register_password" id="register_password" placeholder="Password" required>
            <input type="password" name="re_password" id="re_password" placeholder="re_type password" required>
            <input type="submit" name="register" id="register" value="Register">
           </form>
        </div>



   </main>

   <footer>
       <div id="message">
           <span><?php 
           if(@$_GET["message"] != null){
            echo @$_GET["message"];
           }
           
           ?></span>
       </div>
   </footer>
</body>
</html>