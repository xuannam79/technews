<?php ob_start() ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Thêm danh mục</h2>
         </div>
      </div>
      <!-- /. ROW  -->
      <hr />
      <div class="row">
         <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="row">
                     <?php if(isset($_GET['msg'])){
                        echo "<script>".$_GET['msg']."</script>";
                        }?>
                     <div class="col-md-12">
                        <form role="form" id="form" name="form" method="POST">
                           <div class="form-group">
                              <label>Tên Danh Mục</label>
                              <input type="text" name="theloai" class="form-control" />
                              <label>Danh Mục Cha</label>
                              <select class="form-control" name="danhmuc">
                                 <option value="0">--None--</option>
                                 <?php 
                                    $queryEditCat = "SELECT * From cat where parent_id = 0 order by cat_id asc";
                                    $resultEditCat = $mysqli->query($queryEditCat);
                                    while($arEditCat = mysqli_fetch_assoc($resultEditCat)){
                                    	$cat_id= $arEditCat['cat_id'];
                                    	
                                    	?>
                                 <option value="<?php echo $cat_id; ?>"><?php echo $arEditCat['name'] ?></option>
                                 <?php
                                    }
                                    ?>
                              </select>
                           </div>
                           <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                        </form>
                        <?php 
                           if(isset($_POST['submit'])){
                           	if($_POST['theloai']==''){
                           		echo '<span style="color:red;">'.'Vui lòng nhập tên danh mục'.'</span>';
                           		
                           	}
                           	else{
                           		$name = $_POST['theloai'];
                           		$parent_id = $_POST['danhmuc'];
                           		$color = rand(1,4);
                           		$query ="INSERT INTO cat(name,parent_id,color,status) VALUES('{$name}', {$parent_id}, {$color},1)";
                           		$query2 = "SELECT name from cat where name like '{$name}'";
                           		$result2 = $mysqli->query($query2);
                           		$row = mysqli_fetch_assoc($result2);
                           		if($row != '') {
                           			echo '<span style="color:red;">'.'Danh mục đã tồn tại'.'</span>';
                           			die();
                           		}
                           		else {
                           			$result = $mysqli->query($query);
                           		}
                           		if($result){
                           			header("location:index.php?tab=2&msg=Thêm Thành Công!");
                           			die();
                           		} else {
                           			echo '<span style="color:red;">'.'Có lỗi khi thêm danh mục'.'</span>';
                           			die();
                           		}
                           	}
                           } ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End Form Elements -->
         </div>
      </div>
      <!-- /. ROW  -->
   </div>
   <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>
<?php ob_end_flush() ?>