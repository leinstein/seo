<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<script type="text/javascript">

</script>
</head>
<tagLib name="html" />
<body>

	<div class="layui-tab-content">
		<form name="form" action="{:U('update')}" method="post" class="layui-form">
			<!-- 用户详情详情 挂件 begin -->
			{:W('UserDetail', array( 'data'=>$data,'operate' => 'update' ,'skin' => 'manage'))}
			<!-- 用户详情详情 挂件 end -->
		</form>
	</div>
</body>
</html>
