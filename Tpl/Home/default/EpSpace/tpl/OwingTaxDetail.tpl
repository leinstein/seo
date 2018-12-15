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
				        <h3 class="ui-box-head-title">税务欠税记录（地税） 详情</h3>
				        <span class="ui-box-head-text"></span>
				        <!-- 2014-11-28 跟黄经理确认，数据表里金额类数据的单位都是“元人民币” -->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">企业所属区域：</dt>
							    <dd class="ui-dlist-det">{$data['area']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">欠税信息来源：</dt>
							    <dd class="ui-dlist-det">{$data['taxessourcetype']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">纳税人识别号：</dt>
							    <dd class="ui-dlist-det">{$data['identificationno']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">法定代表人/负责人姓名：</dt>
							    <dd class="ui-dlist-det">{$data['legalperson']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">证件类型：</dt>
							    <dd class="ui-dlist-det">{$data['idtype']} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
							    <dt class="ui-dlist-tit">证件号码：</dt>
							    <dd class="ui-dlist-det">{$data['idnumber']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">经营地点：</dt>
							    <dd class="ui-dlist-det">{$data['address']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">年度：</dt>
							    <dd class="ui-dlist-det">{$data['year']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">批次：</dt>
							    <dd class="ui-dlist-det">{$data['batch']} &nbsp;</dd>
							     <dt class="ui-dlist-tit">统计截止日期：</dt>
							    <dd class="ui-dlist-det">{$data['totalenddate']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">公告日期：</dt>
							    <dd class="ui-dlist-det">{$data['pubdate']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">欠税税种：</dt>
							    <dd class="ui-dlist-det">{$data['taxestype']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">欠税余额：</dt>
							    <dd class="ui-dlist-det">{$data['owetax']|format_money1}<if condition="$data['owetax']!=null">元人民币</if> &nbsp;</dd>
							    <dt class="ui-dlist-tit">当期新发生的欠税金额：</dt>
							    <dd class="ui-dlist-det">{$data['currenttaxes']|format_money1}<if condition="$data['currenttaxes']!=null">元人民币</if> &nbsp;</dd>
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