<?php

require_once 'connection.php';

@$sql = "SELECT * FROM register WHERE client_id =".$_COOKIE['client_id'];
@$result = $conn->query($sql);
@$row = mysqli_fetch_assoc($result);

@$name = $row["firstname"];
@$lastname = $row["lastname"];
@$client_id = $row["client_id"]; // taken from cookies
@$client_username = $row["firstname"]." ".$row["lastname"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    
   <header>
       <a href="post.php"><h1>Logo</h1></a>
       <a href="post.php" id="home">Home</a>
       <div class="account_controls">
           <a href="home.php">Login/register</a>
           <a href="logout.php">Logout</a>
       </div>
   </header>

   <b><?php echo @$name; ?></b>
</body>
</html>