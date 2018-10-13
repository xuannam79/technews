<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   	$name = $_POST['name'];
   	$email = $_POST['email'];
   	$message = $_POST['message'];
   	$mess=nl2br($message);
   	$id = $_POST['id'];
   	$date_create = date('Y-m-d H:i:s');
   	if($name!='' && $email!=''){
   	$queryAddCom = "INSERT INTO comment(name,email,content,user_id,date_create,parent_id,news_id) VALUES('$name','$email','$message',0,'$date_create',0,$id)";
   	$resultAddCom = $mysqli->query($queryAddCom);
   	}
   	
   	if($name!='' && $email!=''){
   	echo "<span>";
   	echo "<div class='media-left'>";
   	echo	"<img class='media-object' src='/files/User_img/avatar.png' alt=''>";
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
   	}else{
   		echo '<script>alert("Vui lòng nhập đầy đủ tên và email !!!")</script>';
   	}
   ?>