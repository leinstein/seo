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
				        <h3 class="ui-box-head-title">统贷违约记录 详情</h3>
				        <span class="ui-box-head-text"></span>
				        <!-- 2014-11-28 跟黄经理确认，数据表里金额类数据的单位都是“万元人民币” -->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">贷款违约次数：</dt>
							    <dd class="ui-dlist-det">{$data['defaultnum']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">贷款当前逾期本金：</dt>
							    <dd class="ui-dlist-det">{$data['loan']|format_money1}<if condition="$data['loan']!=null">万元人民币</if> &nbsp;</dd>
							    <dt class="ui-dlist-tit">贷款逾期31-60天未归还本金：</dt>
							    <dd class="ui-dlist-det">{$data['overduenotrepay1']|format_money1}<if condition="$data['overduenotrepay1']!=null">万元人民币</if> &nbsp;</dd>
				        		<dt class="ui-dlist-tit">贷款逾期61-90天未归还本金：</dt>
							    <dd class="ui-dlist-det">{$data['overduenotrepay2']|format_money1}<if condition="$data['overduenotrepay2']!=null">万元人民币</if> &nbsp;</dd>
				        		<dt class="ui-dlist-tit">贷款逾期91-180天未归还本金：</dt>
							    <dd class="ui-dlist-det">{$data['overduenotrepay3']|format_money1}<if condition="$data['overduenotrepay3']!=null">万元人民币</if> &nbsp;</dd>
							    <dt class="ui-dlist-tit">贷款逾期180天以上未归还本金：</dt>
							    <dd class="ui-dlist-det">{$data['overduenotrepay4']|format_money1}<if condition="$data['overduenotrepay4']!=null">万元人民币</if> &nbsp;</dd>
				        	</dl>
				        	<div class="clear"></div>
			        		<!-- 两栏列表文字 end -->
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