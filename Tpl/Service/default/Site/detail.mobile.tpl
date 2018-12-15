<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />
<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->
<script type="text/javascript">
	$(function() {
		
		
	});
	
	
</script>
<style>

</style>

<link rel="stylesheet" href="__PUBLIC__/css/mobile/demos.css">
</head>
<body ontouchstart style="overflow: hidden;">

  	<div class="header">
  		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
  		<span class="header__center">我的站点</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>
		
  	<div class="page">
  		<div class="page__bd">
			<div class="weui-tab">
				<div class="weui-form-preview">
					<div class="weui-form-preview__hd">
						<div class="weui-form-preview__item">
				          	<label class="weui-form-preview__label">站点名称</label>
				          	<em class="weui-form-preview__value">{$data['sitename']}</em>
			        	</div>
					</div>
					
					<div class="weui-form-preview__bd">
						<div class="weui-form-preview__item">
					          	<label class="weui-form-preview__label">站点地址</label>
					          	<span class="weui-form-preview__value">{$data['website']}</span>
			        	</div>
					
						<div class="weui-form-preview__item">
				          	<label class="weui-form-preview__label">ftp信息</label>
				          	<span class="weui-form-preview__value">{$data['ftp']}</span>
			        	</div>
					
						<div class="weui-form-preview__item">
				          	<label class="weui-form-preview__label">管理后台</label>
				          	<span class="weui-form-preview__value">{$data['managebackground']}</span>
			        	</div>
					
						<div class="weui-form-preview__item">
				          	<label class="weui-form-preview__label">站点状态</label>
				          	<em class="weui-form-preview__value">{$data['sitestatus']}</em>
			        	</div>
					
						<div class="weui-form-preview__item">
			          	<label class="weui-form-preview__label">审核意见</label>
			          		<em class="weui-form-preview__value">{$data['reviewopinion']}</em>
			        	</div>
					</div>
			      
			      	<!-- <div class="weui-form-preview__ft">
			        	<a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">操作</a>
			      	</div> -->
			    </div>
				
				<div class="weui-tabbar">
					<a href="{:U('Index/index')}" class="weui-tabbar__item">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe60a;</i>
						</div>
						<p class="weui-tabbar__label">产品概况</p>
					</a>
					<a href="{:U('Site/index')}" class="weui-tabbar__item weui-bar__item--on">
						
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe633;</i>
						</div>
						<p class="weui-tabbar__label">我的站点</p>
						
					</a>
					<a href="{:U('Keyword/search')}" class="weui-tabbar__item">
						<div class="weui-tabbar__icon">
							<i class="iconfont">&#xe612;</i>
						</div>
						<p class="weui-tabbar__label">优化中心</p>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

