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
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>{$LoginUserInfo['oem_config']['product_name']|default='优站宝'}<span class="layui-box">&gt;</span></a>
		  <a><cite>基本信息</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
        	<div class="ui-panel">	 
	            <form  name="update_form" class="layui-form" action="__URL__/update" method="post" onkeydown="if(event.keyCode==13){return false;}">
					<include file="tpl/page_user"/>
					<div class="layui-form-item">
						<div class="layui-input-block">
							<button class="layui-btn" lay-submit="" lay-filter="go">修改帐号资料</button>
						</div>
					</div>
				</form>
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>