<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
   $id = $_GET['id'];
   ?>
<br/>
<!-- section -->
<div class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <div class="col-md-8">
            <div class="row">
               <!-- post -->
               <?php 
                  $queryHotNews = "select n.*,c.name as 'catname', c.color as 'catcolor' from news n inner join cat c on n.cat_id=c.cat_id order by counter DESC limit 0,1";
                  $resultHotNews  = $mysqli->query($queryHotNews);
                  while($arHotNews = mysqli_fetch_assoc($resultHotNews))
                  {
					$newsid = $arHotNews['news_id'];
					$queryTSCM = "SELECT COUNT(news_id) as TSCM from comment WHERE news_id=$newsid";
					$resultTSCM = $mysqli->query($queryTSCM);
					$arTSCM = mysqli_fetch_assoc($resultTSCM);
					  
                  	$urlDetail = '/'.utf8ToLatin($arHotNews['name']).'-'.$arHotNews['news_id'].'.html';
                  	$urlCat = '/cat/'.utf8ToLatin($arHotNews['catname']).'-'.$arHotNews['cat_id'];
                  ?>
               <div class="col-md-12">
                  <div class="post post-thumb">
                     <a class="post-img" href="<?php echo $urlDetail?>"><img src="/files/<?php echo $arHotNews['picture']?>" alt="" height=455></a>
                     <div class="post-body">
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
               <!--/post -->
               <div class="clearfix visible-md visible-lg"></div>
               <!-- ad -->
               <div class="col-md-12">
                  <div class="section-row">
                     <a href="#">
                     <img class="img-responsive center-block" src="/files/a-1.gif" alt="">
                     </a>
                  </div>
               </div>
               <!-- ad -->
               <div class="col-md-12">
                  <div class="section-row">
                     <div id="content1">
                        <?php require('library/ajaxPop/dataPop.php'); ?>
                     </div>
                     <a href="javascript:void(0)" class="button" id="load_more1" style="padding-left: 343px;">LOAD MORE</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <!-- ad -->
            <div class="aside-widget text-center">
               <img src="https://techmaster.vn/fileman/Uploads/users/188/1-1msCRn-wDUzuGtI1yPUbAA.gif" width="350" height="250">
            </div>
            <!--/ad -->
            <?php
               require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right-mostRead.php';
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