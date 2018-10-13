<?php
   session_start();
   ob_start();
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUlti.php'; 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/checkUser.php';
   ?>
<?php
   $status = $_POST['astatus'];
   $acl = $_POST['acl'];
   if ($status == 1) {	
   	?>
<a href="javascript:void(0)" onclick="return setStatus(0, '<?php echo $acl?>')">
<img src="/templates/admin/assets/img/deactive.gif" alt="" />
</a>
<?php
   $query = "UPDATE cat SET status=0 WHERE cat_id = {$acl}";
   } else if ($status == 0) {
   ?>
<a href="javascript:void(0)" onclick="return setStatus(1, '<?php echo $acl?>')">
<img src="/templates/admin/assets/img/active.gif" alt="" />
</a>
<?php
   $query = "UPDATE cat SET status=1 WHERE cat_id = {$acl}";
   }
   $result = $mysqli->query($query);
   ?>
<?php ob_end_flush();?>