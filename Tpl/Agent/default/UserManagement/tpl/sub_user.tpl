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

		});
	});
</script>
<div class="layui-form-item">
	<label class="layui-form-label">用户名</label>
	<div class="layui-input-block">
		<input type="text" name="username" value="{$data['username']}" required="" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">角色类型</label>
	<div class="layui-input-block">
		<eq name="data['usertype']" value="agent2">
			<div class="layui-form-mid">子代理</div>
			<input type="hidden" name="usertype"  value="agent2">
			<input type="hidden" class="form-control" name="usertype_desc" value="子代理">
		<else/>
			<div class="layui-form-mid">子用户</div>
			<input type="hidden" name="usertype"  value="sub">
			<input type="hidden" class="form-control" name="usertype_desc" value="子用户">
		</eq>
		
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">用户姓名</label>
	<div class="layui-input-block">
		<input type="text" name="truename" value="{$data['truename']}" required="" lay-verify="required" placeholder="请输入用户真实姓名" autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">公司名称</label>
	<div class="layui-input-block">
		<input type="text" name="epname" value="{$data['epname']}" required="" lay-verify="required" placeholder="请填写公司名称" autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">联系人</label>
	<div class="layui-input-block">
		<input type="text" name="contact" value="{$data['contact']}" placeholder="请填写联系人" autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">联系电话</label>
	<div class="layui-input-block">
		<input type="text" name="mobileno" value="{$data['mobileno']}" required="" lay-verify="required" placeholder="请填写电话" autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">QQ号码</label>
	<div class="layui-input-block">
		<input type="text" name="QQnumber" value="{$data['QQnumber']}" required="" lay-verify="required" placeholder="请填写QQ" autocomplete="off" class="layui-input">
	</div>
</div>

<!-- <div class="layui-form-item">
	<label class="layui-form-label">客服人员</label>
	<div class="layui-input-block">
		<input type="text" name="customer" value="{$data['expand_arr']['customer']}" placeholder="请填写客服" autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">客服人员</label>
	<div class="layui-input-block">
		<input type="text" name="seller" value="{$data['expand_arr']['seller']}" placeholder="请填写销售" autocomplete="off" class="layui-input">
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">运维人员</label>
	<div class="layui-input-block">
		<input type="text" name="operationer" value="{$data['expand_arr']['operationer']}" placeholder="请填写运维" autocomplete="off" class="layui-input">
	</div>
</div> -->
<div class="layui-form-item">
	<label class="layui-form-label">开通产品</label>
	<div class="layui-input-block">
		<div class="layui-form-mid">{$data['product_desc']}</div>
		
		<!-- <html:checkbox name="product_type" checkboxes="ProductTypeOptions" separator="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" checked="data['ProductTypeArray']"/> -->
		<input type="hidden"  name="product_desc" value="{$data['product_desc']}">
		<volist name="ProductTypeOptions" id="vo">
		<input type="hidden" name="product[]" value="{$key}">
		</volist>
	</div>
</div>

<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}"> 
<input type="hidden" name="id"  value="{$data['id']}">
<input type="hidden" name="pid"  value="{$pid}">