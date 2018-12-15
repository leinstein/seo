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
				        <h3 class="ui-box-head-title">苏科贷 详情</h3>
				        <span class="ui-box-head-text"></span>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<!-- <dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">贷款年度：</dt>
							    <dd class="ui-dlist-det">{$data['year']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">贷款项目编号：</dt>
							    <dd class="ui-dlist-det">{$data['projectid']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">贷款项目名称：</dt>
							    <dd class="ui-dlist-det">{$data['projectname']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">贷款企业名称：</dt>
							    <dd class="ui-dlist-det">{$data['entername']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">组织机构代码：</dt>
							    <dd class="ui-dlist-det">{$data['organcode']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">申报日期：</dt>
							    <dd class="ui-dlist-det">{$data['applydate']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">贷款银行：</dt>
							    <dd class="ui-dlist-det">{$data['recombank']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">贷款金额：</dt>
							    <dd class="ui-dlist-det">{$data['actloanlimit']|format_money1} &nbsp;</dd>
							    <dt class="ui-dlist-tit">备注：</dt>
							    <dd class="ui-dlist-det">{$data['desc']} &nbsp;</dd>
				        	</dl>
				        	<div class="clear"></div> -->
			        		<!-- 两栏列表文字 end -->
			        		
			        		<!-- content 苏科贷  begin -->
							{:W('BusinessDetail',array('tplname'=>'SkLoan', 'data'=>$data))}
							<!-- content 苏科贷  end -->
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