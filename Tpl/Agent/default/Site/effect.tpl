<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<!-- tips插件 -->
<link rel="stylesheet" href="../Public/css/tipso.min.css">
<script src="../Public/js/tipso.min.js"></script>
   <script type="text/javascript">
   $(function() {
	layui.use(['form'], function(){
	  var form = layui.form;
	  
	  
	});
	
	$('.tip').tipso({

		position : 'right',
		useTitle: false

	});
});
   </script>
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
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>站点效果</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
	            <div class="ui-panel">	            
		            <!-- 站点效果挂件 begin -->
		       		{:W('SiteEffect', array( 'list' => $list))}	
					<!-- 站点效果挂件 end -->	
				</div>
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>