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
				        <h3 class="ui-box-head-title">园区统贷平台委托贷款 详情</h3>
				        <span class="ui-box-head-text"></span>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<!-- <dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">放款年度：</dt>
							    <dd class="ui-dlist-det">{$data['loanyear']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">放款序号：</dt>
							    <dd class="ui-dlist-det">{$data['loanno']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">放款日期：</dt>
							    <dd class="ui-dlist-det">{$data['loandate']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">放款金额：</dt>
							    <dd class="ui-dlist-det">{$data['loanamount']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">已还本金：</dt>
							    <dd class="ui-dlist-det">{$data['haverepay']|format_money1=2} &nbsp;</dd>
							    <dt class="ui-dlist-tit">贷款余额：</dt>
							    <dd class="ui-dlist-det">{$data['loanover']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">贷款期限（月）：</dt>
							    <dd class="ui-dlist-det">{$data['timelimit']} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
				        		<dt class="ui-dlist-tit">到期日期：</dt>
							    <dd class="ui-dlist-det">{$data['expdate']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">还款日：</dt>
							    <dd class="ui-dlist-det">{$data['repaydate']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">贷款银行：</dt>
							    <dd class="ui-dlist-det">{$data['loanbank']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">贷款利率（%）：</dt>
							    <dd class="ui-dlist-det">{$data['arp']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">还款方式：</dt>
							    <dd class="ui-dlist-det">{$data['repaystyle']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">状态：</dt>
							    <dd class="ui-dlist-det">{$data['loanstatus']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">说明：</dt>
							    <dd class="ui-dlist-det">{$data['desc']} &nbsp;</dd>
				        	</dl>
				        	<div class="clear"></div> -->
			        		<!-- 两栏列表文字 end -->
			        		
			        		<!-- content 统贷  begin -->
							{:W('BusinessDetail',array('tplname'=>'Uloancon', 'data'=>$data))}
							<!-- content 统贷  end -->
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