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
				        <h3 class="ui-box-head-title">更多贷款余额记录</h3>
				        <span class="ui-box-head-text">单位：万元人民币</span>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        		<div class="ui-space-body-paragraph paragraph-level2">
											    <div class="paragraph-container">
											        <div class="paragraph-content">
											        
										        		<!-- 数据表格 begin -->
										        		<table class="ui-table ui-table-data">
														    <thead>
														        <tr>
														            <th width="50%" style="text-align:center;">截止日期</th>
														            <th width="50%" style="text-align:center">贷款余额</th>
														        </tr>
														    </thead>
														    <tbody>
														    	<if condition="$data">
														    	<volist name="data" id="vo">
														    	
														        <tr>
														            <td style="text-align:center;">{$vo['dataendtime']}</td>
														            <td style="text-align:center;">{$vo['uloanbalance']|format_money1}</td>
														        </tr>
														        </volist>
														        <else/>
														        <tr><td colspan=5 style="text-align:center">暂无数据</td></tr></if>
														    </tbody>
														</table>
										        		<!-- 数据表格 end -->
										        		
													</div>
											    </div>
						        		</div>
			        		
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