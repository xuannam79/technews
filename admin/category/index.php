<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Quản lý danh mục</h2>
         </div>
      </div>
      <!--/. ROW  -->
      <?php
         $tab = $_GET['tab'];
         echo"<script>
         		document.getElementById($tab).classList.add('active-menu');
         </script>"?>
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
                        <div class="col-sm-6" style="text-align: right;">
                           <br/>
                        </div>
                     </div>
                     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Tên</th>
                              <th width="160px">Chức năng</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $query = "SELECT * FROM cat order by cat_id DESC ";
                              $result = $mysqli->query($query);
                              while($row = mysqli_fetch_assoc($result)){	
                              	$cat_id = $row["cat_id"];
                              $status = $row["status"];
                              	$urlUpdate = "/admin/category/update.php?idupdate={$cat_id}";
                              	$urlDelete = "/admin/category/delete.php?iddele={$cat_id}";
                              if($row['parent_id']==0){
                              ?>
                           <tr class="gradeX">
                              <td><?php echo $row["cat_id"] ?></td>
                              <td>
                                 <ul>
                                    <li>
                                       <?php echo $row["name"] ?>
                                       <p class="<?php echo $cat_id?>" style="display:inline;">
                                          <a href="javascript:void(0)" onclick="return setStatus(<?php echo $status; ?>, '<?php echo $cat_id?>')">
                                          <?php
                                             if ($status == 1) {
                                             	$HA = 'active.gif';
                                             } else {
                                             	$HA = 'deactive.gif';
                                             }
                                             ?>
                                          <img src="/templates/admin/assets/img/<?php echo $HA?>" alt=""/>
                                          </a>
                                       </p>
                                    </li>
                                    <ul>
                                       <?php 
                                          $queryCat1 = "select * from cat where parent_id = {$cat_id}";
                                          $resultCat1  = $mysqli->query($queryCat1);
                                          while($arCat1 = mysqli_fetch_assoc($resultCat1)){
                                          	$parent_id = $arCat1['cat_id'];
                                          	$urlUpdate1 = "/admin/category/update.php?idupdate={$parent_id}";
                                          	$urlDelete1 = "/admin/category/delete.php?iddele={$parent_id}";
                                          ?>
                                       <li>
                                          <?php echo $arCat1["name"] ?>
                                          <p class="<?php echo $parent_id?>" style="display:inline;">
                                             <a href="javascript:void(0)" onclick="return setStatus(<?php echo $status; ?>, '<?php echo $parent_id?>')">
                                             <?php
                                                if ($status == 1) {
                                                	$HA = 'active.gif';
                                                } else {
                                                	$HA = 'deactive.gif';
                                                }
                                                ?>
                                             <img src="/templates/admin/assets/img/<?php echo $HA?>" alt=""/>
                                             </a>
                                          </p>
                                          <a href="<?php echo $urlUpdate1?>" title="sửa" style="margin-left: 10px"><i class="fa fa-edit" style="font-size:15px;color:blue"></i></a>
                                          <a href="<?php echo $urlDelete1?>" title="xóa" onclick= "return confirm('Nếu xóa <?php echo $arCat1["name"]?> thì tin tức thuộc <?php echo $arCat1["name"]?> cũng bị xóa.Bạn có chắc chắn muốn xóa?')"><i class="fa fa-trash-o" style="font-size:15px;color:red"></i></a>
                                       </li>
                                       <?php }?>
                                    </ul>
                                 </ul>
                              </td>
                              <td class="center">
                                 <a href="<?php echo $urlUpdate; ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                 <a href="<?php echo $urlDelete; ?>" title="" class="btn btn-danger" onclick= "return confirm('Nếu xóa <?php echo $row["name"]?> thì tin tức thuộc <?php echo $row["name"]?> cũng bị xóa.Bạn có chắc chắn muốn xóa?')"><i class="fa fa-pencil"></i> Xóa</a>
                              </td>
                           </tr>
                           <?php }} ?>
                        </tbody>
                     </table>
                     <script>
                        function setStatus(status, cl){
                        	$.ajax({
                        		url: 'ajax/status.php',
                        		type: 'POST',
                        		cache: false,
                        		data: {astatus: status, acl:cl},
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