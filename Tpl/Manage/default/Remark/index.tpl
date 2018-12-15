<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />

<script type="text/javascript">
	$(function() {
		
	});
</script>
</head>
<tagLib name="html" />
<body>

	<!-- 页面顶部 logo & 菜单 begin  -->
	<include file="../Public/top_banner"/>
	<!-- 页面顶部 logo & 菜单 end  -->

	<!-- 页面左侧菜单 begin  -->
	<include file="../Public/left_wo"/>
	<!-- 页面左侧菜单 end  -->

	<!--内容区域 begin -->
	<div class="ui-module">
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="__URL__/index"><i class="iconfont">&#xe60a;</i>首页<span class="layui-box">&gt;</span></a>
		  <a><cite>日志列表</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">
        	
				<h3 class=" mb20">
			 		<a class="layui-btn" href="javascript:;" onclick="open_layer('添加日志','{:U('insertPage')}/productid/{$Think.get.productid}/objecttype/{$Think.get.objecttype}/objectid/{$Think.get.objectid}/touserid/{$Think.get.touserid}/tousername/{$Think.get.tousername|urlencode}/level/2&returnUrl={$Think.get.returnUrl|urlencode}','50%')"><i class="iconfont">&#xe68b;</i> 添加日志</a>
			 	</h3>	
			 	
	        	<!-- 站点列表挂件 begin -->
				{:W('RemarkList', array( 'list' => $list, 'query_params'=>$query_params, 'returnUrl' => $CURRENT_URL , 'me' => $LoginUserInfo))}
				<!-- 站点列表挂件 end -->	
					
	             
			</div> 
        </div>
    </div>
    <!--内容区域 end -->
    
	<!-- 页面底部 begin  -->
	<include file="../Public/footer"/>
	<!-- 页面底部 end  -->
</body>
</html>
