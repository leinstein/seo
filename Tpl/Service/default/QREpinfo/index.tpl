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
           layer_confirm('删除后该计划无法恢复，您确认删除么？',
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
    <include file="../Public/left_qr" />
    <!-- 页面左侧菜单 end -->
    <!--内容区域 begin -->
    <div class="ui-module">
        <!-- 面包屑导航 begin -->
		<div class="ui-breadcrumb">
		  <a href="{:U('QRIndex/index')}"><i class="iconfont">&#xe60a;</i> 首页<span class="layui-box">&gt;</span></a>
		  <a><cite>企业资料</cite></a>
		</div>
        <!-- 面包屑导航 end -->
        <div class="ui-content" id="ui-content">
        
        	<div class="ui-panel">	 
	            
				<form class="layui-form" action="{:U('maintain')}" method="post">
				
					<div class="layui-form-item">
						<label class="layui-form-label required">企业名称</label>
						<div class="layui-input-block">
							<input type="text" name="epname" value="{$data['epname']}" lay-verify="required" placeholder="20个字符以内,展示在百度搜索结果标题部分" autocomplete="off" class="layui-input">
						</div>
						
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">站点描述</label>
						<div class="layui-input-block">
							<textarea name="sitedesc" placeholder="60个字符以内,展示在百度搜索结果创意描述部分" class="layui-textarea">{$data['sitedesc']}</textarea>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label required">电脑端网页</label>
						<div class="layui-input-block">
							<input type="text" name="site_pc" value="{$data['site_pc']}" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
						</div>
					</div>
											
					<!-- <div class="layui-form-item">
						<label class="layui-form-label">移动端网页</label>
						<div class="layui-input-block">
							<input type="text" name="site_mobile" value="{$data['site_mobile']}"  autocomplete="off" class="layui-input">
						</div>
					</div> -->
					<eq name="data['can_operate']" value ="1">
					<div class="layui-form-item">
						<div class="layui-input-block">
							<input type="hidden" name="id" value="{$data['id']}">
							<button class="layui-btn" lay-submit="" lay-filter="go">立即提交</button>
						</div>
					</div>
					</eq>
				</form>
			</div>
			
        </div>
    </div>
    <!-- 页面底部 begin -->
    <include file="../Public/footer" />
    <!-- 页面底部 end -->
</body>


