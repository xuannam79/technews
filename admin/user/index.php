<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php
   $queryTSD = "SELECT count(*) as TSD  
   			FROM `users` order by user_id ASC";
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
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Quản lý người dùng</h2>
         </div>
      </div>
      <!--/. ROW  -->
      <?php
         $tab = $_GET['tab'];
         echo"<script>
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
                           <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                        </div>
                        <div class="col-sm-6" style="text-align: right;width:100%">
                           <form method="post" action="">
                              <input type="submit" name="ok" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right"/>
                              <select class="form-control" name="danhmuc" style="float:right;width:120px;height:30px">
                                 <option value="fullname">fullname</option>
                                 <option value="username" selected>user name</option>
                              </select>
                              <input type="search" name="search" class="form-control input-sm" placeholder="Nhập username cần tìm" style="float:right; width: 300px;"/>
                              <div style="clear:both"></div>
                           </form>
                           <br/>
                        </div>
                     </div>
                     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                           <tr>
                              <th>User Name</th>
                              <th>Full Name</th>
                              <th> Avatar</th>
                              <th> Block/Non-Block</th>
                              <th width="160px">Chức năng</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              if(isset($_POST['ok'])){
                              	$danhmuc = $_POST['danhmuc'];
                                                     	$search = addslashes($_POST['search']);
                                                     	$query = "SELECT * FROM users where $danhmuc like N'%{$search}%' order by user_id asc limit {$offset},{$rowcount}";
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
                              $query = "SELECT * FROM users order by user_id asc limit {$offset},{$rowcount}";
                              
                              }
                              $result = $mysqli->query($query);
                              while($row = mysqli_fetch_assoc($result)){
                              $id = $row["user_id"];
                              $username = $row["username"];
                              $fullname = $row["fullname"];
                              $avatar = $row["avatar"];
                              $active = $row["active"];
                              $urlUpdate = "/admin/user/update.php?idupdate={$id}";
                              $urlDelete = "/admin/user/deleteus.php?iddele={$id}";
                              ?>
                           <tr class="gradeX">
                              <td><?php echo $username; ?></td>
                              <td><?php echo $fullname; ?></td>
                              <td><img src="/files/User_img/<?php echo $avatar; ?>" width="150px" height="150px" alt="" class="fl"/></td>
                              <td class="<?php echo $id?>">
                                 <a href="javascript:void(0)" onclick="return setActive(<?php echo $active; ?>, '<?php echo $id?>')">
                                 <?php
                                    if ($active == 1) {
                                    	$HA = 'active.gif';
                                    } else {
                                    	$HA = 'deactive.gif';
                                    }
                                    if($username!='admin'){
                                    ?>
                                 <img src="/templates/admin/assets/img/<?php echo $HA?>" alt=""/>
                                 <?php }?>
                                 </a>
                              </td>
                              <td class="center">
                                 <?php if($username != 'admin' || $_SESSION['userinfo']['username']=='admin'){?>
                                 <a href="<?php echo $urlUpdate; ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                 <?php }?>
                                 <?php if($username != 'admin'){ ?>
                                 <a href="<?php echo $urlDelete; ?>" title="" class="btn btn-danger"onclick= "return confirm('bạn có muốn xóa trường này không?')"><i class="fa fa-pencil"></i> Xóa</a>
                                 <?php }?>
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                     <script>
                        function setActive(active, cl){
                        	$.ajax({
                        		url: 'ajax/active.php',
                        		type: 'POST',
                        		cache: false,
                        		data: {aactive: active, acl:cl},
                        		success: function(data){
                        			$('.' + cl).html(data);
                        		},
                        		error: function (){
                        			alert('Có lỗi xảy ra');
                        		}
                        	});
                        	return false;
                        }
                     </script>
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
                                 <li class="paginate_button <?php echo $active	?>" ><a href="index.php?tab=2&page=<?php echo $i?>"><?php echo $i?></a></li>
                                 <?php }	?>
                              </ul>
                           </div>
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