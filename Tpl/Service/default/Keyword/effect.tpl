<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<link rel="stylesheet" href="../Public/css/tipso.min.css">
<script src="../Public/js/tipso.min.js"></script>
<script type="text/javascript">
$(function() {
	
	layer_tips
	$('.tip').tipso({

		position : 'right',
		useTitle: false

	});
});
</script>
<style type="text/css">
.tooltip {
	
}

.tooltip-inner {
	background-color: #fff !important;
	color: #666 !important;
	line-height: 1.5;
	border: 1px solid #aaa;
}
</style>
</head>
<tagLib name="html" />
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
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>{$LoginUserInfo['oem_config']['product_name']|default='网站优化'}<span class="layui-box">&gt;</span></a>
		  <a><cite>关键词排名</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
	            <!-- 关键词效果挂件 begin -->
				{:W('KeywordEffect', array( 'list' => $data['record']['list'],'data'=>$data ))}
				<!-- 关键词效果挂件 end -->		
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>
