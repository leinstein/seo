<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "客户端";</php>
<head>
<include file="../Public/header" />

<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">

<style>
body, h1, h2, h3, h4, h5, h6 {
	font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei",
		"Hiragino Sans GB", "Heiti SC", "WenQuanYi Micro Hei", sans-serif;
	!
	important;
}

@media screen and (max-width: 990px) {
	.logo_img {
		display: none;
	}
}
</style>

</head>
<body>
	<!-- HEADER -->
	<header class="navbar clearfix" id="header">
		<div class="container" style="padding-right: 0;">
			<div class="navbar-brand logo_img">
				<!-- 公司logo begin -->
				<a href="{:U('Index/home')}" target="main">
					<img src="__PUBLIC__/img/logo-white.png" alt="" class="img-responsive">
				</a>
				<!-- 公司logo end -->
				
				<!-- TEAM STATUS FOR MOBILE -->
				<div class="visible-xs">
					<a href="#" class="team-status-toggle switcher btn dropdown-toggle">
						<i class="fa fa-users"></i>
					</a>
				</div>
				<!-- /TEAM STATUS FOR MOBILE -->
				<!-- SIDEBAR COLLAPSE -->
				<!-- <div id="sidebar-collapse" class="sidebar-collapse btn">
                <i class="fa fa-bars"
                   data-icon1="fa fa-bars"
                   data-icon2="fa fa-bars" ></i>
            </div>-->
				<!-- /SIDEBAR COLLAPSE -->
			</div>
			<!-- NAVBAR LEFT -->
			<style>
#navbar-left {
	
}

#navbar-left a.active {
	background-color: #1890BD !important;
}
</style>
			<ul class="nav navbar-nav pull-left hidden-xs" id="navbar-left">
				<li>
					<a name="toplink" id="toplink1" href="{:U('Index/left')}" class="dropdown-toggle  active" target="menu" onclick="dj('1');">
						<span class="name">网站优化管理</span>
					</a>
				</li>



				<!-- <li><a name="toplink" id="toplink2" href="menumb.php?type=b"
					class="dropdown-toggle " target="menu" onclick="dj('2');"> <span
						class="name">搜索通</span>
				</a></li>





				<li><a name="toplink" id="toplink3" href="menumb.php?type=g"
					class="dropdown-toggle " target="menu" onclick="dj('3');"> <span
						class="name">问答通</span>
				</a></li>





				<li><a name="toplink" id="toplink4" href="menumb.php?type=j"
					class="dropdown-toggle " target="menu" onclick="dj('4');"> <span
						class="name">新闻通</span>
				</a></li> -->





				<script>
					//$("#toplink1").addClass("dropdown-toggle active");
					function dj(t) {
						//alert(t);
						$("#toplink1").removeClass("dropdown-toggle active");
						$("#toplink1").addClass("dropdown-toggle");

						$("#toplink2").removeClass("dropdown-toggle active");
						$("#toplink2").addClass("dropdown-toggle");

						$("#toplink3").removeClass("dropdown-toggle active");
						$("#toplink3").addClass("dropdown-toggle");

						$("#toplink4").removeClass("dropdown-toggle active");
						$("#toplink4").addClass("dropdown-toggle");

						$("#toplink5").removeClass("dropdown-toggle active");
						$("#toplink5").addClass("dropdown-toggle");

						$("#toplink" + t).addClass("dropdown-toggle active");

					}
				</script>


			</ul>
			<!-- /NAVBAR LEFT -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<!-- <li class="dropdown " id="header-notification">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                    <span class="badge">7</span>
                </a>
            </li> -->
				<li class="dropdown"><a
					href="tencent://Message/?Menu=YES&amp;Uin=735283159&amp;websiteName=im.qq.com"
					target="_blank" class="dropdown-toggle"> 在线客服:735283159 </a></li>

				<!-- <li class="dropdown ">
                <a href="/help.php" target="_blank" class="dropdown-toggle" >
                   帮助中心
                </a>
            </li> -->
				<li class="dropdown user " id="header-user">
					<a href="{:U('User/updatePage')}" class="dropdown-toggle" target="main" title="点击修改账户信息">
					<img alt="" src="../Public/img/avatar3.jpg">
					<span class="username">{$LoginUserName}</span></a> <!--<i class="fa fa-angle-down"></i>-->
				</li>
				<li>
					<a href="javascript:void(0)" onclick="logOut();" class="dropdown-toggle" data-toggle="dropdown"> <span>注销</span></a>
				</li>
			</ul>
		</div>

		<script type="text/javascript">
			function tiaosy() {
				/*
				 var GoUrl = "main.php";//这里是要模拟点击的网站。
				 var tiaozhuan = document.getElementById("tiaozhuan");
				 tiaozhuan.href = GoUrl;
				 tiaozhuan.click();//模拟click动作
				 */
			}
			
			
			function logOut() {
				top.location.href = "{:U('Index/logOut')}";
				
			}
		</script>

	</header>
	<!--/HEADER -->



</body>
</html>