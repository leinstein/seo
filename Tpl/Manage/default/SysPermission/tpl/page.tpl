<!-- 正则验证 begin -->
<script type="text/javascript" src="__PUBLIC__/js/regular.js"></script>
<!-- 正则验证 end -->
<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;

			//自定义验证规则
			form.verify({
				email: function(value){
					if( $.trim(value) && !verifyEmail($.trim(value) )){
			    		return '请输入正确的邮箱';
			  		}
				},
				QQnumber: function(value){
					if( $.trim(value) && !verifyQQ($.trim(value) )){
			    		return '请输入正确的QQ';
			  		}
				},
				mobileno: function(value){
					if( $.trim(value) && !verifyMobile($.trim(value) )){
			    		return '请输入正确的手机号';
			  		}
				}
				
			});

			form.on('select', function(data){
				  /* console.log(data);
				  console.log(data.elem); //得到select原始DOM对象
				  console.log(data.value); //得到被选中的值
				  console.log(data.othis); //得到美化后的DOM对象
				  console.log( ); */
				  $("#usertype_desc").val( $(data.elem).find("option:selected").text() )
			});
			
			form.on('submit(go)', function(data) {
			});


		});
	});
</script>


<div class="layui-form-item">
	<label class="layui-form-label required">用户名</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="username" required="" lay-verify="required"  placeholder="请输入登录用户名" value="{$data['username']}">
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label">邮箱地址</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="email" lay-verify="email" placeholder="请输入常用邮箱,用于平台通知、密码找回" value="{$data['email']}" <eq name="Think.ACTION_NAME" value="staff_detail">readonly="readonly" </eq>>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">公司名称</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="epname" value="上海启搜网络科技有限公司" readonly="readonly">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">真实姓名</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="truename" required="" lay-verify="required" placeholder="员工的真实姓名" value="{$data['truename']}" <eq name="Think.ACTION_NAME" value="staff_detail">readonly="readonly" </eq>>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">QQ号码</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="QQnumber" lay-verify="QQnumber" placeholder="QQ号码" value="{$data['QQnumber']}" <eq name="Think.ACTION_NAME" value="staff_detail">readonly="readonly" </eq>>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">手机号码</label>
	<div class="layui-input-block">
		<input type="text" class="layui-input" name="mobileno" placeholder="手机号码" lay-verify="required|mobileno" value="{$data['mobileno']}" <eq name="Think.ACTION_NAME" value="staff_detail">readonly="readonly" </eq>>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">用户类型</label>
	<div class="layui-input-block">
	<eq name="Think.ACTION_NAME" value="staff_detail">
		<input type="text" class="layui-input" value="{$data['usertype']}" readonly="readonly">
	<else/>
		<html:select options="userrole_options" first="请选择" name="usertype" lay_verify="required" selected="data['usertype']" />
		<input type="hidden" name="usertype_desc" id="usertype_desc" value="{$data['usertype_desc']}">
	</eq>
	</div>
</div>
<gt name="Think.get.rolelevel" value="1">
<div class="layui-form-item">
	<label class="layui-form-label required">经理</label>
	<div class="layui-input-block">

	<html:select options="users" first="请选择" name="pid" lay_verify="required" selected="data['pid']" />

	</div>
</div>
</gt>


<neq name="Think.ACTION_NAME" value="staff_detail">
<div class="layui-form-item">
	<div class="layui-input-block">
		<input type="hidden" name="id" value="{$data['id']}">
		<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}">
		<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确定</button>
	</div>
</div>
</neq>



