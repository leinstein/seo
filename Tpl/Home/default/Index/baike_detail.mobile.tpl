<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header.mobile" />
<link rel="stylesheet" href="__PUBLIC__/css/mobile/article.css">
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
          <div class="text">SEO百科</div>
      </div>
  	</section>
	<div class="page">
		 <div class="page__bd">
		 
		 	<section class="banner">
				<img src="__PUBLIC__/img/mobile/seoBanner.jpg">
			</section>
		 	
		 	<section class="main width">
				<h1>{$data['title']}</h1>
			<section style="width: 94%;margin: 0 auto;">
   				{$data['body']}
			</section>
			<!-- <article class="list">
				<div class="left">
					上一篇：<a href="/archives/135.html">整站优化如何网站日志</a> 
					下一篇：没有了 
				</div>
				<a href="/category/baike/" class="colse">返回列表</a>
				<p class="clear"></p>
			</article> -->
		</section>

	    </div>
	    <!-- 页面底部 begin  -->
		<include file="Public/tpl/footer_mobile.tpl" />
		<!-- 页面底部 end  -->
	</div>
</body>
</html>

