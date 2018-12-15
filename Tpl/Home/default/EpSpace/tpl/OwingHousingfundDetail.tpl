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
				        <h3 class="ui-box-head-title">公积金欠费记录 详情</h3>
				       <!-- <span class="ui-box-head-text">单位：万元</span>-->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<dl class="ui-dlist ui-dlist-col1">
							    <dt class="ui-dlist-tit">企业所属区域：</dt>
							    <dd class="ui-dlist-det">{$data['area']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">正常人数：</dt>
							    <dd class="ui-dlist-det">{$data['normalnum']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">欠费人数：</dt>
							    <dd class="ui-dlist-det">{$data['arrearsnum']} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
		     				    <dt class="ui-dlist-tit">欠费公示公告：</dt>
							    <dd class="ui-dlist-det">{$data['arrearspubbull']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">公告日期：</dt>
							    <dd class="ui-dlist-det">{$data['publishdata']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">数据统计截止日期：</dt>
							    <dd class="ui-dlist-det">{$data['tdate']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">年度：</dt>
							    <dd class="ui-dlist-det">{$data['year']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">批次：</dt>
							    <dd class="ui-dlist-det">{$data['batch']} &nbsp;</dd>
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
