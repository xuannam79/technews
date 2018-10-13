<?php
   session_start();
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   ob_start();
   if(isset($_SESSION['userinfo'])){
   	unset($_SESSION['userinfo']);
   	header('location:/trang-chu');
   }
   ob_end_flush();
   ?>