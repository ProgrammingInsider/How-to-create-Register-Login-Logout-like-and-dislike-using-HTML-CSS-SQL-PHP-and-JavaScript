function like(value){
    var thumb = document.getElementById("thumb"+value);
    var like_num = document.getElementById("like_num"+value);
    var like_value = parseInt(document.getElementById("like_num"+value).innerHTML);  //this string; to change into int use parseInt()
//ajaxa code
var xml =  new XMLHttpRequest();
xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        var reply = this.responseText;
        if(reply == "increased"){
           like_num.innerHTML = like_value+1;
           thumb.style.color = "#1971ED";
        }else{
            like_num.innerHTML = like_value-1;
            thumb.style.color = "white";
        }
    }
}

xml.open("POST","db.php",true);
xml.setRequestHeader("content-type","application/x-www-form-urlencoded");
xml.send("post_id="+value);





}


var comment = document.getElementsByClassName("write_comment");

for(var i=0; i<comment.length; i++){
    comment[i].addEventListener("change",function(event){
        var target = event.target;
        var written_comment = target.value; // Here is written comment 
        var post_id = target.getAttribute("data-id"); //Here is the post id comment written for

        //ajax code to store the comment on databas

        var xml = new XMLHttpRequest;
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
               var value = JSON.parse(this.responseText)  // this the send data from database through ajax
               // JSON.parse is used to change array string or object string to normal JavaScript array
               //So reply is now array type
               document.getElementById("comment_num"+post_id).innerHTML = value[0]+" comments";
            }
        }

        xml.open("POST","db.php",true);
        // for post method we have to add the following
        xml.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xml.send("comment="+written_comment+"&post_id="+post_id);
      
       
    });
}