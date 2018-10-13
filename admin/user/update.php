<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Sửa Người Dùng</h2>
         </div>
      </div>
      <!--/. ROW  -->
      <?php if(isset($_GET['msg'])){
         echo "<script>".$_GET['msg']."</script>";
         }?>
      <div class="row">
         <div class="col-md-12">
            <?php 
               $id = $_GET["idupdate"];
               $query = "SELECT * FROM users WHERE user_id = ".$id;
               $result = $mysqli->query($query);
               $arUser = mysqli_fetch_assoc($result);
               $avatar = $arUser['avatar'];
               if(isset($_POST['submit'])){
               		$username = $_POST['username'];
               		$password = md5($_POST['password']);
               		$fullname = $_POST['fullname'];
               		if($_POST['xoa']!=''){
               			$patch_uploadXoaHA = $_SERVER['DOCUMENT_ROOT'].'/files/User_img/'.$avatar;
               			unlink($patch_uploadXoaHA);
               		}
               		if($_FILES['hinhAnh']['error'] <= 0)
               		{
               			$queryHA = "select * from users where user_id = {$id}";
               			$resultHA = $mysqli->query($queryHA);
               			$arHA = mysqli_fetch_assoc($resultHA);
               			$patch_uploadHA = $_SERVER['DOCUMENT_ROOT'].'/files/User_img/'.$arHA['avatar'];
               			unlink($patch_uploadHA);
               			
               			$namefile = $_FILES['hinhAnh']['name'];							
               			$picture=$namefile;
               			$time = time();
               			$arr = explode('.',$picture);
               			$duoifile= end($arr);;
               			$fileAnh = 'HinhAnh-'.$time.'.'.$duoifile;
               			/*lấy thông tin ảnh */
               			$tmp_name = $_FILES['hinhAnh']['tmp_name'];
               			//lấy đường dẫn gốc của host
               			$path_root = $_SERVER["DOCUMENT_ROOT"];
               			//tạo đường dẫn đầy đủ
               			$path_upload = $path_root.'/files/User_img/'.$fileAnh;
               			//thực hiện upload lên host
               			move_uploaded_file($tmp_name,$path_upload);
               			
               			
               						
               		
               			$query1 ="UPDATE users SET fullname = N'{$fullname}', password = '{$password}', avatar='{$fileAnh}' WHERE user_id = {$id}";
               			$result1 = $mysqli->query($query1);			
               			if($result1){
               					header("location:index.php?tab=4&msg=Sửa Thành Công!");
               			} else {
               					echo "có lỗi khi sửa người dùng";
               					die();
               			}
               		}
               		else{
               			
               				$query1 ="UPDATE users SET fullname = N'{$fullname}', password = '{$password}' WHERE user_id = {$id}";
               				$result1 = $mysqli->query($query1);			
               				if($result1){
               						header("location:index.php?tab=4&msg=Sửa Thành Công!");
               				} else {
               						echo "có lỗi khi sửa người dùng";
               						die();
               				}
               		}
               		
               		
               		
               }
               ?>
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12">
                        <form role="form" id="form" name="form" method="post" enctype="multipart/form-data">
                           <div class="form-group">
                              <label>Username</label>
                              <input type="text" name="username" class="form-control" value='<?php echo $arUser['username'];?>' readonly/>
                              <label>Password</label>
                              <input type="password" name="password" class="form-control"value='<?php echo $arUser['password'];?>'/>
                              <label>Fullname</label>
                              <input type="text" name="fullname" class="form-control" value="<?php echo $arUser['fullname'];?>"/>
                              <label>Avatar </label>
                              <input type="file" name="hinhAnh">
                              <input type="checkbox" name="xoa"><label>Xóa ảnh cũ</label><br/>
                              <img src="/files/User_img/<?php 
                                 echo $avatar;
                                 ?>" style="height: 60px;width: 60px;"/>
                           </div>
                           <button type="submit" name="submit" class="btn btn-success btn-md">Lưu</button>
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