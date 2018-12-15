<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<!-- 引入文章新聞類樣式文件 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/news.css">
<script>
</script>
</head>
<body>
 	<!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left_home" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
       <!-- 面包屑导航 begin -->
       
		<div class="ui-breadcrumb">
		 <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>文章列表</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
       	 	<div class="ui-panel">	 
        		{:W('NewsList', array( 'list' => $list ))}		   
			</div>
		</div>
	</div>	

	<!-- 页面底部 begin  -->
	<include file="../Public/footer"/>
	<!-- 页面底部 end  -->
	
</body>
</html>