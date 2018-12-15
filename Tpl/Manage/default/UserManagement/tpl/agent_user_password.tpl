<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">开通产品</div>
		<input type="text" class="form-control" value="{$data['username']}" readonly="readonly">
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">角色类型</div>
		<input type="text" class="form-control" value="代理用户" readonly="readonly">
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">原始密码</div>
		<input type="password" class="form-control" name="userpass_old" id="userpass_old" placeholder="请输入用户原始密码" />
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">新密码</div>
		<input type="password" class="form-control" name="userpass_new1" id="userpass_new1" placeholder="请输入用户新密码" />
	</div>
</div>
<div class="form-group">
	<div class="input-group">
		<div class="input-group-addon">确认新密码</div>
		<input type="password" class="form-control" name="userpass_new2" id="userpass_new2" placeholder="请再次输入新密码" />
	</div>
</div>

<input type="hidden" name="id" value="{$data['id']}">