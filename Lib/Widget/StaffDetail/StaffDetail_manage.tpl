<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>
<script>
$(function() {
	layui.use(['form'], function(){
		var form = layui.form;
		//自定义验证规则
		form.verify({
			my_phone: function(value){
				value =$.trim( value );
				if( !value ){
					return '请输入联系电话';
				} 
		    	  
				if( !verifyTel( value ) && !verifyMobile( value ) ){
					return '联系电话格式不正确';
				}
			},
			verifyQQ: function(value){
				if( $.trim( value ) && !verifyQQ( value ) ){
					return 'QQ格式不正确';
				}
			},
		});

		form.on('submit(go)', function(data) {
		});
	});
});
</script>


<div class="layui-form-item">
	<label class="layui-form-label required">用户名</label>
	<div class="layui-input-block">
		<eq name="operate" value="insert">
		<input type="text" name="username" id="username" required="" lay-verify="required" placeholder="请填写用户真实姓名" autocomplete="off" class="layui-input">
		<else/>
		<div class="layui-form-mid">{$data['username']}</div>
		</eq>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">角色类型</label>
	<div class="layui-input-block">
		<switch name="Think.get.usertype">
		    <case value="sub">
		    	<div class="layui-form-mid">子用户</div>
			</case>
		    <case value="agent">
		    	<div class="layui-form-mid">代理用户</div>
			</case>
			<case value="agent2">
		    	<div class="layui-form-mid">子代理用户</div>
			</case>
		    <default />
		 </switch>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">用户姓名</label>
	<div class="layui-input-block">
		<eq name="operate" value="detail">
			<div class="layui-form-mid">{$data['truename']}</div>
		<else/>
			<input type="text" name="truename" value="{$data['truename']}" required="" lay-verify="required" placeholder="请填写用户真实姓名" autocomplete="off" class="layui-input">
		</eq>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">公司名称</label>
	<div class="layui-input-block">
		<eq name="operate" value="detail">
			<div class="layui-form-mid">{$data['epname']}</div>
		<else/>
		<input type="text" name="epname" value="{$data['epname']}" lay-verify="required" placeholder="请填写公司名称" autocomplete="off" class="layui-input">
		</eq>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">联系人</label>
	<div class="layui-input-block">
		<eq name="operate" value="detail">
			<div class="layui-form-mid">{$data['contact']}</div>
		<else/>
		<input type="text" name="contact" value="{$data['contact']}" lay-verify="required" placeholder="请填写联系人" autocomplete="off" class="layui-input">
		</eq>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">联系电话</label>
	<div class="layui-input-block">
		<eq name="operate" value="detail">
			<div class="layui-form-mid">{$data['mobileno']}</div>
		<else/>
			<input type="text" name="mobileno" value="{$data['mobileno']}" lay-verify="my_phone" placeholder="请填写电话" autocomplete="off" class="layui-input">
		</eq>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">QQ号码</label>
	<div class="layui-input-block">
		<eq name="operate" value="detail">
			<div class="layui-form-mid">{$data['QQnumber']}</div>
		<else/>
			<input type="text" name="QQnumber" value="{$data['QQnumber']}" lay-verify="verifyQQ" placeholder="请填写QQ" autocomplete="off" class="layui-input">
		</eq>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">客服人员</label>
	<div class="layui-input-block">
		<eq name="operate" value="detail">
			<div class="layui-form-mid">{$data['expand_arr']['customer']}</div>
		<else/>
			<html:select options="customer_codeSet" first="请选择" name="customer_id"  selected="data['customer_id']" />
		</eq>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">销售人员</label>
	<div class="layui-input-block">
		
		<html:select options="sale_codeSet" first="请选择" name="seller_id" lay_verify="required" selected="data['seller_id']" />
		
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">运维人员</label>
	<div class="layui-input-block">
		<html:select options="operation_codeSet" first="请选择" name="operation_id"  selected="data['operation_id']" />
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label">开通产品</label>
	<div class="layui-input-block">
		<div class="layui-form-mid">{$data['product_desc']}</div>
		<input type="hidden" class="form-control" name="product_desc" value="{$data['product_desc']}">
		<volist name="ProductTypeOptions" id="vo">
		<input type="hidden" name="product[]" value="{$key}">
		</volist>
	</div>
</div>
<neq name="operate" value="detail">
<input type="hidden" name="usertype" value="{$Think.get.usertype}">
<input type="hidden" name="id" value="{$data['id']}">
<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}"> 
<div class="layui-form-item layui-form-text">
	<div class="layui-input-block">
		<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确定</button>
	</div>
</div>
</neq>

