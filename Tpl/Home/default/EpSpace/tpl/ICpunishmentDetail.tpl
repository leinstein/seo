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
				        <h3 class="ui-box-head-title">工商行政处罚 详情</h3>
				        <!--<span class="ui-box-head-text">单位：万元</span>-->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">企业所属区域：</dt>
							    <dd class="ui-dlist-det">{$data['area']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">处罚类型：</dt>
							    <dd class="ui-dlist-det">{$data['type']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">处罚原因：</dt>
							    <dd class="ui-dlist-det">{$data['reason']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">企业类型：</dt>
							    <dd class="ui-dlist-det">{$data['entertype']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">企业注册号：</dt>
							    <dd class="ui-dlist-det">{$data['enterregnum']} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
							    <dt class="ui-dlist-tit">公示时间：</dt>
							    <dd class="ui-dlist-det">{$data['pubdate']} &nbsp;</dd>
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