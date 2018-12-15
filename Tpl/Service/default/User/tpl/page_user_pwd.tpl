
<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;
			var val1="";
			//自定义验证规则
			form.verify({
				password: function(value){
			 		if( $.trim( value)  ==""){
			 			return '请您输入原始登录密码！';
			 		}
				},
				newpassword1: function(value){
			 		
					if( $.trim( value)  ==""){
			 			return '请您输入新的登录密码！';
			 		}
					if(!(/(.+){6,}$/.test(value))){
					      return '密码不能小于6位';
				    }
			 		
			 		val1 =value;
				},
				newpassword2: function(value){
			 		if( $.trim( value)  ==""){
			 			return '请您再次输入新密码！';
			 		}
			 		
			 		if(!(/(.+){6,}$/.test(value))){
					      return '密码不能小于6位';
				    }
			 		if(val1 != value){
			 			return '您两次输入的密码不一致，请重新输入！';
			 		}
				},
				
				//newpassword1: [/(.+){6,}$/, '密码不能小于6位'],
				//newpassword2: [/(.+){6,}$/, '密码不能小于6位'],
				//phone: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！']  
		       // email: [/^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/, '邮箱格式不对']  
				
			});
			form.on('submit(go)', function(data) {
				/* console.log(data.field);
				
				var field = data.field;
				
				
				if( field['newpassword1'] != field['newpassword2']) {
					console.log(field['newpassword1'])
					console.log(field['newpassword2'])
					form.verify({
						newpassword2: function(value){
							return '您两次输入的密码不一致，请重新输入';
						},
					})
				}else{
					alert()
					form.verify({
						newpassword2: function(value){
							return false;
						},
					})
				}
				return false; */
			});

		

		});
	});
</script>


<div class="layui-form-item">
	<label class="layui-form-label">登陆账号</label>
	<div class="layui-input-block">
	<div class="layui-form-mid">{$LoginUserName}</div>
	</div>
</div>


<div class="layui-form-item">
	<label class="layui-form-label">原始密码</label>
	<div class="layui-input-block">
		<input type="password" id="password" name="password"  required="" lay-verify="password" placeholder="请输入您的原始登录密码"  autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">新登录密码</label>
	<div class="layui-input-block">
		<input type="password" id="newpassword1" name="newpassword1"  required="" lay-verify="newpassword1" placeholder="请输入您的新登录密码"  autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">确认新密码</label>
	<div class="layui-input-block">
		<input type="password" id="newpassword2" name="newpassword2"  required lay-verify="newpassword2" placeholder="请再次输入您的新密码"  autocomplete="off" class="layui-input">
	</div>
</div>

						



