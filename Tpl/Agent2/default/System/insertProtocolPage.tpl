<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>



<script>

</script>
</head>
<!-- 引入上传组件标签库 begin -->
<taglib name="dupload" />
<!-- 引入上传组件标签库 end -->

<!-- 引入上传组件js和css文件 begin -->
<dupload:script name="dupload"/>
<!-- 引入上传组件js和css文件 end-->
<body class="main-body">
	
	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner"/>
	<!-- 页面顶部 logo & 菜单 end  -->

	<div class="main-wrapper">

		<!-- 页面左侧菜单 begin  -->
		<include file="../Public/left"/>
		<!-- 页面左侧菜单 end  -->
								
		<div class="right-wrapper fr">
	        <div class="main-content" >
	        	
	        	<!-- 面包屑导航 begin -->
	        	<div class="nav-mbx">您当前的位置：<a href="{:U('Index/index')}">优站宝</a> &gt; <a href="">添加协议</a></div>
	        	<!-- 面包屑导航 end -->
	        	
	        	<div class="container pt10">
					<form class="layui-form" name="update_form" action="__URL__/insertNews" enctype="multipart/form-data" method="post" onkeydown="if(event.keyCode==13){return false;}">			
						<input type="hidden" name="newstype" value="protocol">
						<include file="tpl/page"/>
						
					</form>

				</div>               
			</div>
		</div>
	</div>	

	<!-- 页面底部 begin  -->
	<include file="../Public/footer"/>
	<!-- 页面底部 end  -->
	
</body>
</html>
