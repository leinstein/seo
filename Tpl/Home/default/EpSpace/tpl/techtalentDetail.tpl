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
				        <h3 class="ui-box-head-title">科技人才 详情</h3>
				        <span class="ui-box-head-text"></span>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<!-- <dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">人才姓名：</dt>
							    <dd class="ui-dlist-det">{$data['talentname']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">人才类型：</dt>
							    <dd class="ui-dlist-det">{$data['projecttype']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">人才子类：</dt>
							    <dd class="ui-dlist-det">{$data['projectclass']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">申报年度：</dt>
							    <dd class="ui-dlist-det">{$data['applyyear']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">认定年度：</dt>
							    <dd class="ui-dlist-det">{$data['year']} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
							    <dt class="ui-dlist-tit">上级拨款：</dt>
							    <dd class="ui-dlist-det">{$data['highfunding']|format_money1=2} &nbsp;</dd>
							    <dt class="ui-dlist-tit">要求地方配套：</dt>
							    <dd class="ui-dlist-det">{$data['parkmatchtotal']|format_money1=2} &nbsp;</dd>
							    <dt class="ui-dlist-tit">项目名称：</dt>
							    <dd class="ui-dlist-det">{$data['projectname']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">状态：</dt>
							    <dd class="ui-dlist-det">{$data['pjstatus']} &nbsp;</dd>
				        	</dl>
				        	<div class="clear"></div> -->
			        		<!-- 两栏列表文字 end -->
			        		
			        		<!-- content 科技人才  begin -->
							{:W('BusinessDetail',array('tplname'=>'Talentinfo', 'data'=>$data))}
							<!-- content 科技人才  end -->
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