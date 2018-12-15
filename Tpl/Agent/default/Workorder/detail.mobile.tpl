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

<link rel="stylesheet" href="__PUBLIC__/css/mobile/demos.css">
</head>
<body ontouchstart style="overflow: hidden;">

  	<div class="header">
  		<a class="header-arrow__left" href="{:U('Agent/Home/home')}"><i class="iconfont">&#xe671;</i></a>
  		<span class="header__center">工单详情</span>
		<div class="header-arrow__right">&nbsp;</div>
	</div>
		
  	<div class="page">
  		<div class="page__bd">
  		
  			<!-- 工单详情 挂件 begin -->
			{:W('WorkorderDetail', array( 'data'=>$data,'skin' => 'mobile' ))}
			<!-- 工单详情 挂件 end -->	
				
		</div>
	</div>
</body>
</html>

