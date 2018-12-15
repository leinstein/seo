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
				        <h3 class="ui-box-head-title">数据来源：企业自报 详情</h3>
				        <span class="ui-box-head-text">单位：万元人民币</span>
				        <!-- 2014-11-28 跟董经理确认，财务单位币种统一“万元人民币” ps：报送的财务数据单位本来就是是“万元” -->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        
				        	<!-- 数据表格风格 begin -->
				        	<!-- <table class="ui-table ui-table-data mt5">
							    <thead>
							        <tr>
							            <th nowrap="nowrap">报表时点</th>
							            <th nowrap="nowrap">报表类型</th>
							            <th nowrap="nowrap">审计事务所</th>
							            <th nowrap="nowrap">资产总额</th>
							            <th nowrap="nowrap">负债总额</th>
							            <th nowrap="nowrap">长期借款</th>
							            <th nowrap="nowrap">短期借款</th>
							            <th nowrap="nowrap">实收资本</th>
							            <th nowrap="nowrap">主营业务收入</th>
							            <th nowrap="nowrap">营业利润</th>
							            <th nowrap="nowrap">获得企业直接拨款或补贴额</th>
							            <th nowrap="nowrap">净利润</th>
							        </tr>
							    </thead>
							    <tbody>
							    	<if condition="$data">
							    	<volist name="data" id="vo">
							        <tr>
							            <td>{$vo['reporttime']}</td>
							            <td>{$vo['reporttype']}</td>
							            <td>{$vo['auditoffice']}</td>
							            <td>{$vo['assets']|format_money1}</td>
							            <td>{$vo['debtamount']|format_money1}</td>
							            <td>{$vo['longtermborrow']|format_money1}</td>
							            <td>{$vo['shortborrow']|format_money1}</td>
							            <td>{$vo['realitycapital']|format_money1}</td>
							            <td>{$vo['mainoperreceipt']|format_money1}</td>
							            <td>{$vo['opermargin']|format_money1}</td>
							            <td>&nbsp;</td>
							            <td>{$vo['netmargin']|format_money1}</td>
							        </tr>
							        </volist>
							        <else/>
									<tr><td colspan=11 style="text-align:center">暂无数据</td></tr></if>
							    </tbody>
							</table> -->
							<!-- 数据表格风格 end -->
				        
				        	<!-- 横版数据表格风格 begin -->
				        	<table class="ui-table ui-table-data mt5">
							    <thead>
							       <tr><th nowrap="nowrap">报表科目</th><volist name="data" id="vo"><th nowrap="nowrap">{$vo['reporttime']}</th></volist></tr>
							    </thead>
							    <tbody>
							        <tr><td nowrap="nowrap">报表类型</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['reporttype']}</td></volist></tr>
							        <tr><td nowrap="nowrap">审计事务所</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['auditoffice']}</td></volist></tr>
							        <tr><td nowrap="nowrap">资产总额</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['assets']|format_money1}</td></volist></tr>
							        <tr><td nowrap="nowrap">负债总额</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['debtamount']|format_money1}</td></volist></tr>
							        <tr><td nowrap="nowrap">长期借款</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['longtermborrow']|format_money1}</td></volist></tr>
							        <tr><td nowrap="nowrap">短期借款</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['shortborrow']|format_money1}</td></volist></tr>
							        <tr><td nowrap="nowrap">实收资本</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['realitycapital']|format_money1}</td></volist></tr>
							        <tr><td nowrap="nowrap">主营业务收入</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['mainoperreceipt']|format_money1}</td></volist></tr>
							        <tr><td nowrap="nowrap">营业利润</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['opermargin']|format_money1}</td></volist></tr>
							        <tr><td nowrap="nowrap">净利润</td><volist name="data" id="vo"><td nowrap="nowrap">{$vo['netmargin']|format_money1}</td></volist></tr>
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