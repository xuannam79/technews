<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php
   function reloadName(){
   	if(isset($_POST['username'])){
   		echo $_POST['username'];
   	}
   }
   function reloadPASS(){
   	if(isset($_POST['password'])){
   		echo $_POST['password'];
   	}
   }
   function reloadFN(){
   	if(isset($_POST['fullname'])){
   		echo $_POST['fullname'];
   	}
   }
   ?>
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Thêm Người Dùng</h2>
         </div>
      </div>
      <!--/. ROW  -->
      <hr/>
      <?php if(isset($_GET['msg'])){
         echo "<script>".$_GET['msg']."</script>";
         }?>
      <div class="row">
         <div class="col-md-12">
            <?php 
               if(isset($_POST['submit'])){
               	$username = $_POST['username'];
               	$password = md5($_POST['password']);
               	$fullname = $_POST['fullname'];
               	
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
               	$path_upload = $path_root.'/files/User_img/'.$fileAnh;
               	//thực hiện upload lên host
               	move_uploaded_file($tmp_name,$path_upload);
               	$picture=$fileAnh;
               			
               	$query2 = "SELECT username from users where username = '{$username}'";
               	$result2 = $mysqli->query($query2);
               	$row = mysqli_fetch_assoc($result2);
               	 if($username == ''){
               		echo '<script>alert("Không được để trống tên")</script>';
               	}
               	else if($password == ''){
               		echo '<script>alert("Không được để trống mật khẩu")</script>';
               	}
               	else if($fullname == ''){
               		echo '<script>alert("Không được để trống tên đầy đủ ")</script>';
               	}
               	else if($row != ''){
               		echo '<script>alert("Đã tồn tại người dùng này!! ")</script>';
               		/* die(); */
               	}
               	else {
               		$query ="INSERT INTO users(username,password,fullname,avatar) VALUES('".$username."','".$password."',N'".$fullname."','".$picture."')";
               		$result = $mysqli->query($query);	
               		if($result){
               				header("location:index.php?tab=4&msg=Thêm Thành Công!");
               				die();
               		} else {
               				echo "có lỗi khi thêm người dùng";
               				die();
               		}
               	}
               } ?>
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12">
                        <form role="form" id="form" name="form" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                              <label>Username:</label>
                              <input type="text" name="username" class="form-control"  value="<?php reloadName()?>"/>
                              <label>Password:</label>
                              <input type="password" name="password" class="form-control" value="<?php reloadPASS()?>"/>
                              <label>Fullname:</label>
                              <input type="text" name="fullname" class="form-control" value="<?php reloadFN()?>"/>
                              <label>Avatar:</label> 
                              <input type="file" name="hinhanh" id="hinhanh"/>
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
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>