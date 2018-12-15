
<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;

			//自定义验证规则
			form.verify({
			/* sitename: function(value){
			  if(value.length < 5){
			    return '标题也太短了吧';
			  }
			}
			,pass: [/(.+){6,12}$/, '密码必须6到12位'] */
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
	<label class="layui-form-label">登陆账号</label>
	<div class="layui-input-block">
	<div class="layui-form-mid">{$LoginUserName}</div>
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label">邮箱地址</label>
	<div class="layui-input-block">
		<input type="text" name="email" value="{$LoginUserInfo['email']}" placeholder="请输入常用邮箱,用于平台通知、密码找回"  autocomplete="off" class="layui-input">
		<!-- <input type="text" name="email" value="{$LoginUserInfo['email']}" lay-verify="email"  placeholder="请输入常用邮箱,用于平台通知、密码找回"  autocomplete="off" class="layui-input"> -->
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label">公司名称</label>
	<div class="layui-input-block">
		<input type="text" name="epname" value="{$LoginUserInfo['epname']}" required="" lay-verify="required" placeholder="公司名称,请填写营业执照公司全称"  autocomplete="off" class="layui-input">
	</div>
</div>
						
<div class="layui-form-item">
	<label class="layui-form-label">联系人</label>
	<div class="layui-input-block">
		<input type="text" name="contact" value="{$LoginUserInfo['contact']}" placeholder="您的真实姓名"  autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">联系QQ</label>
	<div class="layui-input-block">
		<input type="text" name="QQnumber" value="{$LoginUserInfo['QQnumber']}"  lay-verify="number" placeholder="方便在线沟通"  autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">固定电话</label>
	<div class="layui-input-block">
		<input type="text" name="telephone" value="{$LoginUserInfo['telephone']}"  placeholder="便于沟通"  autocomplete="off" class="layui-input">
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label">手机号码</label>
	<div class="layui-input-block">
		<input type="text" name="mobileno" value="{$LoginUserInfo['mobileno']}" lay-verify="phone" placeholder="联系手机"  autocomplete="off" class="layui-input">
	</div>
</div>





