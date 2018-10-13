<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php
   echo "<script>
   		document.getElementById(1).classList.add('active-menu');
   	</script>"?>
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2 style="font-size: 23px;padding-left: 90px;">CHÀO MỪNG BẠN ĐẾN VỚI TRANG QUẢN TRỊ WEBSITE TIN TỨC CÔNG NGHỆ</h2>
         </div>
      </div>
      <!--/. ROW  -->
      <div class="slide">
         <br>
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
               <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
               <li data-target="#myCarousel" data-slide-to="1"></li>
               <li data-target="#myCarousel" data-slide-to="2"></li>
               <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
               <div class="item active">
                  <img src="/templates/public/img/post-1.jpg"  width="431" height="332">
               </div>
               <div class="item">
                  <img src="/templates/public/img/post-2.jpg"  width="431" height="332">
               </div>
               <div class="item">
                  <img src="/templates/public/img/post-3.jpg"  width="431" height="332">
               </div>
               <div class="item">
                  <img src="/templates/public/img/post-4.jpg"  width="431" height="332">
               </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
   </div>
</div>
<!--/. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>