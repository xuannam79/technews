<?php
   ob_start();
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUlti.php'; 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php'; 
   
   
   
   // Lấy trang hiện tại
   $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
   
   
   // Kiểm tra trang hiện tại có bé hơn 1 hay không
   if ($page < 1) {
      $page = 1;
   }
   
   // Số record trên một trang
   $limit = 4;
    
   // Tìm start
   $start = ($limit * $page) - $limit;
   // Câu truy vấn
   // Trong câu truy vấn này chúng ta sẽ lấy limit tăng lên 1
   // Lý do là vì ta không có viết code đếm record nên dựa vào tổng số kết quả trả về để:
   // - Nếu kết quả trả về bằng $limit + 1 thì còn phân trang
   // - Nếu kết quả trả về bé hơn $limit + 1 thì nghĩa là hết dữ liệu nên ngưng phân trang
   $sql = "SELECT n.*, c.name as 'catname', c.color as 'catcolor' from news n inner join cat c on n.cat_id=c.cat_id ORDER by news_id DESC limit $start,".($limit + 1);
   
   
   // Thực hiện câu truy vấn
   $query  = $mysqli->query($sql);
   // Duyệt kết quả rồi đưa vào mảng result
   $result = array();
  
   while ($row = mysqli_fetch_array($query))
   {
      // Thêm vào result
      array_push($result, $row);
   }
   // Nếu là request ajax thì trả kết quả JSON
   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
      // Mình sleep 1 giây để các bạn check nhé, khi sử dụng thì bỏ đoạn sleep này đi
      sleep(0.5);
       
      // Trả kết quả về cho ajax
      die (json_encode($result));
   }
   else // Ngược lại thì hiển thị bình thường. Trường hợp này dùng load trong file list.php
   {
      $total = count($result);
      // Bỏ đi kết quả cuối cùng vì kết quả này dùng để check phân trang thôi
      for ($i = 0; $i < $total - 1; $i++)
      {
		$newsid = $result[$i]['news_id'];
		$queryTSCM = "SELECT COUNT(news_id) as TSCM from comment WHERE news_id=$newsid";
		$resultTSCM = $mysqli->query($queryTSCM);
		$arTSCM = mysqli_fetch_assoc($resultTSCM);
	
	$urlDetail = '/'.utf8ToLatin($result[$i]['name']).'-'.$result[$i]['news_id'].'.html';
   	$urlCat = '/cat/'.utf8ToLatin($result[$i]['catname']).'-'.$result[$i]['cat_id'];
   	?>
<div class="col-md-12">
   <div class="post post-row">
      <a class="post-img" href="<?php echo $urlDetail?>"><img src="/files/<?php echo $result[$i]['picture']?>" alt="" 	></a>
      <div class="post-body">
         <div class="post-meta">
            <a class="post-category cat-<?php echo $result[$i]['catcolor']?>" href="<?php echo $urlCat?>"><?php echo $result[$i]['catname']?></a>
            <span class="post-date"><?php echo $result[$i]['date_create']?></span>
            &nbsp <i class="fa fa-eye" style="font-size:14px;color:#3D455C"><?php echo $result[$i]['counter']?></i>
			&nbsp <i class="fa fa-comment-o" style="font-size:14px;color:#3D455C"><?php echo $arTSCM['TSCM']?></i>
         </div>
         <h3 class="post-title"><a href="<?php echo $urlDetail?>"><?php echo $result[$i]['name']?></a></h3>
         <p><?php echo $result[$i]['preview']?></p>
      </div>
   </div>
</div>
<?php
   }
   }
   
   ?>