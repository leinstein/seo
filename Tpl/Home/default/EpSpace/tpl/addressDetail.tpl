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
				        <h3 class="ui-box-head-title">经营场所 &nbsp;>&nbsp;详情</h3>
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<!-- 数据表格风格 begin -->
				        	<table class="ui-table ui-table-data mt5">
							    <thead>
							        <tr>
							            <!-- <th width="10%">拨付序号</th> -->
							            <th width="50%">房屋号</th>
							            <th width="50%">房屋面积（㎡）</th>
							            <!-- <th width="10%">业务说明</th> -->
							        </tr>
							    </thead>
							    <tbody>
							        <volist name="data" id="vo">
							        <tr>
							            
							            <td>{$vo['houseno']}</td>
							            <td>{$vo['housearea']}</td>							          						            
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