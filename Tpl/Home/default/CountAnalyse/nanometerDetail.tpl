<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<tagLib name="html,lps"/>
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
				<h2 class="ui-page-title"><a href="__URL__/index">统计分析</a> > <a href="__URL__/nanometer">纳米技术应用产业分析</a> > {$data['title']}</h2>
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
							<h3 class="ui-box-cs-head-title">
								<if condition="$data['type'] =='persons' OR $data['type'] =='sales'">产业发展情况<else/>总体情况</if>
							</h3>
							<span class="ui-box-cs-head-text"></span> 
							<a href="__URL__/index" class="ui-box-cs-head-more"></a>
						</div>
					</div> 
					<div class="ui-box-cs-container">
						<!--  嵌套图表样式 begin -->
						{:W('StatisticsChart', array('data' => $data['list'], 'type'=> $data['type'], 'title'=> $data['title'],'AppropriateYearOptions' => $data['AppropriateYearOptions'],'pie_style'=>'pie-detail', 'color_block_style' => 'color-block-detail','page' => 'detail'))}
						<!--  嵌套图表样式 end -->
					</div>
				</div>				
			</div>
			<!-- 右布局 end -->
		</div>	
		<!-- 左右布局 end -->
	</div>
</body>
</html>