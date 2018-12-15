<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "修改用户";</php>
<head>
<include file="../Public/header" />

</head>
<body>
	<div class="layui-tab-content">
		<form class="layui-form" name="form1" action="{:U('updateSubPassword')}" method="post">
			<input type="hidden" name="id" value="{$data['id']}">
			<input type="hidden" name="returnUrl" value="{$_GET['returnUrl']}">
			<include file="tpl/sub_user_password"/>
			
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit="" lay-filter="go">修改用户密码信息</button>
					<!-- <button type="reset" class="layui-btn layui-btn-primary">重置</button> -->
				</div>
			</div>

		</form>
	</div>

	<script>
	
</script>

</body>
</html>