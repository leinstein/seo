<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />
<script type="text/javascript">
	$(function() {
		
		
		
	});
</script>
<style>
.news-title{
	font-size: 1.3em;
	font-weight: bold;
	margin: 10px auto;
	text-align: center;
}
.news-content{
	padding: 10px;
	font-size: 1.1em;
	text-indent: 2em;
	line-height: 2em;
}
</style>

</head>
<body ontouchstart>
	<div class="header">
  		<a class="header-arrow__left" href="{:U('Service/Home/home')}"><i class="iconfont">&#xe671;</i></a>
  		<span class="header__center">系统公告 - 正文</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>
	<div class="page">
	 	<div class="page__bd">
	 	<!-- <div class="weui-panel weui-panel_access question">
	 			
			  <div class="weui-panel__bd">
	 		<article class="weui-article">
		      <h1 class="news-title">{$data['newstitle']}</h1>
		      <section>
		        
		          <p>
		            {$data['newscontent']}
		          </p>
		      </section>
		    </article>
	 	
	 	</div>
	 	</div> -->
	 		<div class="weui-panel weui-panel_access question">
	 			
			  <div class="weui-panel__bd">
		            <div class="news-title">{$data['newstitle']}</div>
		            <div class="news-content">{$data['newscontent']}</div>
		            <!-- <div class="detail_box">
			            <div class="btn fixed" id="btn">
			                    <span class="name">分享到：</span>
			                    <a href="javascript:;" class="s_wx_btn">分享到微信</a>
			                    <a href="javascript:;" class="s_fri_btn">分享到朋友圈</a>
			            </div>
		            </div> -->
           		</div>
			</div>
	 	</div>
	</div>
		 
    