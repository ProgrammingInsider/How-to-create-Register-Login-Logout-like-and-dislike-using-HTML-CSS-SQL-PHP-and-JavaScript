<?php

$servername = "localhost";
$username = "";
$password = "";
$post_db_name = "social_media";

$conn_post = new mysqli($servername,$username,$password,$post_db_name);

if($conn_post == true){
  //echo "Connected succesfully";
}



?>