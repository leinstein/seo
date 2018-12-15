<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>

<!-- 引入上传组件标签库 begin -->
<taglib name="dupload" />
<!-- 引入上传组件标签库 end -->

<!-- 引入上传组件js和css文件 begin -->
<dupload:script name="dupload"/>
<!-- 引入上传组件js和css文件 end-->
</head>
<tagLib name="html" />
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        
		<!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb layui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>添加公告</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
           	<div class="ui-panel">	         
				<form class="layui-form" name="update_form" action="__URL__/insertNews" enctype="multipart/form-data" method="post" onkeydown="if(event.keyCode==13){return false;}">			
					<input type="hidden" name="newstype" value="notice">
					<include file="tpl/page"/>
					
				</form>
			</div>
		</div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>
>
