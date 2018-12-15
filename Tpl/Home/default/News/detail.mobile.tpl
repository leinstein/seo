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
<body>
	<section class="header">
      <div class="header__home">
          <a href="{:U('Index/index')}">首页</a>
      </div>
      <div class="header__center">
          <div class="text">系统通知 - 正文</div>
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
		<!-- <div class="page__hd">          
            <div class="m_en">News - Content</div>
            <div class="m_zh">通知公告 - 正文</div>
		</div> -->
	 	<div class="page__bd">
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
		 
    