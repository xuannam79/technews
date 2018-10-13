<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
   ?>
<div class="clearfix visible-md visible-lg"></div>
<br/>
<div class="slide">
   <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators" style="top:425px">
         <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
         <li data-target="#myCarousel" data-slide-to="1"></li>
         <li data-target="#myCarousel" data-slide-to="2"></li>
         <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox" style="width: 60%;margin:auto;">
         <?php
		
            $queryTop1News = "select MAX(counter) as 'top1' from news";
            $resultTop1News = $mysqli->query($queryTop1News);
            $arTop1News = mysqli_fetch_assoc($resultTop1News);
            $top1News = $arTop1News['top1'];
            
            $queryHotNews = "select n.*,c.name as 'catname', c.color as 'catcolor' from news n inner join cat c on n.cat_id=c.cat_id order by counter DESC limit 0,4";
            $resultHotNews  = $mysqli->query($queryHotNews);
            
            while($arHotNews = mysqli_fetch_assoc($resultHotNews))
            {
				$newsid = $arHotNews['news_id'];
				$queryTSCM = "SELECT COUNT(news_id) as TSCM from comment WHERE news_id=$newsid";
				$resultTSCM = $mysqli->query($queryTSCM);
				$arTSCM = mysqli_fetch_assoc($resultTSCM);
				
				
            	$urlDetail = '/'.utf8ToLatin($arHotNews['name']).'-'.$arHotNews['news_id'].'.html';
            	$active = '';
            	
            	if($arHotNews['counter']==$top1News)
            	{
            		$active = 'active';
            	}
            	$urlCat = '/cat/'.utf8ToLatin($arHotNews['catname']).'-'.$arHotNews['cat_id'];
            ?>
         <div class="item <?php echo $active?>">
            <div class="post post-thumb">
               <a class="post-img" href="<?php echo $urlDetail?>"><img src="/files/<?php echo $arHotNews['picture']?>" alt="" width=759 height=455></a>
               <div class="post-body" style="margin-bottom:30px">
                  <div class="post-meta">
                     <a class="post-category cat-<?php echo $arHotNews['catcolor']?>" href="<?php echo $urlCat?>"><?php echo $arHotNews['catname']?></a>
                     <span class="post-date"><?php echo $arHotNews['date_create']?></span>
                     &nbsp <i class="fa fa-eye" style="font-size:14px;color:#FFFFFF"><?php echo $arHotNews['counter']?></i>
					&nbsp <i class="fa fa-comment-o" style="font-size:14px;color:#FFFFFF"><?php echo $arTSCM['TSCM']?></i>
                  </div>
                  <h3 class="post-title"><a href="<?php echo $urlDetail?>"><?php echo $arHotNews['name']?></a></h3>
               </div>
            </div>
         </div>
         <?php }?>
      </div>
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="background: transparent;left:270px;height:64%">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="top:218px"></span>
      <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="background: transparent;right:270px">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="top:218px"></span>
      <span class="sr-only">Next</span>
      </a>
   </div>
