<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />
<script type="text/javascript">
	$(function() {
		
		
		
	});
</script>
<style>
</style>

<link rel="stylesheet" href="__PUBLIC__/css/question.mobile.css">
</head>

<body ontouchstart>

  	<div class="header">
  		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
  		<span class="header__center">常见问题</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>
		
  	<div class="page">
		<div class="page__hd">          
            <div class="m_en">Questions</div>
            <div class="m_zh">常见问题</div>
		</div>
	 	<div class="page__bd">
	 		<div class="weui-panel weui-panel_access question">
			  <div class="weui-panel__bd">
			  	<volist name="list" id="vo">
			    <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
			      <div class="weui-media-box__bd">
			        <h4 class="weui-media-box__title">{$key+1}. {$vo['questtitle']}</h4>
			        <p class="weui-media-box__desc">{$vo['questcontent']}</p>
			      </div>
			    </a>
			   </volist>
			  </div>
			  
			</div>
	 	</div>
	</div>
</body>
</html>