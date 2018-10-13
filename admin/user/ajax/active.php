<?php
   session_start();
   ob_start();
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUlti.php'; 
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/checkUser.php';
   ?>
<?php
   $active = $_POST['aactive'];
   $cl = $_POST['acl'];
   if ($active == 1) {	
   	?>
<a href="javascript:void(0)" onclick="return setActive(0, '<?php echo $cl?>')">
<img src="/templates/admin/assets/img/deactive.gif" alt=""/>
</a>
<?php
   $query = "UPDATE users SET active=0 WHERE user_id = {$cl}";
   } else if ($active == 0) {
   ?>
<a href="javascript:void(0)" onclick="return setActive(1, '<?php echo $cl?>')">
<img src="/templates/admin/assets/img/active.gif" alt=""/>
</a>
<?php
   $query = "UPDATE users SET active=1 WHERE user_id = {$cl}";
   }
   $result = $mysqli->query($query);
   ?>
<?php ob_end_flush();?>