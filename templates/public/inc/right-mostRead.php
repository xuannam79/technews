<!-- post widget -->
<div class="aside-widget">
   <div class="section-title">
      <h2>Đọc Nhiều Nhất</h2>
   </div>
   <?php
      $queryTop1News = "select MAX(counter) as 'top1' from news";
      $resultTop1News = $mysqli->query($queryTop1News);
      $arTop1News = mysqli_fetch_assoc($resultTop1News);
      $top1News = $arTop1News['top1'];
      
      $queryHotNews = "select * from news order by counter DESC limit 0,4";
      $resultHotNews  = $mysqli->query($queryHotNews);
      
      
      while($arHotNews = mysqli_fetch_assoc($resultHotNews))
      {
      	$urlDetail = '/'.utf8ToLatin($arHotNews['name']).'-'.$arHotNews['news_id'].'.html';
      ?>
   <div class="post post-widget">
      <a class="post-img" href="<?php echo $urlDetail?>"><img src="/files/<?php echo $arHotNews['picture']?>" alt=""></a>
      <div class="post-body">
         <h3 class="post-title"><a href="<?php echo $urlDetail?>"><?php echo $arHotNews['name']?></a></h3>
      </div>
   </div>
   <?php }?>
</div>
<!--/post widget -->