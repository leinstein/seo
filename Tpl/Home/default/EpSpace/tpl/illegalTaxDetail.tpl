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
				        <h3 class="ui-box-head-title">税务违法（地税） 详情</h3>
				        <!--<span class="ui-box-head-text">单位：万元</span>-->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">公告日期：</dt>
							    <dd class="ui-dlist-det">{$data['noticedate']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">纳税人名称：</dt>
							    <dd class="ui-dlist-det">{$data['entername']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">企业所属区域：</dt>
							    <dd class="ui-dlist-det">{$data['area']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">违法信息来源：</dt>
							    <dd class="ui-dlist-det">{$data['taxessourcetype']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">法定代表人/负责人姓名：</dt>
							    <dd class="ui-dlist-det">{$data['legalperson']} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
							    <dt class="ui-dlist-tit">经营地点：</dt>
							    <dd class="ui-dlist-det">{$data['address']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">经营范围：</dt>
							    <dd class="ui-dlist-det">{$data['businessscope']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">年度：</dt>
							    <dd class="ui-dlist-det">{$data['year']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">批次：</dt>
							    <dd class="ui-dlist-det">{$data['batch']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">违法行为：</dt>
							    <dd class="ui-dlist-det">{$data['violation']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">违法事实：</dt>
							    <dd class="ui-dlist-det">{$data['facts']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">处罚决定：</dt>
							    <dd class="ui-dlist-det">{$data['decision']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">执行情况：</dt>
							    <dd class="ui-dlist-det">{$data['lmplementation']} &nbsp;</dd>
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