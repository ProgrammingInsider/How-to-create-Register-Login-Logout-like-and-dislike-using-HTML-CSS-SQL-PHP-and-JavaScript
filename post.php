<?php

require_once 'post_conn.php';
@$view_all = $_GET["view_all"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel="stylesheet" href="post.css">
    <title>post page</title>
</head>
<body>
    <?php
       require_once 'header.php';

    ?>
    <main>
        <?php
           $sql = "SELECT * FROM posts";
           $result = $conn_post->query($sql);
  
            while($row = mysqli_fetch_assoc($result)){

           ?>
        <div class="post_card">
            <div class="header">
                <div class="profile_image"><?php echo $row["client_name"][0]; ?></div>
            <div class="header_name">
                <div><h3><?php echo $row["client_name"]; ?></h3><span>is with</span><h3><?php echo $row["tag_name"]; ?></h3></div>
                <p>53m</p>
            </div>
            </div>
       

       <div class="image">
           <img src="<?php echo $row["post_image"]; ?>">
       </div>
       
       <div class="reaction">
           <div class="status">
               <div id="like_num<?php echo $row["post_id"]; ?>"><?php echo $row["like_num"]; ?></div>
               <div id="comment_num<?php echo $row["post_id"]; ?>"><?php 
                 if($row["comment_num"] >0){
                    echo $row["comment_num"]." comments";
                 }
                ?>
               </div>
           </div>

           <div class="icons">
               <?php
                   $post_id = $row['post_id'];
                   @$sql_like = "SELECT * FROM post_like WHERE post_id = $post_id and client_id = $client_id";
                   @$like_check = $conn_post->query($sql_like);
                   if(@$like_check->num_rows == 0){
                       $like_status = "like";
                   }else{
                      $like_status = "liked";
                   }
               ?>
               <div  onclick="like(<?php echo $row['post_id']; ?>)" class="<?php echo $like_status; ?>"><i id="thumb<?php echo $row["post_id"]; ?>" class="fas fa-thumbs-up"></i>&nbsp; Like </div>
               <div><i class="far fa-comment-alt"></i>&nbsp; Comment <?php 
                 if($row["comment_num"] >0){
                    echo $row["comment_num"];
                 }
                ?></div>
               <div><i class="fas fa-share"></i>&nbsp; Share</div>
           </div>
       </div>

       <div class="comment_section">
           <form action="post.php">
               <input type="text" name="comment" data-id="<?php echo $row["post_id"]; ?>" class="write_comment" placeholder="Write Comment">
               <button class="send_comment"><i class="fas fa-paper-plane"></i></button>
           </form>
       </div>

       <div class="reply">
           <?php
           if($view_all == $row["post_id"]){
            @$sql_comment = "SELECT * FROM `comment` ORDER BY comment_id DESC";
            @$result_comment = $conn_post->query($sql_comment);
           }else{
            @$sql_limit = "SELECT * FROM `comment` ORDER BY comment_id DESC LIMIT 3";
            @$result_comment = $conn_post->query($sql_limit);
           }

               while(@$row_comment = mysqli_fetch_assoc($result_comment)){
                  if(@$row_comment["post_id"] == $row["post_id"]){
           ?>
           <div class="each_reply">
               <div class="comment_image"><?php echo @$row_comment["client_name"][0]; ?></div>
               <div class="comment_note">
                <h3><?php echo @$row_comment["client_name"]; ?></h3>
                <div class="comment"><?php echo @$row_comment["written_comment"]; ?></div>
               </div>
               
           </div>
           <?php
                  }
               }
           ?>
           <a href="post.php?view_all=<?php echo $row["post_id"]; ?>" class="see_all">See all</a>
       </div>
    </div>
    
<?php    
}

?>

    </main>


    <script src="post.js"></script>
</body>
</html>