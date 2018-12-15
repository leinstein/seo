<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <include file="../Public/header" />
   
    <script>
	$(function() {
		
	});
	

	</script>
</head>
<tagLib name="html" />
<body>
    <!-- 页面顶部 logo & 菜单 begin -->
    <include file="../Public/top_banner" />
    <!-- 页面顶部 logo & 菜单 end -->
    <!-- 页面左侧菜单 begin -->
    <include file="../Public/left_qr" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('QRIndex/index')}"><i class="iconfont">&#xe60a;</i> 首页<span class="layui-box">&gt;</span></a>
		  <a href="{:U('QRReport/index')}">报表列表<span class="layui-box">&gt;</span></a>
		  <a><cite>报表详情</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	
        	
        		<!-- 报表详情列表 挂件 begin -->
				{:W('QRReportDetailList', array( 'data'=>$data , 'list' => $list,'returnUrl' => $CURRENT_URL ))}
				<!-- 报表详情 挂件 end -->
				 
			</div>	
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>


