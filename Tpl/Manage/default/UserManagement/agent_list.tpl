<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
   <script type="text/javascript">
   $(function() {
	   layui.use(['form'], function(){
		   	var form = layui.form;
		   	//自定义验证规则
			form.verify({
				/* mbstatus: function(value){
		  			if($.trim(value)== ""){
		    			return '请选择管理后台状态';
		  			}
				} */
			});

			form.on('submit(go)', function(data) {
			
			});
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
		  <a><cite>用户管理</cite></a>
		</div>
        <!-- 面包屑导航 end -->
       
        <!-- 正文部分 begin -->
        <div class="ui-content" id="ui-content">
        
	        <div class="ui-panel" style="height: 595px;">
				<blockquote class="layui-elem-quote bg-info">
					总用户： <span>{$total_num|default=0}</span>
					有效用户：<span class="danger">{$active_num|default=0}</span>
					无效用户：<span>{$invalid_num|default=0}</span>
					资金池低于10000 的用户：<span>{$pool_less10000|default=0}</span>
				</blockquote>           
	            <!-- 站点效果挂件 begin -->
	       		{:W('UserList', array( 'list' => $list, 'skin' => 'manage', 'returnUrl' => $CURRENT_URL))}	
				<!-- 站点效果挂件 end -->	
			</div>
	        	
			
        </div>
        <!-- 正文部分 end -->
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
</html>
