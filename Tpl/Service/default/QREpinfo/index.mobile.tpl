<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />
<!-- 引入 echarts begin -->
<!-- 引入 echarts end -->
<script type="text/javascript">
$(function() {
	layui.use(['form'], function(){
	  var form = layui.form;
	  
	  
	});
});
</script>
<style>

</style>

<link rel="stylesheet" href="__PUBLIC__/css/mobile/demos.css">
</head>
<body ontouchstart>

  	<div class="header">
  		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
  		<span class="header__center">企业资料</span>
		<a class="header-arrow__right"></a>
	</div>

		
  	<div class="page">
  		<div class="page__bd">
        	<form class="layui-form" action="{:U('insert')}" method="post">
				<div class="weui-cells weui-cells_form">
			      <div class="weui-cell">
			        <div class="weui-cell__hd"><label class="weui-label">企业名称</label></div>
			        <div class="weui-cell__bd">
			          <!-- <input class="weui-input" type="text" pattern="[0-9]*" placeholder="请输入qq号"> --><!-- 
			          <input type="text" name="sitename" class="weui-input layui-input"  required="" lay-verify="required" placeholder="请输入站点名称"> -->
			          <input type="text" name="epname" value="{$data['epname']}" lay-verify="required" placeholder="20个字符以内,展示在百度搜索结果标题部分" autocomplete="off" class="weui-input layui-input">
			      	</div>
			      </div>
			      
			      <div class="weui-cell">
			        <div class="weui-cell__hd"><label for="" class="weui-label">站点描述</label></div>
			        <div class="weui-cell__bd">
			       	 	<textarea name="sitedesc" class="weui-textarea layui-textarea" lay-verify="required" placeholder="60个字符以内,展示在百度搜索结果创意描述部分">{$data['sitedesc']}</textarea>		           
			        </div>
			      </div>
			      
			      <div class="weui-cell">
			        <div class="weui-cell__hd">
			          <label class="weui-label">电脑端网页</label>
			        </div>
			        <div class="weui-cell__bd">
			        	<input type="text" name="site_pc" value="{$data['site_pc']}" lay-verify="required" placeholder="" autocomplete="off" class="weui-input layui-input">
			        </div>
			      </div>
			      
			      <div class="weui-cell">
			        <div class="weui-cell__hd">
			          <label class="weui-label">移动端网页</label>
			        </div>
			        <div class="weui-cell__bd">
			        	<input type="text" name="site_mobile" value="{$data['site_mobile']}" lay-verify="required" placeholder="" autocomplete="off" class="weui-input layui-input">
			        </div>
			      </div>			  
			    </div>
	    		<button class="layui-btn weui-btn weui-btn_primary " lay-submit="" lay-filter="go">立即提交</button>
			</form>
		</div>
		
		<div class="weui-tabbar">
			<a href="{:U('QRIndex/index')}" class="weui-tabbar__item">
				<div class="weui-tabbar__icon">
					<i class="iconfont">&#xe60a;</i>
				</div>
				<p class="weui-tabbar__label">产品概况</p>
			</a>
			<a href="{:U('QREpinfo/index')}" class="weui-tabbar__item weui-bar__item--on">
				
				<div class="weui-tabbar__icon">
					<i class="iconfont">&#xe6c5;</i>
				</div>
				<p class="weui-tabbar__label">企业资料</p>
				
			</a>
			<a href="{:U('QRPlan/index')}" class="weui-tabbar__item">
				<div class="weui-tabbar__icon">
					<i class="iconfont">&#xe631;</i>
				</div>
				<p class="weui-tabbar__label">关键词管理</p>
			</a>
			
			<!-- <a href="{:U('Keyword/search')}" class="weui-tabbar__item">
				<div class="weui-tabbar__icon">
					<i class="iconfont">&#xe612;</i>
				</div>
				<p class="weui-tabbar__label">财务管理</p>
			</a> -->
		</div>
	</div>
</body>
</html>

