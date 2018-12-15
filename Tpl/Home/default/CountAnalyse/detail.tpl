<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<tagLib name="html,lps"/>
<script type="text/javascript" src="__PUBLIC__/js/fusioncharts/JS/jquery.fusioncharts.debug.js"></script>
<style>
</style>
</head>
<body>
	<div class="wrapper">
		<!-- 页面顶部 logo & 菜单 begin  -->
		<include file="../Public/top_banner" />
		<!-- 页面顶部 logo & 菜单 end  -->
		
		<!-- 顶部栏目导航 begin -->
		<div  class="ui-grid-row">
			<div class="ui-grid-25">
					<!-- <h2 class="ui-page-title">所有企业 > 生物医药</h2> -->
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
			
		<!-- 右布局 begin -->
		<div class="ui-grid-25">
			<!--  嵌套图表样式 begin -->
			{:W('StatisticsChart', array('data' => $data['list'], 'type'=> $data['type'], 'title'=> $data['title'],'page' => 'detail'))}
			<!--  嵌套图表样式 end -->
				
		</div>
		<!-- 右布局 end -->
		<!-- 左右布局 end -->
	</div>
</body>
</html>