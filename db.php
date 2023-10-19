<?php

require_once 'connection.php';
require_once 'post_conn.php';

//Inserted data during login
@$username = $_POST["username"];
@$login_password =  $_POST["login_password"];


//Inserted data from client during registeration
@$firstname = $_POST["firstname"];
@$lastname =  $_POST["lastname"];
@$email =  $_POST["email"];
@$phonenumber =  $_POST["phonenumber"];
@$register_password =  $_POST["register_password"];
@$re_password =  $_POST["re_password"];

//This data is taken from cookies of client_id
@$sql = "SELECT * FROM register WHERE client_id =".$_COOKIE['client_id'];
@$result = $conn->query($sql);
@$row = mysqli_fetch_assoc($result);

@$name = $row["firstname"];  //The logged in username
@$lastname = $row["lastname"]; //The logged in lastname
@$client_id = $row["client_id"]; //The logged in client_id
@$client_username = $row["firstname"]." ".$row["lastname"];  //The logged in fullname


if(isset($_POST["Login"])){
    $sql = "SELECT * FROM register WHERE phonenumber = $username AND password = '$login_password'";
    $result = $conn->query($sql);
  
    if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        setcookie("client_id",$row["client_id"],time()+(86400*30),"/");
        $message = "Logged in successfully";
    }else{
        $message = "Please register first";
    }

    header('Location:home.php?message='.$message);
}


if(isset($_POST["register"])){

   if($register_password ===  $re_password){
      $sql = "INSERT INTO register(firstname,lastname,email,phonenumber,password) 
      VALUES('$firstname','$lastname','$email',$phonenumber,'$register_password')";

      if($conn->query($sql)){
          $message = "Your are registered";
      }else{
          $message = "Not registered";
      }
    }else{
        $message = "Your password is not matched";
    }

    header('Location:home.php?message='.$message);
}




if(isset($_POST["post_id"])){
    @$post_id = $_POST["post_id"];
    @$sql = "SELECT * FROM post_like WHERE post_id = $post_id and client_id = $client_id";
    @$result = @$conn_post->query($sql);

    if(@$result->num_rows > 0){ 
        //If it already liked the post the code in here is displayed
        $sql = "DELETE FROM post_like WHERE post_id = $post_id and client_id = $client_id";
        if($conn_post->query($sql) == true){
            $sql = "SELECT like_num FROM posts WHERE post_id = $post_id";
            $result = $conn_post->query($sql);
            while($row = mysqli_fetch_assoc($result)){
                $like_num = $row["like_num"]-1;
                $sql = "UPDATE posts SET like_num = $like_num WHERE post_id = $post_id";
                if($conn_post->query($sql)){
                    $total_num = "decreased";
                }
            }
        }
    }else{
        //If it doesn't liked the post the code in here is displayed
        $sql = "INSERT INTO post_like(post_id,client_id,client_name) 
        VALUES($post_id,$client_id,'$client_username')";

        if($conn_post->query($sql) == true){
           $sql = "SELECT like_num FROM posts WHERE post_id = $post_id";
           $result = $conn_post->query($sql);
           while($row = mysqli_fetch_assoc($result)){
               $like_num = $row["like_num"]+1;
               $sql = "UPDATE posts SET like_num = $like_num WHERE post_id = $post_id";
               if($conn_post->query($sql)){
                $total_num = "increased";
               }
           }
        }
        
    }

    echo $total_num;
    
}


if(isset($_POST["comment"])){
    $comment = $_POST["comment"];
    $post_id = $_POST["post_id"];

    //To comment on posts first we have to login
    $sql = "INSERT INTO comment(post_id,client_id,client_name,written_comment)
    VALUES($post_id,$client_id,'$client_username','$comment')";
    if($conn_post->query($sql) == true){
        $sql_num = "SELECT * FROM posts WHERE post_id = $post_id";
        $result = $conn_post->query($sql_num);
        $row = mysqli_fetch_assoc($result);
        $comment_num = $row["comment_num"]+1;
        $sql_update = "UPDATE posts SET comment_num = $comment_num WHERE post_id = $post_id";
        if($conn_post->query($sql_update)){
           $total_comment = $comment_num;
        }
    }

   $array = array($total_comment);
   echo json_encode($array); // this change the array to string array


}




?>