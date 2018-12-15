<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<script type="text/javascript" src="__PUBLIC__/js/fusioncharts/JS/jquery.fusioncharts.debug.js"></script>
<link href="../Public/css/special/count-analyse.css" rel="stylesheet">
<style>
</style>
</head>
<body>
	
	<!-- 页面顶部 logo & 菜单 begin  -->	
	<include file="../Public/top_banner" />
	<!-- 页面顶部 logo & 菜单 end  -->
		
	<div class="wrapper">		
		<!-- 顶部栏目导航 begin -->
		<div  class="ui-grid-row">
			<div class="ui-grid-25">
				<h2 class="ui-page-title"><a href="__URL__/index">统计分析</a> > 科技资金分析</h2>
			</div>
		</div>
		<!-- 顶部栏目导航 end -->
		<div  class="ui-grid-row">
			<!-- 右布局 begin -->
			<div class="ui-grid-25">
				<div class="ui-box-cs">
					<div class="ui-box-cs-head">
						<div class="ui-box-cs-head-border">
							<img alt="" src="../Public/img/countanalyse/title.png">
							<span class="font-style top">资金</span>
							<span class="font-style bottom">分析</span>
							<h3 class="ui-box-cs-head-title">科技资金分析</h3>
							<span class="ui-box-cs-head-text">包括年度资金拨付变化情况、园区科技发展资金分布情况等</span>
						</div>
					</div>
					<div class="ui-box-cs-head_bottom">
						<div class="ui-box-cs-head-border">
							<h3 class="ui-box-cs-head-title">结构分析 </h3>
							<span class="ui-box-cs-head-text"></span> <a href="__URL__/index" class="ui-box-cs-head-more"></a>
						</div>
					</div>
					<div class="ui-box-cs-container">
						<!--  年度拨付情况分析 begin -->
						{:W('StatisticsChart', array('data' => $yearList, 'type'=> 'year','title'=> '年度拨付情况分析','page' => 'index'))}
						<!--  年度拨付情况分析 end -->
						<!--  资金分布情况分析 begin -->
						{:W('StatisticsChart', array('data' => $fundsdistList, 'type'=> 'fundsdist','title'=> '资金分布情况分析','page' => 'index' , 'pie_style'=>'pie-index', 'color_block_style' => 'color-block-index'))}
						<!--  资金分布情况分析 end -->
						<div style="clear: both;"></div>
						
						<!--  产业分布情况分析 begin -->
						{:W('StatisticsChart', array('data' => $indusdistList, 'type'=> 'indusdist','title'=> '产业分布情况分析','page' => 'index' ,'pie_style'=>'pie-index', 'color_block_style' => 'color-block-index ' ,'style' => ' mt0'))}
						<!--  产业分布情况分析 end -->
						
						<!--  预算执行情况分析 begin -->
						{:W('StatisticsChart', array('data' => $budgetexecList, 'type'=> 'budgetexec','title'=> '预算执行情况分析','page' => 'index' ,'style' => ' mt0'))}
						<!--  预算执行情况分析 end -->
					</div>
				</div>	
			</div>
			<!-- 右布局 end -->
		</div>
	</div>
	<!-- 左右布局 end -->
	
</body>
</html>