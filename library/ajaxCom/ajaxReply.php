<?php
session_start();
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   	
   	$comId = $_POST['comId'];
   	$newsId = $_POST['newsId'];
   	$date_create = date('Y-m-d H:i:s');
   	
   	if(!isset($_SESSION['userinfo'])){
   			$name = $_POST['name'];
			$email = $_POST['email'];
			$message = $_POST['mess'];
   		$queryAddCom = "INSERT INTO comment(name,email,content,user_id,date_create,parent_id,news_id) 
   								VALUES('$name','$email','$message',0,'$date_create',$comId,$newsId)";
   		$resultAddCom = $mysqli->query($queryAddCom);
   	} 
	if(isset($_SESSION['userinfo'])){
			$name = $_SESSION['userinfo']['username'];
			$password = $_SESSION['userinfo']['password'];
			$message = $_POST['mess'];
   		$queryCheckUser = "select * from users where username = '$name' AND password = '$password'";
   		$resultCheckUser = $mysqli->query($queryCheckUser);
   		$arCheckUser = mysqli_fetch_assoc($resultCheckUser);
   		$user_id = $arCheckUser['user_id'];
   		$avatar = $arCheckUser['avatar'];
   		$queryAddComU = "INSERT INTO comment(name,email,content,user_id,date_create,parent_id,news_id) 
   							VALUES('$name','','$message',$user_id,'$date_create',$comId,$newsId)";
   			$resultAddComU = $mysqli->query($queryAddComU);
   		
   	}
   	
	if(!isset($_SESSION['userinfo'])){
   	echo	"<span>";
   	echo	"<div class='media'>";
   	echo		"<div class='media-left'>";
   	echo			"<img class='media-object' src='/files/User_img/avatar.png' alt=''>";
   	echo		"</div>";
   	echo		"<div class='media-body'>";
   	echo			"<div class='media-heading'>";
   	echo				"<h4>$name</h4>";
   	echo				"<span class='time'>$date_create</span>";
   	echo			"</div>";
   	echo			"<p>$message</p>";
   	echo		"</div>";
   	echo     "</div>";
   	echo	"</span>";
   } 	if(isset($_SESSION['userinfo'])){
   	echo	"<span>";
   	echo	"<div class='media'>";
   	echo		"<div class='media-left'>";
   	echo			"<img class='media-object' src='/files/User_img/$avatar' alt=''>";
   	echo		"</div>";
   	echo		"<div class='media-body'>";
   	echo			"<div class='media-heading'>";
   	echo				"<h4>$name</h4>";
   	echo				"<span class='time'>$date_create</span>";
   	echo			"</div>";
   	echo			"<p>$message</p>";
   	echo		"</div>";
   	echo     "</div>";
   	echo	"</span>";
	echo	$queryAddComU;
   }  else if($message==''){
   	 echo '<script>alert("Vui lòng nhập Nội dung trả lời!!!")</script>';
   }
   
   ?>