<?php 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   
   if(isset($_GET['iddele'])) {
   	$id = $_GET["iddele"];
   	$queryCat="select * from cat WHERE cat_id = {$id}";
   	$resultCat = $mysqli->query($queryCat);
   	$arCat = mysqli_fetch_assoc($resultCat);
   	$parent_id = $arCat['parent_id'];
   	
   	if($parent_id!=0){
   		$querydele="DELETE FROM cat WHERE cat_id = {$id}";
   	}else{
   		$querydele="DELETE FROM cat WHERE parent_id = {$id} OR cat_id = {$id}";
   	}
   	$result2 = $mysqli->query($querydele);
   	if($result2){
   				header("location:index.php?tab=2&msg=Xóa Thành Công!");
   	} else {
   			header("location:index.php?tab=2&msg=Xóa Thất Bại!");
   	}
   }
   ?>