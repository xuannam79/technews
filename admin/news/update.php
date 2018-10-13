<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa Tin tức</h2>
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
							$queryKTHA = "select * from news where news_id = {$idSua}";
							$resultKTHA = $mysqli->query($queryKTHA);
							$arKTHA = mysqli_fetch_assoc($resultKTHA);
							$picture = $arKTHA['picture'];
							if(isset($_POST['submit'])) {
									$tenTT = $_POST['tenTT'];
										$cat_id = $_POST['cat_id'];
										$hinhAnh = $_FILES['hinhAnh'];
										$moTa = $_POST['moTa'];
										$chiTiet = $_POST['chiTiet'];
										$tenHinhAnh = $hinhAnh['name'];
										if($_POST['xoa']!=''){
											$queryHA = "select * from news where news_id = {$idSua}";
											$resultHA = $mysqli->query($queryHA);
											$arHA = mysqli_fetch_assoc($resultHA);
											$patch_uploadHA = $_SERVER['DOCUMENT_ROOT'].'/files/'.$arHA['picture'];
											unlink($patch_uploadHA);
										}
									$queryValidateName = "SELECT name FROM news WHERE name = '{$tenTT}' AND name<>(SELECT name FROM news WHERE news_id = {$idSua})";
									$resultValidateName = $mysqli->query($queryValidateName);
									if(mysqli_num_rows($resultValidateName)>0){
										echo '<script>alert("Tên tin tức đã tồn tại")</script>';
									} 
									else{
										if($_FILES['hinhAnh']['error'] <= 0)
										{
											$queryHA = "select * from news where news_id = {$idSua}";
											$resultHA = $mysqli->query($queryHA);
											$arHA = mysqli_fetch_assoc($resultHA);
											$patch_uploadHA = $_SERVER['DOCUMENT_ROOT'].'/files/'.$arHA['picture'];
											unlink($patch_uploadHA);
											
											$nametmp = explode('.',$tenHinhAnh);
											$duoifile = end($nametmp);
											$tenfile = 'HinhAnh-'.time().'.'.$duoifile;
											$tmp_name = $hinhAnh['tmp_name'];
											$path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$tenfile;
											move_uploaded_file($tmp_name,$path_upload);
											
											$query2 ="UPDATE news SET name = '{$tenTT}' , preview ='{$moTa}', detail = '{$chiTiet}', picture='{$tenfile}',cat_id = {$cat_id} WHERE news_id = {$idSua}";
											$result1 = $mysqli->query($query2);
														
											if($result1){
													header("location:index.php?tab=3&msg=Sửa Thành Công!");
													die();
											} else {
													echo "có lỗi khi sửa người dùng";
													die();
											} 
										}
										else{
											$query2 ="UPDATE news SET name = '{$tenTT}' , preview ='{$moTa}', detail = '{$chiTiet}',cat_id = {$cat_id} WHERE news_id = {$idSua}";
											$result1 = $mysqli->query($query2);
														
											if($result1){
													header("location:index.php?tab=3&msg=Sửa Thành Công!");
													die();
											} else {
													echo "có lỗi khi sửa người dùng";
													die();
											} 
										}
									}
									
							}
						?>	
							
                                <form role="form" action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Tên tin tức</label>
                                        <input type="text" name="tenTT" value="<?php echo $arKTHA['name'] ?>" class="form-control" required="">
                                    </div>
									<div class="form-group">
                                        <label>Danh mục tin tức</label>
										<select class="form-control" name="cat_id" required="">
										<?php
											$queryCombo = "SELECT * FROM cat ORDER BY cat_id DESC";
											$resultCombo = $mysqli->query($queryCombo);
											while($row = mysqli_fetch_assoc($resultCombo)) {
												$name = $row['name'];
												$cat_id_combo = $row['cat_id'];
												if($cat_id_combo == $arKTHA['cat_id']) {
												?>
												<option selected value="<?php echo $cat_id_combo ?>"><?php echo $name ?></option>
												<?php
												} else {
										?>
											<option value="<?php echo $cat_id_combo ?>"><?php echo $name ?></option>
												<?php }
											} ?>
                                        </select>
                                    </div>
									<div class="form-group">
                                        <label>Hình ảnh</label>
										<input type="file" name="hinhAnh"><br/>
										<input type="checkbox" name="xoa"><label>Xóa ảnh cũ</label><br/>
										<img src="/files/<?php 
											echo $picture;
										?>" style="height: 60px;width: 60px;"/>
                                    </div>
									<div class="form-group">
                                        <label>Mô tả</label>
										<textarea class="form-control" rows="3" name="moTa" required=""><?php echo $arKTHA['preview']?></textarea>
                                    </div>
									<div class="form-group">
                                        <label>Chi tiết</label>
										<textarea class="form-control ckeditor" rows="5" name="chiTiet"><?php echo $arKTHA['detail']?></textarea>
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
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>
