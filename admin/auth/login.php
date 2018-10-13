<?php
   ob_start();
   session_start();
   require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php';
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đăng nhập</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/templates/public/loginform/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/css/util.css">
	<link rel="stylesheet" type="text/css" href="/templates/public/loginform/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('/templates/public/loginform/images/bg-01.jpg');">
			<div class="wrap-login100">
			<?php
                  if(isset($_POST['submit'])){
                  	$name = $_POST['username'];
                  	$pass = md5($_POST['pass']);
                  	$queryLogin = "SELECT * 
                  					FROM users 
                  					WHERE username = '{$name}' && password = '{$pass}'";
                  	$resultLogin = $mysqli->query($queryLogin);
                  	$arLogin = mysqli_fetch_assoc($resultLogin);
                  	$active = $arLogin['active'];
                  	if($arLogin)
                  		{
                  			if($active==1){
                  				$_SESSION['userinfo'] = $arLogin;
                  				header("location:/admin/index.php");
                  			}else{
                  				 echo '<script>alert("Tài khoản này dã bị vô hiệu hóa!!!")</script>';
                  			}
                  		}
                  	else
                  		{
                  			 echo '<script>alert("Sai Tên Đăng Nhập hoặc Mật Khẩu.Vui lòng kiểm tra lại!!!")</script>';
                  		}
                  }
                  
                  ?>
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-logo">
						<img src="/templates/public/loginform/images/Capture.PNG" width="82%"/>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit">
							Đăng nhập
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Quên mật khẩu
						</a>
					</div>
					<a class="txt1" href="/trang-chu">
							<- Quay về trang chủ
						</a>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/templates/public/loginform/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/loginform/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/loginform/vendor/bootstrap/js/popper.js"></script>
	<script src="/templates/public/loginform/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/loginform/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/loginform/vendor/daterangepicker/moment.min.js"></script>
	<script src="/templates/public/loginform/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/loginform/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/loginform/js/main.js"></script>

</body>
</html>
<?php
   ob_end_flush();
   ?>