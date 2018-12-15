<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "南京经济开发区  |  企业数据中心";</php>
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
				        <h3 class="ui-box-head-title">专利信息 &nbsp;>&nbsp; {$data[0]['patenttype']}专利 详情</h3>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<!-- 数据表格风格 begin -->
				        	<table class="ui-table ui-table-data mt5">
							   <thead>
							        <tr>
							            <th width="20%">专利号</th>
							            <th width="40%">专利名称</th>
							            <th width="20%">申请日</th>
							            <th width="20%">授权日</th>
							        </tr>
							    </thead>
							    <tbody>
							       <volist name="data" id="vo">
							        <tr>
							            <td>{$vo['applyno']}</td>
							            <td>{$vo['title']}</td>
							            <td>{$vo['applydate']}</td>
							            <td>{$vo['authorizedate']}</td>
							        </tr>
							        </volist>
							    </tbody>
							</table>
							<!-- 数据表格风格 end -->
							
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