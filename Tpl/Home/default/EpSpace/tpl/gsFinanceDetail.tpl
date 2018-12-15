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
				        <h3 class="ui-box-head-title">数据来源：官方数据 详情</h3>
				        <span class="ui-box-head-text">单位：万元人民币</span>
				        <!-- 2014-11-28 跟董经理确认，财务单位币种统一“万元人民币” ps：国税的财务数据单位是“元” -->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        
				        	<!-- 横版数据表格风格 begin -->
				        	<table class="ui-table ui-table-data mt5">
							    <thead>
							       <tr><th nowrap="nowrap">报表科目</th><volist name="data" id="vo"><th nowrap="nowrap">{$vo['year']}</th></volist></tr>
							    </thead>
							    <tbody>
							       <tr><td nowrap="nowrap">资产总额</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['assets']/10000|format_money1}</td></volist></tr>
							       <tr><td nowrap="nowrap">负债总额</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['debtamount']/10000|format_money1}</td></volist></tr>
							       <tr><td nowrap="nowrap">长期借款</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['longtermborrow']/10000|format_money1}</td></volist></tr>
							       <tr><td nowrap="nowrap">短期借款</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['shortborrow']/10000|format_money1}</td></volist></tr>
							       <tr><td nowrap="nowrap">实收资本</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['realitycapital']/10000|format_money1}</td></volist></tr>
							       <tr><td nowrap="nowrap">主营业务收入</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['mainoperreceipt']/10000|format_money1}</td></volist></tr>
							       <tr><td nowrap="nowrap">营业利润</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['opermargin']/10000|format_money1}</td></volist></tr>
							       <tr><td nowrap="nowrap">净利润</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['netmargin']/10000|format_money1}</td></volist></tr>
							    </tbody>
							</table>
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