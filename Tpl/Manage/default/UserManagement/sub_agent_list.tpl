<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "一级代理商用户列表";</php>
<head>
<include file="../Public/header" />
<style type="text/css">
.tooltip {
	
}

.tooltip-inner {
	background-color: #fff !important;
	color: #666 !important;
	line-height: 1.5;
	border: 1px solid #aaa;
}
</style>
</head>
<tagLib name="html" />
<body>

<div class="layui-tab-content">
	<!-- 站点详情 挂件 begin -->
	{:W('UserList', array( 'list' => $list, 'skin' => 'sub', 'returnUrl' => $CURRENT_URL ))}
	<!-- 站点详情 挂件 end -->
</div>
	





</body>
</html>