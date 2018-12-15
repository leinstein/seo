<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "科技信息枢纽  |  企业数据中心";</php>
<head>
<include file="../Public/header" />
<!-- 专用风格 -->
<link href="../Public/css/special/epspace.css" rel="stylesheet">
<style>
/*自定义风格*/
.ui-box-dialog{
	border:none;
}
.ui-box-dialog .ui-box-container{
	border-bottom:none;
}
</style>
</head>
<body>
	
	<div class="wrapper">
		
		<!-- 全宽布局 begin -->
		<div class="ui-grid-row">
			<!-- 全宽布局 begin -->
			<div class="ui-grid-24">
				
				<div class="ui-box ui-box-dialog">
				    <div class="ui-box-head">
				        <h3 class="ui-box-head-title">数据来源：苏州工业园区劳动和社会保障局 详情</h3>
				        <!-- <span class="ui-box-head-text">单位：万元</span> -->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        
				        	<!-- 数据表格风格 begin -->
				        	 <table class="ui-table ui-table-data mt5">
							    <thead>
							        <tr>
							            <th nowrap="nowrap">截止时点</th>
							            <th nowrap="nowrap">劳动合同备案人数</th>
							            <th nowrap="nowrap">全日制合同人数</th>
							            <th nowrap="nowrap">试用期合同人数</th>
							            <th nowrap="nowrap">无固定期合同人数</th>
							            <th nowrap="nowrap">有竞业限制约定人数</th>
							            <th nowrap="nowrap">博士</th>
							            <th nowrap="nowrap">硕士</th>
							            <th nowrap="nowrap">本科</th>
							            <th nowrap="nowrap">专科</th>
							        </tr>
							    </thead>
							    <tbody>
							    	<if condition="$data">
							    	<volist name="data" id="vo">
							        <tr>
							            <td>{$vo['ddate']}</td>
							            <td>{$vo['labcontractnum']}</td>
							            <td>{$vo['fullcontractnum']}</td>
							            <td>{$vo['procontractnum']}</td>
							            <td>{$vo['nofixcontractnum']}</td>
							            <td>{$vo['competlimitnum']}</td>
							            <td>{$vo['drnum']}</td>
							            <td>{$vo['masternum']}</td>
							            <td>{$vo['undergradnum']}</td>
							            <td>{$vo['specialtynum']}</td>
							        </tr>
							        </volist>
							        <else/>
									<tr><td colspan=100 style="text-align:center">暂无数据</td></tr></if>
							    </tbody>	
							</table> 
							<!-- 数据表格风格 end -->
							
							<!-- 横版数据表格风格 begin -->
							<!--
				        	<table class="ui-table ui-table-data mt5">
							    <thead>
							       <tr><th nowrap="nowrap">统计科目</th><volist name="data" id="vo"><th nowrap="nowrap">{$vo['ddate']}</th></volist></tr>
							    </thead>
							    <tbody>
							      <tr><td nowrap="nowrap">劳动合同备案人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['labcontractnum']}</td></volist></tr>
							      <tr><td nowrap="nowrap">全日制合同人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['fullcontractnum']}</td></volist></tr>
							      <tr><td nowrap="nowrap">试用期合同人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['procontractnum']}</td></volist></tr>
							      <tr><td nowrap="nowrap">无固定期合同人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['nofixcontractnum']}</td></volist></tr>
							      <tr><td nowrap="nowrap">有竞业限制约定人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['competlimitnum']}</td></volist></tr>
							      <tr><td nowrap="nowrap">博士研究生学历人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['drnum']}</td></volist></tr>
							      <tr><td nowrap="nowrap">硕士研究生学历人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['masternum']}</td></volist></tr>
							      <tr><td nowrap="nowrap">本科学历人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['undergradnum']}</td></volist></tr>
							      <tr><td nowrap="nowrap">专科学历人数</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['specialtynum']}</td></volist></tr>
							    </tbody>
							</table>-->
							<!-- 横版数据表格风格 end -->
				        </div>
				    </div>
				</div>
				
			</div>
			<!-- 全宽布局 end -->
		</div>
		<!-- 全宽布局 end -->
	</div>
</body>
</html>