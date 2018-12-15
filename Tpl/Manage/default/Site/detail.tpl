<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "站点详情";</php>
<head>
<include file="../Public/header" />
<script type="text/javascript">

</script>
</head>
<tagLib name="html" />
<body>

	<div class="layui-tab-content">
		<form name="form" class="layui-form">
       	<!-- 站点详情 挂件 begin -->
		{:W('SiteDetail', array( 'data'=>$data, 'operate' =>'detail' ))}
		<!-- 站点详情 挂件 end -->	
		</form>
	</div>
</body>
</html>