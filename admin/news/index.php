<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
<div id="page-inner">
   <div class="row">
      <div class="col-md-12">
         <h2>Quản lý Tin tức</h2>
      </div>
   </div>
   <!--/. ROW  -->
   <?php
      $tab = $_GET['tab'];
      echo "<script>
      		document.getElementById($tab).classList.add('active-menu');
      </script>"?>
   <hr/>
   <?php if(isset($_GET['msg'])){
      echo "<script> alert('".$_GET['msg']."')</script>";
      }
      
      
      ?>
   <div class="row">
      <div class="col-md-12">
         <!-- Advanced Tables -->
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="table-responsive">
                  <div class="row">
                     <div class="col-sm-6">
                        <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                     </div>
                     <div class="col-sm-6" style="text-align: right;width:100%">
                        <form method="POST" action="">
                           <input type="submit" name="ok" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right"/>
                           <select class="form-control" name="danhmuc" style="float:right;width:120px;height:30px">
                              <option value="c.name">Danh Mục</option>
                              <option value="counter">Lượt Đọc</option>
                              <option value="p.name" selected>Tên</option>
                           </select>
                           <input type="search" name="search"  class="form-control input-sm" placeholder="Nhập thể loại cần tìm" style="float:right; width: 300px;"/>
                           <div style="clear:both"></div>
                        </form>
                        <br/>
                     </div>
                  </div>
                  <?php
                     $queryTSD = "SELECT COUNT(*) AS TSD FROM news";
                     $resultTSD = $mysqli->query($queryTSD);
                     $arTmp = mysqli_fetch_assoc($resultTSD);
                     $tongDong = $arTmp['TSD'];
                     $rowcount =  ROW_COUNT;
                     $tongTrang = ceil($tongDong/$rowcount);
                     
                     $currentPage = 1;
                     if(isset($_GET['page'])){
                     	$currentPage = $_GET['page'];
                     	
                     }
                     $offset = ($currentPage - 1) * $rowcount;
                     ?>
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Tên</th>
                           <th>Danh Mục</th>
                           <th>Lượt đọc</th>
                           <th>Hình Ảnh</th>
                           <th width="160px">Chức năng</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           if(isset($_POST['ok'])){
                           $danhmuc = $_POST['danhmuc'];
                                                	$search = addslashes($_POST['search']);
                           $query = "SELECT p.*,c.name as 'danhmuc' FROM `news` p INNER JOIN `cat` c ON c.cat_id = p.cat_id where $danhmuc like N'%{$search}%' order by p.news_id DESC";
                                                	$result = $mysqli->query($query);
                                                	 $num = mysqli_num_rows($result);
                                                                
                                                		if ($num > 0 && $search != "") 
                                                		{
                                                		?>
                        <font size="3" color="red">
                        <?php
                           echo "$num ket qua tra ve voi tu khoa <b>$search</b> trong <b>$danhmuc</b>";
                           ?>
                        </font>
                        <?php
                           }
                           }else{
                           $query = "SELECT p.*,c.name as 'danhmuc' FROM `news` p INNER JOIN `cat` c ON c.cat_id = p.cat_id order by news_id DESC limit {$offset},{$rowcount}";
                           
                           }
                           $result = $mysqli->query($query);
                           while($row = mysqli_fetch_assoc($result)){	
                           $news_id = $row["news_id"];
                           $name = $row["name"];
                           $danhmuc = $row['danhmuc'];
                           $luotdoc = $row["counter"];
                           $hinh = $row["picture"];
                           $urlUpdate = "/admin/news/update.php?idupdate={$news_id}";
                           $urlDelete = "/admin/news/delete.php?iddele={$news_id}";
                           ?>
                        <tr class="gradeX">
                           <td><?php echo $news_id ?></td>
                           <td><?php echo $name ?></td>
                           <td><?php echo $danhmuc ?></td>
                           <td><?php echo $luotdoc ?></td>
                           <td><img src="/files/<?php echo $hinh ?>" style="height: 60px;width: 60px;"/></td>
                           <td class="center">
                              <a href="<?php echo $urlUpdate ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                              <a href="<?php echo $urlDelete ?>" title="" class="btn btn-danger" onclick= "return confirm('bạn có muốn xóa trường này không?')"><i class="fa fa-pencil"></i> Xóa</a>
                           </td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Trang <?php echo $currentPage?> của <?php echo $tongTrang?></div>
                     </div>
                     <div class="col-sm-6" style="text-align: right;">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                           <ul class="pagination">
                              <?php 
                                 for($i=1;$i<=$tongTrang;$i++){
                                 	$active = '';
                                 	if($i==$currentPage){
                                 		$active = 'active';
                                 	}
                                 ?>
                              <li class="paginate_button <?php echo $active	?>" ><a href="index.php?tab=3&page=<?php echo $i?>"><?php echo $i?></a></li>
                              <?php }	?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--End Advanced Tables -->
         </div>
      </div>
   </div>
</div>
<!--/. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>