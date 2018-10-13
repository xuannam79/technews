<?php
session_start();
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   	$name = $_SESSION['userinfo']['username'];
   	$pass = $_SESSION['userinfo']['password'];
   	$message = $_POST['messageU'];
   	$mess=nl2br($message);
   	$id = $_POST['id'];
   	$date_create = date('Y-m-d H:i:s');
   	if($name!='' && $pass!='' && $mess!=''){
   	$queryCheckUser = "select * from users where username = '$name' AND password = '$pass'";
   	$resultCheckUser = $mysqli->query($queryCheckUser);
   	$arCheckUser = mysqli_fetch_assoc($resultCheckUser);
   	$user_id = $arCheckUser['user_id'];
   	$avatar = $arCheckUser['avatar'];
   	if($resultCheckUser){
   		$queryAddCom = "INSERT INTO comment(name,email,content,user_id,date_create,parent_id,news_id) 
   						VALUES('$name','','$message',$user_id,'$date_create',0,$id)";
   		$resultAddCom = $mysqli->query($queryAddCom);
   	}
   	}
   
    if($mess==''){
   	echo '<script>alert("Vui lòng nhập nội dung Bình luận !!!")</script>';
   }else{
   	echo "<span>";
   	echo "<div class='media-left'>";
   	echo	"<img class='media-object' src='/files/User_img/$avatar' alt=''>";
   	echo "</div>";
   	echo "<div class='media-body'>";
   	echo	"<div class='media-heading'>";
   	echo		"<h4>$name</h4>";
   	echo		"<span class='time'>$date_create</span>";
   	echo		"<a href='#' class='reply'>Trả lời</a>";
   	echo 	"</div>";
   	echo 	"<p>$mess</p>";
   	echo "</div>";
   	echo "</span>";	
   }
   
   ?>