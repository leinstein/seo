
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">用户名</div>
		<input type="text" class="form-control" name="username" id="username" value="{$data['username']}" required="">
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">角色类型</div>
		<input type="text" class="form-control" value="代理用户" readonly="readonly">
		<input type="hidden" class="form-control" name="usertype_desc" value="代理用户">

	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">用户姓名</div>
		<input type="text" class="form-control" name="truename" id="truename" value="{$data['truename']}" required="" placeholder="请填写用户真实姓名" />
		<!-- <div class="input-group-addon">.00</div> -->
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">公司名称</div>
		<input type="text" class="form-control" name="epname" id="epname" value="{$data['epname']}" required="" placeholder="请填写公司名称" />
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">联系人</div>
		<input type="text" class="form-control" name="contact" id="contact" value="{$data['contact']}" required="" placeholder="请填写联系人" />
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">联系电话</div>
		<input type="text" class="form-control" name="mobileno" id="mobileno" value="{$data['mobileno']}" required="" placeholder="请填写电话" />
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">QQ号码</div>
		<input type="text" class="form-control" name="QQnumber" id="QQnumber" value="{$data['QQnumber']}" required="" placeholder="请填写QQ" />
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">客服人员</div>
		<input type="text" class="form-control" name="customer" id="customer" value="{$data['expand_arr']['customer']}" placeholder="请填写客服" />
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">销售人员</div>
		<input type="text" class="form-control" name="seller" id="seller" value="{$data['expand_arr']['seller']}"  placeholder="请填写销售" />
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">运维人员</div>
		<input type="text" class="form-control" name="operationer" id="operation" value="{$data['expand_arr']['operationer']}" placeholder="请填写运维" />
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">开通产品</div>
		<!-- <html:checkbox name="product_type" checkboxes="ProductTypeOptions" separator="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" checked="data['ProductTypeArray']"/> -->
		<input type="text" class="form-control" value="{$data['product_desc']}" readonly="readonly">
		<input type="hidden" class="form-control" name="product_desc" value="{$data['product_desc']}">
		<volist name="ProductTypeOptions" id="vo">
		<input type="hidden" name="product[]" value="{$key}">
		</volist>
	</div>
</div>

<input type="hidden" name="usertype" value="agent">
<input type="hidden" name="id" value="{$data['id']}">