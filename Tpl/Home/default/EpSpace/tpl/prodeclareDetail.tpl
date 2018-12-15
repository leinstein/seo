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
				        <h3 class="ui-box-head-title">产品资质 &nbsp;>&nbsp; {$data[0]['aptype']} 详情</h3>
				        <!-- <span class="ui-box-head-text">单位：万元</span> -->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<!-- 数据表格风格 begin -->
				        	<table class="ui-table ui-table-data mt5">
							    <thead>
							        <tr>
							            <th width="10%">认定年度</th>
							            <th width="10%">产品名称</th>
							            <th width="10%">产品类型</th>
							            <th width="10%">证书编号</th>
							            <th width="10%">证书时间</th>
							            <th width="10%">有效期</th>
							            <th width="15%">发证机构</th>
							            <th width="6%">状态</th>
							            <th width="19%">说明</th>
							        </tr>
							    </thead>
							    <tbody>
							       <volist name="data" id="vo">
							        <tr>
							            <td>{$vo['certyear']}</td>
							            <td>{$vo['productname']}</td>
							            <td>{$vo['producttype']}</td>
							            <td>{$vo['certno']}</td>
							            <td>{$vo['certdate']}</td>
							            <td>{$vo['valid']}</td>
							            <td>{$vo['certorg']}</td>
							            <td>{$vo['aptstatus']}</td>
							            <td>{$vo['desc']}</td>
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