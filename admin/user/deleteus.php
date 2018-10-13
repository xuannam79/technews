<?php 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   if(isset($_GET['iddele'])) {
   $id = $_GET["iddele"];
   $query = "SELECT * FROM users WHERE user_id = ".$id;
   $result = $mysqli->query($query);
   $arUser = mysqli_fetch_assoc($result);
   
   $patch_upload1 = $_SERVER['DOCUMENT_ROOT'].'/files/User_img/'.$arUser['avatar'];
   unlink($patch_upload1);	
   	
   if($arUser['username'] == 'admin' || $_SESSION['userinfo']['username']=='admin'){
   	header("location: index.php?msg=Bạn không có quyền sủa admin");
   	die();
   }
   $querydele="DELETE FROM users WHERE user_id = {$id}";
   $result2 = $mysqli->query($querydele);
   if($result2){
   			header("location:index.php?tab=4&msg=Xóa Thành Công!");
   			die();
   } else {
   		header("location:index.php?msg=Xóa Thất Bại!");
   		die();
   }
   }
   ?>