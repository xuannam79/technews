<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBConnectionUtil.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUlti.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Liên hệ</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/templates/public/img/imagesContact/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/vendor/vendorContact/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/fonts/fontsContact/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/fonts/fontsContact/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/vendor/vendorContact/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/vendor/vendorContact/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/vendor/vendorContact/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/vendor/vendorContact/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/vendor/vendorContact/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/public/css/cssContact/util.css">
	<link rel="stylesheet" type="text/css" href="/templates/public/css/cssContact/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
							
		<div class="contact100-map" id="google_map" data-map-x="16.0651627" data-map-y="108.1500389" data-pin="/templates/public/img/imagesContact/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<button class="contact100-btn-show">
			<i class="fa fa-envelope-o" aria-hidden="true"></i>
		</button>

		<div class="wrap-contact100">
			<button class="contact100-btn-hide">
				<i class="fa fa-close" aria-hidden="true"></i>
			</button>
			<?php
				if(isset($_POST['submitC']))
				{
					 $email = $_POST['emailC'];
					$name = $_POST['nameC'];
					$message = $_POST['messageC'];
					$query = "INSERT INTO contact(email,name,message) VALUES('$email','$name','$message')";
					$result = $mysqli->query($query);
					if($result){
							echo '<script>alert("Cám ơn bạn đã liên hệ !!!")</script>';
						}
						else{
							echo '<script>alert("Có lỗi, kiểm tra lại !!!")</script>';
						}
				}
				if(isset($_POST['back'])){
					header("location:/index.php");
				}
			?>
			<form class="contact100-form validate-form" method="post">
				<span class="contact100-form-title">
					Liên hệ tôi
				</span>

				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Nhập tên">
					<span class="label-input100">Tên bạn</span>
					<input class="input100" type="text" name="nameC" placeholder="Nhập tên của bạn">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate = "Nhập email dạng: ex@abc.xyz">
					<span class="label-input100">Email</span>
					<input class="input100" type="text" name="emailC" placeholder="Nhập địa chỉ email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Nhập nội dung">
					<span class="label-input100">Lời nhắn</span>
					<textarea class="input100" name="messageC" placeholder="Để lại tin nhắn ở đây..."></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" name="submitC">
						<span>
							Gửi đi
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
				
			</form>
			<form class="back" method="post">
			<div class="container-contact100-form-btn" style="position: absolute;bottom: 123px;left: 830px;">
					<button class="contact100-form-btn" name="back">
						<span>
							Trang chủ
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
			<span class="contact100-more">
				Đối với bất kỳ câu hỏi nào, hãy liên hệ: <span class="contact100-more-highlight">+84 906498644</span>
			</span>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="/templates/public/vendor/vendorContact/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/vendor/vendorContact/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/vendor/vendorContact/bootstrap/js/popper.js"></script>
	<script src="/templates/public/vendor/vendorContact/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/vendor/vendorContact/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/vendor/vendorContact/daterangepicker/moment.min.js"></script>
	<script src="/templates/public/vendor/vendorContact/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/vendor/vendorContact/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="/templates/public/js/jsContact/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="/templates/public/js/jsContact/main.js"></script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
