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
				        <h3 class="ui-box-head-title">园区领军创业投资基金直接投资 详情</h3>
				        <span class="ui-box-head-text"></span>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<!-- <dl class="ui-dlist ui-dlist-col1">
							    <dt class="ui-dlist-tit">投资年度：</dt>
							    <dd class="ui-dlist-det">{$data['investyear']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">退出年度：</dt>
							    <dd class="ui-dlist-det">{$data['quityear']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">投资总额：</dt>
							    <dd class="ui-dlist-det">{$data['investsum']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">投资股权份额（%）：</dt>
							    <dd class="ui-dlist-det">{$data['stake']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">已出资额：</dt>
							    <dd class="ui-dlist-det">{$data['actfundsum']|format_money1=2} &nbsp;</dd>
							    <dt class="ui-dlist-tit">投后估值：</dt>
							    <dd class="ui-dlist-det">{$data['afterinvestval']|format_money1=2} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
							    <dt class="ui-dlist-tit">最近一次融资估值：</dt>
							    <dd class="ui-dlist-det">{$data['recentfinancing']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">退出回收金额：</dt>
							    <dd class="ui-dlist-det">{$data['outsum']|format_money1=2} &nbsp;</dd>
							    <dt class="ui-dlist-tit">收益/亏损：</dt>
							    <dd class="ui-dlist-det">{$data['outincome']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">状态：</dt>
							    <dd class="ui-dlist-det">{$data['pjstatus']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">说明：</dt>
							    <dd class="ui-dlist-det">{$data['desc']} &nbsp;</dd>
				        	</dl>
				        	<div class="clear"></div> -->
			        		<!-- 两栏列表文字 end -->
			        		
			        		<!-- content 领军直投  begin -->
							{:W('BusinessDetail',array('tplname'=>'Ljztinvest', 'data'=>$data))}
							<!-- content 领军直投  end -->
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