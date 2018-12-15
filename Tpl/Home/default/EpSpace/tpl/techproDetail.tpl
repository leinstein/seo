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
				        <h3 class="ui-box-head-title">科技项目 详情</h3>
				        <span class="ui-box-head-text"></span>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow-y:auto;">
							<!-- 两栏列表文字 begin -->
				        	<!-- <dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">立项年度：</dt>
							    <dd class="ui-dlist-det">{$data['year']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">立项发文：</dt>
							    <dd class="ui-dlist-det">{$data['projectdocid']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">立项编号：</dt>
							    <dd class="ui-dlist-det">{$data['projectid']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">项目级别：</dt>
							    <dd class="ui-dlist-det">{$data['projectlevel']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">发文项目名称：</dt>
							    <dd class="ui-dlist-det">{$data['projectname']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">项目类型：</dt>
							    <dd class="ui-dlist-det">{$data['projecttype']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">项目子类：</dt>
							    <dd class="ui-dlist-det">{$data['subclass']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">项目执行期（起始时间）：</dt>
							    <dd class="ui-dlist-det">{$data['projectstarttime']} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
				        		<dt class="ui-dlist-tit">项目执行期（截止时间）：</dt>
							    <dd class="ui-dlist-det">{$data['projectendtime']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">项目新增总投入：</dt>
							    <dd class="ui-dlist-det">{$data['addfunding']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">上级资金拨款总额：</dt>
							    <dd class="ui-dlist-det">{$data['highfunding']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">上级已拨款金额：</dt>
							    <dd class="ui-dlist-det">{$data['highhavefunding']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">园区确认配套金额：</dt>
							    <dd class="ui-dlist-det">{$data['parkmatchtotal']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">园区已配套金额：</dt>
							    <dd class="ui-dlist-det">{$data['parkhavematchtotal']|format_money1=2} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">主管单位：</dt>
							    <dd class="ui-dlist-det">{$data['headunit']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">项目状态：</dt>
							    <dd class="ui-dlist-det">{$data['pjstatus']} &nbsp;</dd>
				        	</dl>
				        	<div class="clear"></div> -->
			        		<!-- 两栏列表文字 end -->
			        		
			        		<!-- content 科技项目  begin -->
							{:W('BusinessDetail',array('tplname'=>'SupProject', 'data'=>$data))}
							<!-- content 科技项目  end -->
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