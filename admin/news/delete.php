<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
	if(isset($_GET['iddele'])) {
		$id = $_GET["iddele"];
		
		$query = "SELECT p.*,c.name as 'danhmuc' FROM `news` p INNER JOIN `cat` c ON c.cat_id = p.cat_id WHERE news_id = {$id}";
		$result = $mysqli->query($query);
		$arSto = mysqli_fetch_assoc($result);
		
		$querydele="DELETE FROM news WHERE news_id = {$id}";
		$result2 = $mysqli->query($querydele);
		
		$patch_upload1 = $_SERVER['DOCUMENT_ROOT'].'/files/'.$arSto['picture'];
		unlink($patch_upload1);	
		if($result2){
			
			header("location:index.php?tab=3&msg=Xóa Thành Công!");
		} 
		else {
				header("location:index.php?tab=3&msg=Xóa Thất Bại!");
		}
	}
	
?>
