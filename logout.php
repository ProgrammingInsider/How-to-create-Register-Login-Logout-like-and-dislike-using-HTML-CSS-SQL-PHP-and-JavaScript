<?php

setcookie("client_id","",time()-(86400*30),"/");
header("Location:home.php");


?>