<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
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
               <h3>Tìm kiếm</h3>
               <?php
                  // Lấy tham số từ khóa tìm kiếm
                   $search = trim(htmlspecialchars(addslashes($_GET['search'])));
                   
                   if ($search) {
                      // Lấy số hàng trong table
                       $sql_get_news = "select n.date_create as ngaydang,n.news_id as idnews,n.counter as newscounter,n.picture as newspicture,n.name as newsname,n.preview as newspreview,c.name as 'catname',c.cat_id as idcat, c.color as 'catcolor' 
                  from news n inner join cat c on n.cat_id=c.cat_id 
                  WHERE n.name LIKE '%$search%' OR n.preview LIKE '%$search%' ORDER BY news_id DESC";
                   $resultS = $mysqli->query($sql_get_news);
                   $num = mysqli_num_rows($resultS);
                                  				  
                  if ($num > 0 && $search != "") 
                  {
                  ?>
               <font size="3" color="red">
               <?php
                  echo '<div class="well well-lg"> <b>'.$num.'</b> ket qua tra ve voi tu khoa <b>'.$search.'</b></div>';
                  while($arS = mysqli_fetch_assoc($resultS)){
                  $urlDetail = '/'.utf8ToLatin($arS['newsname']).'-'.$arS['idnews'].'.html';
                  $urlCat = '/cat/'.utf8ToLatin($arS['catname']).'-'.$arS['idcat'];
                  ?>
               </font>
               <!-- post -->
               <div class="col-md-12">
                  <div class="post post-row">
                     <a class="post-img" href="<?php echo $urlDetail?>"><img src="/files/<?php echo $arS['newspicture']?>" alt=""></a>
                     <div class="post-body">
                        <div class="post-meta">
                           <a class="post-category cat-<?php echo $arS['catcolor']?>" href="<?php echo $urlCat?>"><?php echo $arS['catname']?></a>
                           <span class="post-date"><?php echo $arS['ngaydang']?></span>
                           &nbsp <i class="fa fa-eye" style="font-size:14px;color:#3D455C"><?php echo $arS['newscounter']?></i>
                        </div>
                        <h3 class="post-title"><a href="<?php echo $urlDetail?>"><?php echo $arS['newsname']?></a></h3>
                        <p><?php echo $arS['newspreview']?></p>
                     </div>
                  </div>
               </div>
               <!--/post -->
               <?php
                  }
                             
                             } 
                  else {
                  echo '<div class="well well-lg">Không tìm thấy kết quả nào.</div>';
                             }
                             }
                  else {
                  echo '<div class="alert alert-danger">Vui lòng nhập từ khóa tìm kiếm.</div>';
                             }
                             
                             ?>
            </div>
         </div>
         <div class="col-md-4">
            <!-- ad -->
            <div class="aside-widget text-center">
               <img src="https://techmaster.vn/fileman/Uploads/users/188/1-EERzyzZhHJ5FWXKi2PNxuA.gif" alt="" width="350" height="250">
            </div>
            <div class="aside-widget text-center">
               <a href="#" style="display: inline-block;margin: auto;">
               <iframe width="350" height="250" src="https://www.youtube.com/embed/cnzVCBcsn3I" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
               </iframe>
               </a>
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