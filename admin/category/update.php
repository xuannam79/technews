<?php require_once $_SERVER['DOCUMENT_ROOT'].' \templates\admin\inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].' \templates\admin\inc/leftbar.php'; ?>
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Sửa danh mục</h2>
         </div>
      </div>
      <!--/. ROW  -->
      <hr/>
      <div class="row">
         <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="row">
                     <?php
                        if(isset($_GET['msg'])) {
                        ?>
                     <h4> <?php echo $_GET['msg'] ?> </h4>
                     <?php } ?>
                     <div class="col-md-12">
                        <?php
                           $idSua = $_GET['idupdate'];
                           $queryTen = "select * from cat where cat_id = {$idSua}";
                           $resultTen = $mysqli->query($queryTen);
                           $arTen = mysqli_fetch_assoc($resultTen);
                           $parent_id = $arTen['parent_id'];
                           $ten = $arTen['name'];
                           if(isset($_POST['submit'])) {
                           	$parent_idSua = $_POST['danhmuc'];
                           	$nameUpdate = $_POST['tendm'];
                           	if($parent_id!=0){
                           	$queryUpdate = "UPDATE cat SET name = '{$nameUpdate}',parent_id = {$parent_idSua} WHERE cat_id = '{$idSua}' ";
                           	}else{
                           		$queryUpdate = "UPDATE cat SET name = '{$nameUpdate}' WHERE cat_id = '{$idSua}' ";
                           	}
                           	$queryUpdate2 = "SELECT name from cat where name like '{$nameUpdate}'";
                           	$resultUpdate = $mysqli->query($queryUpdate);
                           	if($row != '') {
                           		echo "Danh mục đã tồn tại";
                           		die();
                           	}
                           	if ( $resultUpdate ) {
                           		header("location:index.php?tab=2&msg=Sửa thành công!");
                           	} else {  
                           		header("location:index.php?tab=2&msg=Sửa thất bại!");
                           	}
                           }
                           ?>
                        <form role="form" action="" method="POST">
                           <div class="form-group">
                              <label>Tên danh mục</label>
                              <input type="text" name="tendm" class="form-control" value="<?php echo $ten?>"/>
                              <br/>
                              <?php 
                                 if($parent_id!=0){
                                 ?>
                              <label>Đổi danh mục cha</label>
                              <select class="form-control" name="danhmuc">
                                 <?php 
                                    $queryEditCat = "SELECT * From cat where parent_id = 0 order by cat_id asc";
                                    $resultEditCat = $mysqli->query($queryEditCat);
                                    while($arEditCat = mysqli_fetch_assoc($resultEditCat)){
                                    	$cat_id= $arEditCat['cat_id'];
                                    	if($parent_id==$cat_id){
                                    		
                                    	?>
                                 <option value="<?php echo $cat_id; ?>" selected><?php echo $arEditCat['name'] ?></option>
                                 <?php }
                                    else{
                                    	?>
                                 <option value="<?php echo $cat_id; ?>"><?php echo $arEditCat['name'] ?></option>
                                 <?php
                                    }
                                    } ?>
                              </select>
                              <?php }?>
                           </div>
                           <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End Form Elements -->
         </div>
      </div>
      <!--/. ROW  -->
   </div>
   <!--/. PAGE INNER  -->
</div>
<!--/. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].' \templates\admin\inc/footer.php'; ?>