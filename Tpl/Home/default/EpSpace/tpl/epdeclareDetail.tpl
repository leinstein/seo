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
				        <h3 class="ui-box-head-title">企业资质 详情</h3>
				        <!-- <span class="ui-box-head-text">单位：万元</span> -->
				    </div>
				    <div class="ui-box-container">
				        <div class="ui-box-content" style="width:920px; height:420px; overflow:auto;">
				        	<!-- <dl class="ui-dlist ui-dlist-col1">
				        		<dt class="ui-dlist-tit">资质类型：</dt>
							    <dd class="ui-dlist-det">{$data[0]['aptype']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">首次认定年度：</dt>
							    <dd class="ui-dlist-det">{$data[0]['certyear']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">证书编号：</dt>
							    <dd class="ui-dlist-det">{$data[0]['certno']} &nbsp;</dd>
				        		<dt class="ui-dlist-tit">发证时间：</dt>
							    <dd class="ui-dlist-det">{$data[0]['certdate']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">证书企业名称：</dt>
							    <dd class="ui-dlist-det">{$data[0]['certentername']|default="暂未取得"} &nbsp;</dd>
				        	</dl>
				        	<dl class="ui-dlist ui-dlist-col2">
							    <dt class="ui-dlist-tit">有效期：</dt>
							    <dd class="ui-dlist-det">{$data[0]['valid']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">发证机构：</dt>
							    <dd class="ui-dlist-det">{$data[0]['certorg']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">状态：</dt>
							    <dd class="ui-dlist-det">{$data[0]['aptstatus']} &nbsp;</dd>
							    <dt class="ui-dlist-tit">说明：</dt>
							    <dd class="ui-dlist-det">{$data[0]['desc']} &nbsp;</dd>
				        	</dl>
				        	<div class="clear"></div> -->
			        		<!-- 两栏列表文字 end -->
			        		
			        		<!-- <div class="mt20"><span>资质认定信息</span></div>
			        		<div  style="width:935px; height:220px; overflow:auto;">
				        	<table class="ui-table ui-table-data mt5">
							    <thead>
							        <tr>
							            <th width="35%">认定业务类型</th>
							            <th width="10%">认定年度</th>
							            <th width="10%">认定批次</th>
							            <th width="20%">证书编号</th>
							            <th width="15%">发证时间</th>
							            <th width="10%">状态</th>
							        </tr>
							    </thead>
							    <tbody>
							       <volist name="data[1]" id="vo">
							        <tr>
							            <td>{$vo['businessname']}</td>
							            <td>{$vo['year']}</td>
							            <td>{$vo['certno']}</td>
							            <td>{$vo['batch']}</td>
							            <td>{$vo['certdate']}</td>
							            <td>{$vo['pjstatus']}</td>
							        </tr>
							        </volist>
							    </tbody>
							</table>
							</div> -->
							
							<!-- content 企业资质  begin -->
							{:W('BusinessDetail',array('tplname'=>'EpDeclare', 'data'=>$data))}
							<!-- content 企业资质  end -->
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