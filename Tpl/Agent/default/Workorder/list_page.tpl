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
		  <a href="{:U('Workorder/index')}"><i class="iconfont">&#xe60a;</i>首页<span class="layui-box">&gt;</span></a>
		  <a><cite>我的工单</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">
        	
        		<neq name="can_not_add" value="1">
			<h3 class="rwgl mb20">
		 		<a class="layui-btn" href="javascript:;" onclick="open_layer('添加工单','{:U('insertPage')}/productid/{$Think.get.productid}/siteid/{$Think.get.siteid}&returnUrl={$Think.get.returnUrl|urlencode}','50%')"><i class="iconfont">&#xe68b;</i> 发起工单</a>
		 	</h3>	
		 	</neq>
        	<!-- 工单列表挂件 begin -->
			{:W('WorkorderList', array( 'list' => $list, 'query_params'=>$query_params, 'returnUrl' => $CURRENT_URL , 'me' => $LoginUserInfo))}
			<!-- 工单列表挂件 end -->	
					
	             
			</div> 
        </div>
    </div>
    <!--内容区域 end -->
    
	<!-- 页面底部 begin  -->
	<include file="../Public/footer"/>
	<!-- 页面底部 end  -->
</body>
</html>
