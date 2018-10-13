<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php
   // tổng số dòng
   $queryTSD = "SELECT COUNT(*) AS TSD FROM contact";
   $resultTSD = $mysqli->query($queryTSD);
   $arTmp = mysqli_fetch_assoc($resultTSD);
   $tongSoDong = $arTmp['TSD'];
   // số truyện trên 1 trang
   $row_count = ROW_COUNT;
   // Tổng số trang
   // toongtranggithub
   $tongSoTrang = ceil($tongSoDong/$row_count);
   // trang hiện tại
   $current_page = 1;
   if(isset($_GET['page'])) {
   	$current_page = $_GET['page'];
   }
   // offset
   $offset = ($current_page - 1) * $row_count;
   ?>
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Quản lý liên hệ</h2>
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
         }?>
      <div class="row">
         <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="table-responsive">
                     <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6" style="text-align: right;width:100%">
                           <form method="POST" action="">
                              <input type="submit" name="ok" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right"/>
                              <select class="form-control" name="danhmuc" style="float:right;width:120px;height:30px">
                                 <option value="name">name</option>
                                 <option value="email">email</option>
                                 <option value="message" selected>message</option>
                              </select>
                              <input type="search" name="search" class="form-control input-sm" placeholder="Nhập thể loại cần tìm" style="float:right; width: 300px;"/>
                              <div style="clear:both"></div>
                           </form>
                           <br/>
                        </div>
                     </div>
                     <?php
                        if(isset($_POST['save'])){
                        	$checkbox = $_POST['check'];
                        	for($i=0;$i<count($checkbox);$i++){
                        		$del_id = $checkbox[$i];
                        		$queryCB = "DELETE FROM contact WHERE contact_id = '{$del_id}'";
                        		$resultCB = $mysqli->query($queryCB);
                        		$msg = "Xóa thành công";
                        	}
                        }
                        $query = "SELECT * FROM contact";
                        $result = $mysqli->query($query);
                        ?>
                     <?php
                        if(isset($_GET['msg'])) {
                        ?>
                     <script type="text/javascript">
                        alert("<?php echo $_GET['msg'] ?>");
                     </script>
                     <?php } ?>
                     <form method="post" action="" id="frm">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                           <thead>
                              <tr>
                                 <th>Contact ID</th>
                                 <th>Messages</th>
                                 <th>name</th>
                                 <th>Email</th>
                                 <th width="160px"><input type="checkbox" id="checkAl"> Chọn tất cả </th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $queryDM = "";
                                 if(isset($_POST['ok'])) {
                                 	$search = addslashes($_POST['search']);
                                 	$noidung = $_POST['search'];
                                 	$danhmuc = $_POST['danhmuc'];
                                 	$queryDM = "SELECT * FROM contact WHERE $danhmuc LIKE N'%{$noidung}%' LIMIT {$offset},{$row_count}";
                                 	$result = $mysqli->query($queryDM);
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
                                 $queryDM = "SELECT * FROM contact LIMIT {$offset},{$row_count}";
                                 }
                                 $resultDM = $mysqli->query($queryDM);
                                 $i = 0;
                                 while($row = mysqli_fetch_assoc($resultDM)) {
                                 $id = $row['contact_id'];
                                 $email = $row['email'];
                                 $name = $row['name'];
                                 $message = $row['message'];
                                 ?>
                              <tr class="gradeX">
                                 <td><?php echo $id ?></td>
                                 <td><?php echo $message ?></td>
                                 <td><?php echo $name ?></td>
                                 <td><?php echo $email ?></td>
                                 <td class="center">
                                    <input type="checkbox" id="checkItem" name="check[]" value="<?php echo $id ?>">
                                 </td>
                              </tr>
                              <?php
                                 $i++;
                                 } ?>
                           </tbody>
                        </table>
                        <button type="submit" onclick="return confirm('Bạn có muốn xóa?')" class="btn btn-danger" name="save">Xóa</button>
                     </form>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị trang <?php echo $current_page; ?> đến <?php echo $tongSoTrang ?> của <?php echo $tongSoDong ?> liên hệ</div>
                     </div>
                     <div class="col-sm-6" style="text-align: right;">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                           <ul class="pagination">
                              <?php
                                 for($i = 1; $i <= $tongSoTrang; $i++) {
                                  $active = '';
                                  if($i == $current_page) {
                                 	 $active = 'active';
                                  }
                                 ?>
                              <li class="paginate_button <?php echo $active ?>" ><a href="index.php?tab=6&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                              <?php
                                 }
                                 ?>
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
<script>
   $("#checkAl").click(function () {
   $('input:checkbox').not(this).prop('checked', this.checked);
   });
</script>