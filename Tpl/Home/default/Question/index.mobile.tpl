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
<body>
	<section class="header">
      <div class="header__home">
          <a href="{:U('Index/index')}">首页</a>
      </div>
      <div class="header__center">
          <div class="text">常见问题</div>
      </div>
      <!-- <div class="t_m_btn">
          <a class="t_in" href="javascript:;" id="menuCtrl">
              <div class="t_m_one"></div>
              <div class="t_m_two"></div>
              <div class="t_m_thr"></div>
          </a>
      </div> -->
  	</section>
	<div class="page">
		<div class="page__hd">          
           <!--  <div class="m_en">Questions</div> -->
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
		 
    