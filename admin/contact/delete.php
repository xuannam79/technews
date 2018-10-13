<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/ulti/DBConnectionUtil.php'; 
	if(isset($_GET['iddele'])) {
	$id = $_GET["iddele"];
	$querydele="DELETE FROM contact WHERE contact_id = {$id}";
	$result2 = $mysqli->query($querydele);
	if($result2){
				header("location:index.php?tab=6&msg=Xóa Thành Công!");
	} else {
			header("location:index.php?tab=6&msg=Xóa Thất Bại!");
	}
	}
?>