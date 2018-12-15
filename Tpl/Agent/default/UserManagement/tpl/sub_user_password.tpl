
<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;

			//自定义验证规则
			form.verify({
				password: function(value){
			 		if( $.trim( value)  ==""){
			 			return '请您输入原始登录密码！';
			 		}
				},
				userpass_new1: function(value){
			 		
					if( $.trim( value)  ==""){
			 			return '请您输入新的登录密码！';
			 		}
					if(!(/(.+){6,}$/.test(value))){
					      return '密码不能小于6位';
				    }
			 		
			 		val1 =value;
				},
				userpass_new2: function(value){
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
				
			});

			form.on('submit(go)', function(data) {
			});

			/* //事件监听
			form.on('select', function(data){
			  console.log(data);
			});

			form.on('select(aihao)', function(data){
			  console.log(data);
			});
			
			form.on('checkbox', function(data){
			  console.log(data.elem.checked);
			});
			
			form.on('switch', function(data){
			  console.log(data);
			});
			
			form.on('radio', function(data){
			  console.log(data);
			});
			
			//监听提交
			form.on('submit(*)', function(data){
			  console.log(data)
			  return false;
			}); */

		});
	});
</script>

<div class="layui-form-item">
	<label class="layui-form-label">用户名</label>
	<div class="layui-input-block">
		<div class="layui-form-mid">{$data['username']}</div>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">角色类型</label>
	<div class="layui-input-block">
		<div class="layui-form-mid">{$data['usertype_desc']}</div>
	</div>
</div>


<!-- <div class="layui-form-item">
	<label class="layui-form-label">原始密码</label>
	<div class="layui-input-block">
		<input type="password" name="userpass_old" required="" lay-verify="password" placeholder="请输入用户原始密码" autocomplete="off" class="layui-input">
	</div>
</div> -->


<div class="layui-form-item">
	<label class="layui-form-label">新密码</label>
	<div class="layui-input-block">
		<input type="password" name="userpass_new1" required="" lay-verify="userpass_new1" placeholder="请输入用户新密码" autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">确认新密码</label>
	<div class="layui-input-block">
		<input type="password" name="userpass_new2" required="" lay-verify="userpass_new2" placeholder="请再次输入新密码" autocomplete="off" class="layui-input">
	</div>
</div>

<input type="hidden" name="id" value="{$data['id']}">