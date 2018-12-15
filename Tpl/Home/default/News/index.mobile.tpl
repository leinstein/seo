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

</head>
<body>

	<section class="header">
      <div class="header__home">
          <a href="{:U('Index/index')}">首页</a>
      </div>
      <div class="header__center">
          <div class="text">系统通知</div>
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
            <div class="m_en">News</div>
            <div class="m_zh">通知公告</div>
		</div> -->
	 	<div class="page__bd">
	 	
		 	<div class="weui-cells">
		 		<volist name="list" id="vo">
			  	<a class="weui-cell weui-cell_access" href="__URL__/detail/id/{$vo['id']}">
					<div class="weui-cell__bd">
				      <p>{$key+1}. {$vo['newstitle']}</p>
				    </div>
				    <div class="weui-cell__ft">
    				</div>
				</a>
				</volist>
			</div>

	 		<div class="weui-panel weui-panel_access question hide">
			  <div class="weui-panel__bd">
			  	<volist name="list" id="vo">
			    <a href="__URL__/detail/id/{$vo['id']}" class="weui-media-box weui-media-box_appmsg">
			      <div class="weui-media-box__bd">
			        <h4 class="weui-media-box__title">{$key+1}. {$vo['newstitle']}</h4>
			      </div>
			    </a>
			   </volist>
			  </div>
			  
			</div>
	 	</div>
	</div>
		 
    