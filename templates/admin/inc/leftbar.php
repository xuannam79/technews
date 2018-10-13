<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
		<?php
				if(isset($_SESSION['userinfo'])) {
				$arUserInfo = $_SESSION['userinfo'];
				$avatar = $arUserInfo['avatar'];
				$username = $arUserInfo['username'];
			?>
            <li class="text-center">
                <img src="/files/User_img/<?php echo $avatar; ?>" class="user-image img-responsive"/>
            </li>
			<?php 
				}
			?>
           

            <li>
                <a  href="/admin/index.php?tab=1" id="1"><i class="fa fa-dashboard fa-3x"></i> Trang chủ</a>
            </li>
			<?php
				if($username=='admin'){
			?>
            <li>
                <a href="/admin/category/index.php?tab=2" id="2"><i class="fa fa-bar-chart-o fa-3x"></i> Quản lý danh mục</a>
            </li>
            <li>
                <a href="/admin/news/index.php?tab=3" id="3"><i class="fa fa-qrcode fa-3x"></i> Quản lý tin tức</a>
            </li>
            <li>
                <a href="/admin/user/index.php?tab=4" id="4"><i class="fa fa-sitemap fa-3x"></i> Quản lý người dùng</a>
            </li>
			<li>
                <a href="/admin/contact/index.php?tab=5" id="5"><i class="fa fa-sitemap fa-3x"></i> Quản lý liên hệ </a>
            </li>
			<li>
                <a href="/admin/comment/index.php?tab=6" id="6"><i class="fa fa-sitemap fa-3x"></i> Quản lý bình luận</a>
            </li>
				<?php }else {?>
			<li>
                <a href="/admin/news/index.php?tab=3" id="3"><i class="fa fa-qrcode fa-3x"></i> Quản lý tin tức</a>
            </li>
				<?php }?>
        </ul>

    </div>

</nav>
<!--/. NAV SIDE  -->