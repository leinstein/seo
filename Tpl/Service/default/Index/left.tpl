<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "菜单";</php>
<head>
<include file="../Public/header" />
<script>
	self.parent.frames['main'].location = "{:U('User/index')}";
	$type = "a";
</script>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>菜单</title>
</head>
<body>
	<div id="sidebar" class="sidebar">
		<div class="sidebar-menu nav-collapse">
			<ul>
				<!-- SIDEBAR MENU -->
				<li>
					<a href="{:U('Index/home')}" target="main">
					<i class="iconfont">&#xe60a;</i>
					<span class="menu-text">产品首页</span>
					</a>
				</li>

				<li><a href="{:U('Site/index')}" target="main">
				<i class="iconfont">&#xe633;</i>
				<span class="menu-text">我的站点</span></a>
				</li>

				<li class="has-sub">
					<a href="javascript:;">
						<i class="iconfont">&#xe673;</i>
						<span class="menu-text">优化中心</span>
						<span class=""><i class="iconfont">&#xe618;</i></span>
					</a>
					<ul class="sub">
						<li><a class="" href="{:U('Keyword/add')}" target="main"><span
								class="sub-menu-text" id="toplink1" onclick="dj('1');">关键词购买</span></a></li>
						<li><a class="" href="{:U('Cart/index')}" target="main"><span
								class="sub-menu-text" id="toplink2" onclick="dj('2');">购物车</span></a></li>
						<li>
							<a class="" href="{:U('Site/effect')}" target="main">
							<span class="sub-menu-text" id="toplink3" onclick="dj('3');">站点效果监测</span></a>
						</li>
						<li>
							<a class="" href="{:U('Keyword/effect')}" target="main">
							<span class="sub-menu-text" id="toplink4" onclick="dj('4');">关键词效果监测</span></a>
						</li>
					</ul>
				</li>
				<!-- <li>
					<a href="{:U('Finance/index')}" target="main">
						<i class="iconfont">&#xe623;</i>
						<span class="menu-text">财务管理</span>
					</a>
				</li> -->
			</ul>
			<!-- /SIDEBAR MENU -->
		</div>
	</div>
	<script>
		function dj(t) {
			//alert(t);

			$("#toplink" + t).addClass("sub-menu-text active");

		}
	</script>


	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="../Public/js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<!--<script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>-->
	<!-- BOOTSTRAP -->
	<script src="../Public/js/bootstrap/bootstrap.min.js"></script>


	<!-- DATE RANGE PICKER -->
	<!--<script src="js/bootstrap-daterangepicker/moment.min.js"></script>-->

	<!--<script src="js/bootstrap-daterangepicker/daterangepicker.min.js"></script>-->
	<!-- SLIMSCROLL -->
	<!--<script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script><script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>-->
	<!-- COOKIE -->
	<script type="text/javascript" src="../Public/js/jquery/jquery.cookie.min.js"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="../Public/js/admin/script.js"></script>
	<script>
		jQuery(document).ready(function() {
			App.init(); //Initialise plugins and elements
		});
	</script>
	<!-- /JAVASCRIPTS -->

</body>
</html>