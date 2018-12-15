<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <include file="../Public/header" />
    
    <script type="text/javascript">
    $(function() {
		layui.use(['form'], function(){
		  var form = layui.form;
		  
		  
		});
	});
        function deleteRecord(id) {
            layer_confirm('删除后该站点无法恢复，您确认删除么？',
                function () {

                    window.location.href = "__URL__/deleteRecord/id/" + id;

                });
        }
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
		  <a><cite>站点管理</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
               <div class="ui-panel">
	                <!-- 站点列表挂件 begin -->
					{:W('SiteList', array( 'list' => $list,'query_params'=>$query_params, 'returnUrl' => $CURRENT_URL_ADD))}
					<!-- 站点列表挂件 end -->	
			</div>
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>