</div>
<!-- section -->
<div class="section">
   <!-- container -->
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title">
               <h2>Tin Mới Nhất</h2>
            </div>
         </div>
         <?php 
            $queryNewPost = "select n.*,c.name as 'catname',c.color as 'color' from news n inner join cat c on n.cat_id=c.cat_id order by news_id DESC limit 0,3";
            	$resultNewsPost  = $mysqli->query($queryNewPost);
            	
            	while($arNewsPost = mysqli_fetch_assoc($resultNewsPost))
            	{
					$newsid = $arNewsPost['news_id'];
					$queryTSCM = "SELECT COUNT(news_id) as TSCM from comment WHERE news_id=$newsid";
					$resultTSCM = $mysqli->query($queryTSCM);
					$arTSCM = mysqli_fetch_assoc($resultTSCM);
					
					$urlDetail = '/'.utf8ToLatin($arNewsPost['name']).'-'.$arNewsPost['news_id'].'.html';
            		$urlCat = '/cat/'.utf8ToLatin($arNewsPost['catname']).'-'.$arNewsPost['cat_id'];
            ?>
         <!-- post -->
         <div class="col-md-4">
            <div class="post">
               <a class="post-img" href="<?php echo $urlDetail?>"><img src="/files/<?php echo $arNewsPost['picture']?>" alt="" width="360px" height="217px" ></a>
               <div class="post-body">
                  <div class="post-meta">
                     <a class="post-category cat-<?php echo $arNewsPost['color']?>" href="<?php echo $urlCat?>"><?php echo $arNewsPost['catname']?></a>
                     <span class="post-date"><?php echo $arNewsPost['date_create']?></span>
                     &nbsp <i class="fa fa-eye" style="font-size:14px;color:#3D455C"><?php echo $arNewsPost['counter']?></i>
					 &nbsp <i class="fa fa-comment-o" style="font-size:14px;color:#3D455C"><?php echo $arTSCM['TSCM']?></i>
                  </div>
                  <h3 class="post-title"><a href="<?php echo $urlDetail?>"><?php echo $arNewsPost['name']?></a></h3>
               </div>
            </div>
         </div>
         <!--/post -->
         <?php }?>
         <div class="clearfix visible-md visible-lg"></div>
         <?php 
            $queryNewPost1 = "select n.*,c.name as 'catname',c.color as 'color' from news n inner join cat c on n.cat_id=c.cat_id order by news_id DESC limit 3,3";
                    	$resultNewsPost1  = $mysqli->query($queryNewPost1);
                    	
                    while($arNewsPost1 = mysqli_fetch_assoc($resultNewsPost1))
                    {
						$newsid = $arNewsPost1['news_id'];
						$queryTSCM = "SELECT COUNT(news_id) as TSCM from comment WHERE news_id=$newsid";
						$resultTSCM = $mysqli->query($queryTSCM);
						$arTSCM = mysqli_fetch_assoc($resultTSCM);
				
						$urlDetail = '/'.utf8ToLatin($arNewsPost1['name']).'-'.$arNewsPost1['news_id'].'.html';
						$urlCat = '/cat/'.utf8ToLatin($arNewsPost1['catname']).'-'.$arNewsPost1['cat_id'];
                    ?>
         <!-- post -->
         <div class="col-md-4">
            <div class="post">
               <a class="post-img" href="<?php echo $urlDetail?>"><img src="/files/<?php echo $arNewsPost1['picture']?>" alt="" width="360px" height="217px"></a>
               <div class="post-body">
                  <div class="post-meta">
                     <a class="post-category cat-<?php echo $arNewsPost1['color']?>" href="<?php echo $urlCat?>"><?php echo $arNewsPost1['catname']?></a>
                     <span class="post-date"><?php echo $arNewsPost1['date_create']?></span>
                     &nbsp <i class="fa fa-eye" style="font-size:14px;color:#3D455C"><?php echo $arNewsPost1['counter']?></i>
					 &nbsp <i class="fa fa-comment-o" style="font-size:14px;color:#3D455C"><?php echo $arTSCM['TSCM']?></i>
                  </div>
                  <h3 class="post-title"><a href="<?php echo $urlDetail?>"><?php echo $arNewsPost1['name']?></a></h3>
               </div>
            </div>
         </div>
         <!--/post -->
         <?php }?>
      </div>
      <!--/row -->
      <!-- row -->
      <div class="row">
         <div class="col-md-8">
            <div class="row">
               <!-- post -->
               <?php 
                  /* $dateInt = mktime(0, 0, 0, date("m"), date("d")-1,   date("Y"));
                  $lastDay = date('Y/m/d', $dateInt);
                  $toDay = date('Y-m-d'); */
                  $queryRD = "SELECT n.*, c.name as 'catname', c.color as 'catcolor' from news n inner join cat c on n.cat_id=c.cat_id ORDER by news_id DESC limit 6,1";
                  $resultRD  = $mysqli->query($queryRD);
                  
                  while($arRD = mysqli_fetch_assoc($resultRD))
                  {
					 $newsid = $arRD['news_id'];
					$queryTSCM = "SELECT COUNT(news_id) as TSCM from comment WHERE news_id=$newsid";
					$resultTSCM = $mysqli->query($queryTSCM);
					$arTSCM = mysqli_fetch_assoc($resultTSCM);
				
                  	$urlDetail = '/'.utf8ToLatin($arRD['name']).'-'.$arRD['news_id'].'.html';
                  	$urlCat = '/cat/'.utf8ToLatin($arRD['catname']).'-'.$arRD['cat_id'];
                   ?>
               <div class="col-md-12">
                  <div class="post post-thumb">
                     <a class="post-img" href="<?php echo $urlDetail?>"><img src="/files/<?php echo $arRD['picture']?>" alt="" width=759px height=455px></a>
                     <div class="post-body">
                        <div class="post-meta">
                           <a class="post-category cat-<?php echo $arRD['catcolor']?>" href="<?php echo $urlCat?>"><?php echo $arRD['catname']?></a>
                           <span class="post-date"><?php echo $arRD['date_create']?></span>
                           &nbsp <i class="fa fa-eye" style="font-size:14px;color:#FFFFFF"><?php echo $arRD	['counter']?></i>
						   &nbsp <i class="fa fa-comment-o" style="font-size:14px;color:#FFFFFF"><?php echo $arTSCM['TSCM']?></i>
                        </div>
                        <h3 class="post-title"><a href="<?php echo $urlDetail?>"><?php echo $arRD['name']?></a></h3>
                     </div>
                  </div>
               </div>
               <?php }?>
               <!--/post -->
            </div>
         </div>
         <div class="col-md-4">
            <?php
               require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right-mostRead.php';
               ?>
         </div>
      </div>
      <!--/row -->
   </div>
   <!--/container -->
</div>
<!--/section -->
<div class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <div class="col-md-8">
            <div class="row">
               <div class="col-md-12">
               </div>
               
               <div id="content">
                  <?php require('library/ajax/data.php'); ?>
               </div>
               <a href="javascript:void(0)" class="button" id="load_more" style="padding-left: 343px;">LOAD MORE</a>
            </div>
         </div>
         <div class="col-md-4">
            <!-- ad -->
            <div class="aside-widget text-center">
               <img src="https://techmaster.vn/fileman/Uploads/users/188/1-1msCRn-wDUzuGtI1yPUbAA.gif" width="350" height="250">
            </div>
            <div class="aside-widget text-center">
               <iframe width="350" height="250" src="https://www.youtube.com/embed/cnzVCBcsn3I" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
               </iframe>
            </div>
            <!--/ad -->
            <?php
               require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right-cat.php';
               ?>
         </div>
      </div>
      <!--/row -->
   </div>
   <!--/container -->
</div>
<!--/section -->
<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
   ?>