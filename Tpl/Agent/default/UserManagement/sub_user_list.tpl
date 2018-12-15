<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />

<script type="text/javascript">

function deleteRecord( id ){
	layer_confirm('删除后该站点无法恢复，您确认删除么？', function(){ 
	       
   	 window.location.href="__URL__/deleteRecord/id/"+ id;

    });
}
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
		  <a><cite>子用户管理</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	
        		<eq name="list.can_add_user" value="1"> 
         		<h3 class="rwgl">
                  	<a class="layui-btn" href="javascript:;" onclick="open_layer('添加子用户','{:U('insertPage')}/usertype/sub/usergroup/Service&returnUrl={$CURRENT_URL}', '50%')"><i class="iconfont">&#xe68b;</i> 添加子用户</a>
                 </h3>
                 </eq>
	            <!-- 站点效果挂件 begin -->
	       		{:W('UserList', array( 'list' => $list , 'returnUrl' => $CURRENT_URL, 'me' => $LoginUserInfo ))}	
				<!-- 站点效果挂件 end -->	  
			</div> 
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>

</html>
