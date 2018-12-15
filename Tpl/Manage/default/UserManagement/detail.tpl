<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "";</php>
<head>
<include file="../Public/header" />
<script type="text/javascript">

</script>
</head>
<body>

	<div class="layui-tab-content">
       	<!-- 站点详情 挂件 begin -->
		{:W('UserDetail', array( 'data'=>$data ,'operate' =>'detail' ))}
		<!-- 站点详情 挂件 end -->	
	</div>
</body>
</html>
