<?php
   ob_start();
   
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUlti.php'; 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php'; 
    session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>TechNews</title>
      <!-- Google font -->
      <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">
      <!-- Bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- Font Awesome Icon -->
      <link rel="stylesheet" href="/templates/public/css/font-awesome.min.css">
      <!-- Custom stlylesheet -->
      <link type="text/css" rel="stylesheet" href="/templates/public/css/style.css"/>
      <link type="text/css" rel="stylesheet" href="/templates/public/css/nuke.css"/>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="/library/ajax/ajax.js"></script>
      <script type="text/javascript" src="/library/ajaxCat/ajaxCat.js"></script>
      <script type="text/javascript" src="/library/ajaxPop/ajaxPop.js"></script>
      <script type="text/javascript" src="/library/ajaxCom/com.js"></script>
      <script type="text/javascript" src="/library/ajaxCom/comReply.js"></script>
      <script type="text/javascript" src="/library/ajaxCom/comU.js"></script>
      <style>
         .tab {
         overflow: hidden;
         background-color: transparent;
         }
         /* Style the buttons inside the tab */
         .tab button {
         background-color: inherit;
         float: left;
         border: none;
         outline: none;
         cursor: pointer;
         padding: 14px 16px;
         transition: 0.3s;
         font-size: 17px;
         }
         /* Change background color of buttons on hover */
         .tab button:hover {
         background-color: #ddd;
         }
         /* Create an active/current tablink class */
         .tab button.active {
         background-color: #ccc;
         }
         /* Style the tab content */
         .tabcontent {
         display: none;
         padding: 6px 12px;
         border-top: none;
         }
         /* Style the close button */
         .topright {
         float: right;
         cursor: pointer;
         font-size: 28px;
         }
         .container ul li {
			 position:relative;
         }
         .topright:hover {color: red;}
         <!--style slide-->

      </style>
   </head>
   <body>
      <!-- Header -->
      <header id="header">
         <!-- Nav -->
         <div id="nav">
            <!-- Main Nav -->
            <div id="nav-fixed">
               <div class="container">
                  <!-- logo -->
                  <div class="nav-logo">
                     <a href="/trang-chu" class="logo"><img src="/templates/public/img/Capture.PNG" alt=""></a>
                  </div>
                  <!-- /logo -->
                  <!-- nav -->
                  <ul class="nav-menu nav navbar-nav">
                     <li><a href="/trang-chu">Trang chủ</a></li>
                     <li><a href="/tin-pho-bien">Phổ biến</a></li>
                     <?php 
                        $queryCat = "select * from cat";
                        $resultCat  = $mysqli->query($queryCat);
                        
                        while($arCat = mysqli_fetch_assoc($resultCat))
                        {
                        	$parent_id = $arCat['parent_id'];
                        	$catID = $arCat['cat_id'];
                        	
                        	if($arCat['status']==1){
                        	if($parent_id==0){
                        		$queryTST = "select COUNT(*) as 'TST' FROM news n INNER JOIN cat c on n.cat_id=c.cat_id WHERE n.cat_id={$catID} or c.parent_id={$catID}";
                        		$resultTST  = $mysqli->query($queryTST);
                        		if($arTST = mysqli_fetch_assoc($resultTST)){
                        		
                        	$urlCat = '/cat/'.utf8ToLatin($arCat['name']).'-'.$catID;
                        ?>
                     <li>
                        <a href="<?php echo $urlCat?>"><?php echo $arCat['name']?></a>
                        <ul class="dropdown">
                           <?php 
                              $queryCat1 = "select * from cat where parent_id = {$catID}";
                              $resultCat1  = $mysqli->query($queryCat1);
                              while($arCat1 = mysqli_fetch_assoc($resultCat1)){
                              if($arCat1['status']==1){
                              $parent_id = $arCat1['cat_id'];
                              $queryTST2 = "select COUNT(*) as 'TST2' FROM news n INNER JOIN cat c on n.cat_id=c.cat_id WHERE n.cat_id={$parent_id} or c.parent_id={$parent_id}";
                              $resultTST2  = $mysqli->query($queryTST2);
                              if($arTST2 = mysqli_fetch_assoc($resultTST2)){
                              $urlCat1 = '/cat/'.utf8ToLatin($arCat1['name']).'-'.$parent_id;
                              ?>
                           <li>
                              <a href="<?php echo $urlCat1?>"  style="background: while;border:none"><?php echo $arCat1['name']?></a>
                           </li>
                           <?php }}}?>
                        </ul>
                     </li>
                     <?php }}}}
					
					 ?>
                  </ul>
                  <!-- /nav -->
				  <?php 
						if(isset($_POST['search'])){
							$s = $_POST['input'];
							header("location:/util/search.php?search=$s");
						}
						
				  ?>
                  <!-- search & aside toggle -->
                  <div class="nav-btns">
                     <button class="aside-btn"><i class="fa fa-bars"></i></button>
                     <button class="search-btn"><i class="fa fa-search"></i></button>
					 <?php
					 if(!isset($_SESSION['userinfo'])){
					 ?>
                     <a href="/util/login.php"><b>Đăng nhập</b></a>
					 <?php }else{?>
					 <a href="/util/logout.php"><b><?php echo $_SESSION['userinfo']['username']?></b></a>
					 <?php }?>
                     <div class="search-form">
						<form method="post">
                        <input id="myInput" class="search-input" type="text" name="input" style="height:69px;" placeholder="Enter Your Search ...">
                        <button class="search-close"><i class="fa fa-times"></i></button>
                        <button id="myBtn" class="search-close" name="search" style="top: 37px;position: absolute;right: 90px;"><span class="glyphicon glyphicon-search"></span></button>
						</form>
					 </div>
                  </div>
				  <script>
					var input = document.getElementById("myInput");
					input.addEventListener("keyup", function(event) {
						event.preventDefault();
						if (event.keyCode === 13) {
							document.getElementById("myBtn").click();
						}
					});	  
					</script>
                  <!-- /search & aside toggle -->
               </div>
            </div>
            <!-- /Main Nav -->
            <!-- Aside Nav -->
            <div id="nav-aside">
               <!-- nav -->
               <div class="section-row">
                  <ul class="nav-aside-menu">
                     <li><a href="/trang-chu">Trang chủ</a></li>
                     <li><a href="/lien-he">Liên hệ</a></li>
                  </ul>
               </div>
               <!-- /nav -->
               <!-- widget posts -->
               <div class="section-row">
                  <h3>Tin nổi bật</h3>
                  <?php
                     $queryTop1News = "select MAX(counter) as 'top1' from news";
                     $resultTop1News = $mysqli->query($queryTop1News);
                     $arTop1News = mysqli_fetch_assoc($resultTop1News);
                     $top1News = $arTop1News['top1'];
                     
                     $queryHotNews = "select * from news order by counter DESC limit 0,3";
                     $resultHotNews  = $mysqli->query($queryHotNews);
                     
                     
                     while($arHotNews = mysqli_fetch_assoc($resultHotNews))
                     {
                     $urlDetail = '/'.utf8ToLatin($arHotNews['name']).'-'.$arHotNews['news_id'].'.html';
                     ?>
                  <div class="post post-widget">
                     <a class="post-img" href="<?php echo $urlDetail?>"><img src="./files/<?php echo $arHotNews['picture']?>" alt=""></a>
                     <div class="post-body">
                        <h3 class="post-title"><a href="<?php echo $urlDetail?>"><?php echo $arHotNews['name']?></a></h3>
                     </div>
                  </div>
                  <?php }?>
               </div>
               <!-- /widget posts -->
               <!-- social links -->
               <div class="section-row">
                  <h3>Follow me</h3>
                  <ul class="nav-aside-social">
                     <li><a href="fb.com/phamxuannam97"><i class="fa fa-facebook"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                     <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                     <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                  </ul>
               </div>
               <!-- /social links -->
               <!-- aside nav close -->
               <button class="nav-aside-close"><i class="fa fa-times"></i></button>
               <!-- /aside nav close -->
            </div>
            <!-- Aside Nav -->
         </div>
         <!-- /Nav -->
      </header>
      <!-- /Header -->