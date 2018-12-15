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
	function validate(){
		// 是否输入了旧密码
		var userpass_old = $("#userpass_old").val();
		
		if( userpass_old == "" ){
			layer_alert("请您输入原始登录密码！");
			return false;
		}
		
		var userpass_new1 = $("#userpass_new1").val();
		var userpass_new2 = $("#userpass_new2").val();
		
		if( userpass_new1 == "" ){
			layer_alert("请您输入新密码！");
			return false;
		}
		
		if( userpass_new2 == "" ){
			layer_alert("请您再次输入新密码！");
			return false;
		}
		
		if( userpass_new1 != userpass_new2 ){
			layer_alert("您两次输入的密码不一致，请重新输入！");
			return false;
		}
		
	}
</script>

</body>
</html>