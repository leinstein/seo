<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "站点修改";</php>
<head>
<include file="../Public/header" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<tagLib name="html" />
</head>
<body>
<div class="layui-tab-content">
	<form name="form" action="{:U('update')}" method="post" class="layui-form">
		
		<!-- 站点详情 挂件 begin -->
		{:W('SiteDetail', array( 'data'=>$data,'operate' => 'update', 'returnUrl' => $_GET['returnUrl'] , 'me' => $LoginUserInfo ))}
		<!-- 站点详情 挂件 end -->	
		
	</form>
</div>	
</body>
</html>