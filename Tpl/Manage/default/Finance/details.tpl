<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
   <script type="text/javascript">
   $(function() {
	   layui.use(['element'], function(){
		   var $ = layui.jquery
		   ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
		   
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
    <include file="../Public/left_home" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
    
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('Index/index')}"><i class="iconfont">&#xe60a;</i>产品首页<span class="layui-box">&gt;</span></a>
		  <a><cite>财务明细</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
        	
	        	<!-- <blockquote class="layui-elem-quote">
					总用户： <span>{$total_num|default=0}</span>
					有效用户：<span class="danger">{$active_num|default=0}</span>
					无效用户：<span>{$invalid_num|default=0}</span>
					资金池低于10000 的用户：<span>{$pool_less10000|default=0}</span>
				</blockquote>     -->  
				<div class="layui-tab layui-tab-brief">
				  <ul class="layui-tab-title">
				    <li class="layui-this">充值记录</li>
				  </ul>
				  <div class="layui-tab-content">
				    <div class="layui-tab-item layui-show">
				       	<!-- 站点效果挂件 begin -->
			       		{:W('RechargeList', array( 'list' => $list))}	
						<!-- 站点效果挂件 end -->	
				    </div>
				  </div>
				</div>
     
	           
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>