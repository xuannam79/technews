<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
   ?>
<!-- section -->
<br/>
<div class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <!-- Post content -->
         <div class="col-md-8">
            <?php 
               $idDetail = $_GET['id'];
               $queryDetail = "select * from news where news_id = {$idDetail}";
               $resultDetail  = $mysqli->query($queryDetail);
               $arDetail = mysqli_fetch_assoc($resultDetail);
               
               /* Đếm lượt xem */
               $queryCounter = "update news set counter=counter+1 where news_id = {$idDetail}";
               $resultCounter  = $mysqli->query($queryCounter);
               if($arDetail)
               {
               ?>
            <div class="section-row sticky-container">
               <div class="main-post">
                  <h3><?php echo $arDetail['name']?></h3>
                  <blockquote class="blockquote">
                     <?php echo $arDetail['preview']?>
                  </blockquote>
                  <figure class="figure-img">
                     <img class="img-responsive" src="/files/<?php echo $arDetail['picture']?>" alt="">
                  </figure>
                  <p><?php echo $arDetail['detail']?></p>
               </div>
            </div>
            <?php }?>
            <!-- ad -->
            <div class="section-row text-center">
               <a href="#" style="display: inline-block;margin: auto;">
               <img class="img-responsive" src="/templates/public/img/ad-2.jpg" alt="">
               </a>
            </div>
            <!-- ad -->
            <!-- comments -->
            <div class="section-row">
               <div class="section-title" id="TSC">
                  <?php 
                     $queryCount = "select count(*) as TSC from comment where news_id=$idDetail";
                     $resultCount = $mysqli->query($queryCount);
                     $rowCount = mysqli_fetch_assoc($resultCount);
                     
                     ?>
                  <span>
                     <h2><?php echo $rowCount['TSC']?> bình luận</h2>
                  </span>
               </div>
               <div class="section-row">
                  <div class="section-title">
                     <h2>Để lại bình luận</h2>
                     <p>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *</p>
                  </div>
                 
				  <?php 
					if(!isset($_SESSION['userinfo'])){
				  ?>
                     <form class="post-reply" method="post" style="width:69%">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group" >
                                 <span>Tên *</span>
                                 <input class="input" type="text" name="nameReader" id="nameReader">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <span>Email *</span>
                                 <input class="input" type="email" name="email1" id="emailReader" >
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <textarea class="input" name="messageReader" id="messageReader" placeholder="Hãy viết gì đó !!!"></textarea>
                              </div>
                              <button class="primary-button" name="submit1" id="primary-button" data-newsid="<?php echo $idDetail?>">Bình Luận</button>
                           </div>
                        </div>
                     </form>
				  <?php }?>
				   <?php 
					if(isset($_SESSION['userinfo'])){
				  ?>
                     <form class="post-reply" method="post" style="width:69%">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <textarea class="input" name="messageUser" id="messageUser" placeholder="Hãy viết gì đó !!!"></textarea>
                              </div>
                              <button class="primary-button" name="submit1" id="primary-button2" data-newsid="<?php echo $idDetail?>">Bình Luận</button>
                           </div>
                        </div>
                     </form>
					<?php }?>
                  <div class="post-comments">
                     <div class="media">
                        <div id="com-list">
                           <span>
                           </span>
                        </div>
                     </div>
                     <!-- comment -->
                     <?php
                        $queryComment = "SELECT c.*,u.avatar AS avatarUser,u.username AS username FROM comment c
                        				LEFT OUTER JOIN users u ON c.user_id=u.user_id where news_id=$idDetail GROUP BY date_create 
                        				UNION
                        				SELECT c.*,u.avatar AS avatarUser,u.username AS username FROM comment c
                        				RIGHT OUTER JOIN users u ON c.user_id=u.user_id where news_id=$idDetail GROUP BY date_create order by comment_id DESC";
                        $resultComment = $mysqli->query($queryComment);
                        		
                        while($arComment = mysqli_fetch_assoc($resultComment)){
                        	$comment_id = $arComment['comment_id'];
                        	$parent_id = $arComment['parent_id'];
                        	if($comment_id!=''){
                        	if($parent_id==0){
                        		if($arComment['user_id']!=0){
                        			$nameReader = $arComment['username'];
                        			$date1 = $arComment['date_create'];
                        			$content1 = nl2br($arComment['content']);
                        			$avatar1 = $arComment['avatarUser'];
                        		}else{
                        			
                        			$nameReader = $arComment['name'];
                        			$date1 = $arComment['date_create'];
                        			$content1 = nl2br($arComment['content']);
                        			$avatar1 = "avatar.png";
                        		}
                        ?>
                     <div class="media">
                        <div id="com-list">
                           <span>
                           </span>
                        </div>
                        <span>
                           <div class="media-left">
                              <img class="media-object" src="/files/User_img/<?php echo $avatar1?>" alt="">
                           </div>
                           <div class="media-body">
                              <div class="media-heading">
                                 <h4><?php echo $nameReader?></h4>
                                 <span class="time"><?php echo $date1?></span>
                                 <a href="javascript:void(0)" class="reply" data-reid="<?php echo $comment_id?>">Trả lời</a>
                              </div>
                              <p><?php echo $content1?></p>
                        </span>
                        <!-- comment -->
                        <?php
                           $queryComment1 = "SELECT c.*,u.avatar AS avatarUser,u.username AS username FROM comment c
                           		LEFT OUTER JOIN users u ON c.user_id=u.user_id WHERE parent_id={$comment_id} GROUP BY date_create
                           		UNION
                           		SELECT c.*,u.avatar AS avatarUser,u.username AS username FROM comment c
                           		RIGHT OUTER JOIN users u ON c.user_id=u.user_id WHERE parent_id={$comment_id} GROUP BY date_create";
                           $resultComment1  = $mysqli->query($queryComment1);
                           while($arComment1 = mysqli_fetch_assoc($resultComment1)){
                           $parent_id = $arComment1['comment_id'];
                           if($arComment1['user_id']!=0){
                           	$name = $arComment1['username'];
                           	$date = $arComment1['date_create'];
                           	$content = nl2br($arComment1['content']);
                           	$avatar = $arComment1['avatarUser'];
                           }else{
                           	$name = $arComment1['name'];
                           	$date = $arComment1['date_create'];
                           	$content = nl2br($arComment1['content']);
                           	$avatar = "avatar.png";
                           }
                           ?>
                        <div class="media">
                        <div class="media-left">
                        <img class="media-object" src="/files/User_img/<?php echo $avatar?>" alt="">
                        </div>
                        <div class="media-body">
                        <div class="media-heading">
                        <h4><?php echo $name?></h4>
                        <span class="time"><?php echo $date?></span>
                        </div>
                        <p><?php echo $content ?></p>
                        </div>
                        </div>
                        <?php }?>
                        <div id="reply-list<?php echo $comment_id?>">
                        <span>
                        </span>
                        </div>
                        <!-- form trả lời -->
                        <form class="post-reply<?php echo $comment_id?>" method="post" id="formReply" style="display:none;">
                        <div class="row" style="width: 450px;">
						<?php if(!isset($_SESSION['userinfo'])){
							?>
                        <div class="col-md-4" style="width:267px;">
                        <div class="form-group">
                        <span>Tên *</span>
                        <input class="input" type="text" name="nameReply" id="nameReply<?php echo $comment_id?>"  data-idNews="<?php echo $idDetail; ?>">
                        </div>
                        </div>
						<?php }if(!isset($_SESSION['userinfo'])){
							?>
                        <div class="col-md-4" style="width: 215px;">
							<div class="form-group">
								<span>Email(*)</span>
								<input class="input" type="email" name="emailReply" id="emailReply<?php echo $comment_id?>">
							</div>
                        </div>
						<?php }?>
						<?php if(isset($_SESSION['userinfo'])){
							?>
                        
						<?php }?>
                        <div class="col-md-12" style="width: 430px;">
                        <div class="form-group">
                        <textarea class="input" name="messageReply" id="messageReply<?php echo $comment_id?>" placeholder="Hãy viết gì đó !!!" style="height: 60px;"></textarea>
                        </div>
                        <button class="primary-button" name="submitReply" id="submitReply" data-comId="<?php echo $comment_id; ?> " data-idNews="<?php echo $idDetail; ?>"> Bình Luận</button>
                        </div>
                        </div>
                        </form>
                        <!--/comment -->
                        </div>
                     </div>
                     <?php }}}?>
                     <!--/comment -->
                  </div>
               </div>
               <!--/comments -->
            </div>
            <!--/reply -->
         </div>
         <!--/Post content -->
         <!-- aside -->
         <div class="col-md-4">
            <!-- ad -->
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
         <!--/aside -->
      </div>
      <!--/row -->
   </div>
   <!--/container -->
</div>
<!--/section -->
<!-- tool share  -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b4ec0a436ed7084"></script>
<!-- tool follow-->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b4ec0a436ed7084"></script>
<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
   ?>