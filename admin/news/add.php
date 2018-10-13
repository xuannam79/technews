<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<style>
   .error{
   color:red;
   }
   label{
   display:block;
   }
</style>
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Thêm Tin tức</h2>
         </div>
      </div>
      <!--/. ROW  -->
      <hr/>
      <?php if(isset($_GET['msg'])){
         echo "<script>".$_GET['msg']."</script>";
         }?>
      <div class="row">
         <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12">
                        <?php
                           function reloadName(){
                           	if(isset($_POST['tenTT'])){
                           		echo $_POST['tenTT'];
                           	}
                           }
                           function reloadMT(){
                           	if(isset($_POST['mota'])){
                           		echo $_POST['mota'];
                           	}
                           }
                           function reloadCT(){
                           	if(isset($_POST['chitiet'])){
                           		echo $_POST['chitiet'];
                           	}
                           }
                           ?>
                        <?php 
                           if(isset($_POST['submit'])){
                           /* if($_POST['tenTT']==''){
                           echo '<span style='.'color:red'.'>'.'Vui lòng nhập tên Tin tức'.'</span>';
                           }
                           else if($_POST['hinhanh']==''){
                           echo '<span style='.'color:red'.'>'.'Vui lòng chọn hình ảnh'.'</span>';
                           }
                           else{ */
                           $name = $_POST['tenTT'];
                           $danhmuc=$_POST['danhmuc'];
                           $mota = $_POST['mota'];
                           $chitiet = $_POST['chitiet'];
                           $date_create = date('Y-m-d H:i:s');
                           
                           $namefile = $_FILES['hinhanh']['name'];							
                           $picture=$namefile;
                           $time = time();
                           $arr = explode('.',$picture);
                           $duoifile= end($arr);;
                           $fileAnh = 'HinhAnh-'.$time.'.'.$duoifile;
                           /*lấy thông tin ảnh */
                           $tmp_name = $_FILES['hinhanh']['tmp_name'];
                           //lấy đường dẫn gốc của host
                           $path_root = $_SERVER["DOCUMENT_ROOT"];
                           //tạo đường dẫn đầy đủ
                           $path_upload = $path_root.'/files/'.$fileAnh;
                           //thực hiện upload lên host
                           move_uploaded_file($tmp_name,$path_upload);
                           $picture=$fileAnh;
                           
                           $preview=$_POST['mota'];
                           $detail=$_POST['chitiet'];
                           
                           if($name == ''){
                           echo '<script>alert("Không được để trống tên")</script>';
                           }
                           else if($mota == ''){
                           echo '<script>alert("Không được để trống mô tả")</script>';
                           }
                           else if($chitiet == ''){
                           echo '<script>alert("Không được để trống chi tiết")</script>';
                           }
                           else{
                           $querynews ="INSERT INTO news(name,preview,detail,picture,date_create,cat_id) VALUES('{$name}','{$preview}','{$detail}','{$picture}','{$date_create}','{$danhmuc}')";
                           
                           $result1 = $mysqli->query($querynews);
                           if($result1){
                           
                           header("location:index.php?tab=3&msg=Thêm Thành Công!");
                           
                           } else {
                           header("location:index.php?tab=3&msg=Thêm Thất Bại!");
                           }
                           }
                           }
                           
                           
                           
                           
                           ?>
                        <form role="form" name="form" class="form" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                              <label>Tên Tin tức</label>
                              <input type="text" name="tenTT" class="form-control" value="<?php reloadName()?>"/>
                              <label>Danh mục Tin tức</label>
                              <select class="form-control" name="danhmuc" >
                                 <?php 
                                    $query = "SELECT * From cat order by cat_id asc";
                                    $result = $mysqli->query($query);
                                    while($row = mysqli_fetch_assoc($result)){
                                    	$cat_id= $row['cat_id'];
                                    if($row['parent_id']!=0){
                                    	?>
                                 <option value="<?php echo $cat_id; ?>"><?php echo $row['name'] ?></option>
                                 <?php } }?>
                              </select>
                              <label>Hình ảnh:</label> 
                              <input type="file" name="hinhanh" id="hinhanh"/>
                              <label>Mô tả</label>
                              <textarea class="form-control" rows="3" name="mota"  ><?php reloadMT()?></textarea>
                              <label>Chi tiết</label>
                              <textarea id="chitiet" class="form-control" rows="5" name="chitiet"  ><?php reloadCT()?></textarea>
                           </div>
                           <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
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
<script>
   CKEDITOR.replace( 'chitiet',
   {
   	filebrowserBrowseUrl : 'http://technews.nuk:81/templates/admin/assets/ckfinder/ckfinder.html',
   	filebrowserImageBrowseUrl : 'http://technews.nuk:81/templates/admin/assets/ckfinder/ckfinder.html?type=Images',
   	filebrowserFlashBrowseUrl : 'http://technews.nuk:81/templates/admin/assets/ckfinder/ckfinder.html?type=Flash',
   	filebrowserUploadUrl : 'http://technews.nuk:81/templates/admin/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
   	filebrowserImageUploadUrl : 'http://technews.nuk:81/templates/admin/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
   	filebrowserFlashUploadUrl : 'http://technews.nuk:81/templates/admin/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
   });
</script>
<script type="text/javascript" >
   $(document).ready(function (){
   	$('.form').validate({
   		ignore: [],
   		rules: {
   			"tenTT": {
   				required: true,
   			},
   			"danhmuc": {
   				required: true,
   			},
   			"hinhanh": {
   				required: true,
   			
   			},
   			"mota": {
   				required: true,
   			
   			},
   			"chitiet": {
   				required: true,
   			
   			},
   		},
   		messages: {
   			"tenTT": {
   				required: "Vui lòng không để trống",
   			},
   			"danhmuc": {
   				required: "Vui lòng không để trống",
   			},
   			"hinhanh": {
   				required: "Vui lòng không để trống",
   			},
   			"mota": {
   				required: "Vui lòng không để trống",
   			},
   			"chitiet": {
   				required: "Vui lòng không để trống",
   			},
   		
   		},
   	});
   });	
</script>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/template/admin/inc/footer.php'; ?>