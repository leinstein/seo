<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "菜单";</php>
<head>
<include file="../Public/header" />
<script>
	self.parent.frames['main'].location = "{:U('Index/home')}";
	$type = "a";
</script>

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
				
				<eq name="LoginUserInfo['usertype']" value="admin">
					<li>
						<a href="{:U('UserManagement/index')}" target="main">
						<i class="iconfont">&#xe65f;</i>
						<span class="menu-text">用户管理</span>
						</a>
					</li>
				</eq>
				
				<eq name="LoginUserInfo['usertype']" value="operation">
				
					<li>
						<a href="{:U('Site/index')}" target="main">
							<i class="iconfont">&#xe674;</i>
							<span class="menu-text">站点管理</span>
						</a>
					</li>
					
					
					<li class="has-sub">
						<a href="javascript:;">
							<i class="iconfont">&#xe607;</i>
							<span class="menu-text">关键词管理</span>
							<span class=""><i class="iconfont">&#xe618;</i></span>
						</a>
						<ul class="sub">
							<li>
								<a class="" href="{:U('Cart/index')}" target="main">
									<span class="sub-menu-text" id="toplink1" onclick="dj('1');">关键词清单</span>
								</a>
							</li>
							<li>
								<a class="" href="{:U('Keyword/index')}" target="main">
									<span class="sub-menu-text" id="toplink2" onclick="dj('2');">关键词审核</span>
								</a>
							</li>
							<!-- <li>
								<a class="" href="{:U('Keyword/index')}/keywordstatus/优化中/operate/adjust_price" target="main">
									<span class="sub-menu-text" id="toplink3" onclick="dj('3');">关键词价格调整</span>
								</a>
							</li> -->
						</ul>
					</li>
				</eq>
				
				<li class="has-sub">
					<a href="javascript:;">
						<i class="iconfont">&#xe7b2;</i>
						<span class="menu-text">效果监控</span>
						<span class=""><i class="iconfont">&#xe618;</i></span>
					</a>
					<ul class="sub">
							
						<li>
							<a class="" href="{:U('Site/effect')}" target="main">
								<span class="sub-menu-text" id="toplink3" onclick="dj('3');">站点效果监测</span>
							</a>
						</li>
						<li>
							<a class="" href="{:U('Keyword/effect')}" target="main">
								<span class="sub-menu-text" id="toplink4" onclick="dj('4');">关键词效果监测</span>
							</a>
						</li>
					</ul>
				</li>
				
				
				
				<!-- <li>
					<a href="{:U('Keyword/detect')}" target="main">
					<i class="iconfont">&#xe616;</i>
					<span class="menu-text">关键词检测</span></a>
				</li>  -->
				
				<eq name="LoginUserInfo['usertype']" value="admin">
				<li class="has-sub">
					<a href="javascript:;" class="">
						<i class="iconfont">&#xe623;</i>
						<span class="menu-text">财务管理</span>
						<span class=""><i class="iconfont">&#xe618;</i></span>
					</a>
					<ul class="sub">
						<li>
							<a class="" href="{:U('Finance/pool')}" target="main">
								<span class="sub-menu-text" id="toplink1" onclick="dj('1');">资金池管理</span>
							</a>
						</li>
						<li>
							<a class="" href="{:U('Finance/details')}" target="main">
								<span class="sub-menu-text" id="toplink2" onclick="dj('2');">财务明细</span>
							</a>
						</li>
						<!-- <li>
							<a class="" href="{:U('Finance/record')}" target="main">
								<span class="sub-menu-text" id="toplink3" onclick="dj('3');">充值记录</span>
							</a>
						</li> -->
						<li>
							<a class="" href="{:U('Finance/agentUsers')}" target="main">
								<span class="sub-menu-text" id="toplink4" onclick="dj('4');">一级代理充值</span>
							</a>
						</li>
					</ul>
				</li>
				</eq>
				
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