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
				<h2 class="ui-page-title"><a href="__URL__/index">统计分析</a> > 纳米技术应用产业分析</h2>
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
							<span class="font-style top">产业</span>
							<span class="font-style bottom">分析</span>
							<h3 class="ui-box-cs-head-title">纳米技术应用产业分析</h3>
						</div>
					</div>
					<div class="ui-box-cs-head_bottom">
						<div class="ui-box-cs-head-border">
							<h3 class="ui-box-cs-head-title">总体情况</h3>
							<span class="ui-box-cs-head-text"></span> <a href="__URL__/index" class="ui-box-cs-head-more"></a>
						</div>
					</div>
					<div class="ui-box-cs-container">
						<!--  企业数量情况分析 begin -->
						{:W('StatisticsChart', array('data' => $enterNumList,'type' => 'enterNum', 'title'=> $enterNumList['headtitle'],'page' => 'index', 'pie_style'=>'pie-index', 'color_block_style' => 'color-block-index'))}
						<!--  企业数量情况分析 end -->
												
						<!--  资产统计情况分析 begin -->
						{:W('StatisticsChart', array('data' => $assetsList,'type' => 'assets', 'title'=> $assetsList['headtitle'] ,'page' => 'index'))}
						<!--  资产统计情况分析 end -->
						
						<div style="clear: both;"></div>
					</div>
					<div class="ui-box-cs-head_bottom">
						<div class="ui-box-cs-head-border">
							<h3 class="ui-box-cs-head-title">产业发展情况</h3>
							<span class="ui-box-head-text"></span> <a href="__URL__/index" class="ui-box-head-more"></a>
						</div>
					</div>
					<div class="ui-box-container " style="border-bottom: none;">
						<!--  企业数量情况分析 begin -->
						{:W('StatisticsChart', array('data' => $salesList,'type' => 'sales', 'title'=> $salesList['headtitle'],'page' => 'index'))}
						<!--  企业数量情况分析 end -->
												
						<!--  资产统计情况分析 begin -->
						{:W('StatisticsChart', array('data' => $personsList,'type' => 'persons', 'title'=>  $personsList['headtitle'],'page' => 'index'))}
						<!--  资产统计情况分析 end -->
						
						<div style="clear: both;"></div>
						
					</div>
				</div>	
				
			</div>
			<!-- 右布局 end -->
		</div>		
	</div>
	<!-- 左右布局 end -->

</body>
</html>