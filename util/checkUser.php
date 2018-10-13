<?php
	if(!isset($_SESSION['userinfo']))
	{
		header("location:/admin/auth/login.php");
		return;
	}
?>