<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
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
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>用户管理</cite></a>
		</div>
        <!-- 面包屑导航 end -->
       
        <!-- 正文部分 begin -->
        <div class="ui-content" id="ui-content">
        
	        <div class="ui-panel">
	        	<notempty name= "users_less">
				<blockquote class="layui-elem-quote mt20">
					<volist name= "users_less" id="vo">
					<p><i class="iconfont f18 c_lightblue pl0 pr5">&#xe6bc;</i><span>用户<b class="ml10 mr10">{$vo['username']}</b>资金池余额小于一周的消耗，请提醒续费！</span></p>
					</volist>
					
				</blockquote>
				</notempty>
	            <!-- 用户列表挂件 begin -->
	       		{:W('UserList', array( 'list' => $list, 'skin' => 'sub' , 'returnUrl' => $CURRENT_URL, 'me' => $LoginUserInfo))}
				<!-- 用户列表挂件 end -->	
			</div>
	        	
			
        </div>
        <!-- 正文部分 end -->
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>