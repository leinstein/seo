<?php if (!defined('THINK_PATH')) exit();?><!-- 自定义正则验证js  -->
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
<style type="text/css">
	
	.layui-checkbox-disbaled i {
	    border-color: #5FB878 !important;
	    background-color: #5FB878 !important;
	    color: #fff !important;
	}
</style>

<div class="layui-form-item">
	<label class="layui-form-label required">用户名</label>
	<div class="layui-input-block">
		
		<?php if(($operate) == "insert"): ?><input type="text" name="username" id="username" required="" lay-verify="required" placeholder="请填写用户真实姓名" autocomplete="off" class="layui-input">
		<?php else: ?>
		<div class="layui-form-mid"><?php echo ($data['username']); ?></div><?php endif; ?>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">角色类型</label>
	<div class="layui-input-block">
		<?php switch($_GET['usertype']): case "sub": ?><div class="layui-form-mid">子用户</div><?php break;?>
		    <?php case "agent": ?><div class="layui-form-mid">代理用户</div><?php break;?>
			<?php case "agent2": ?><div class="layui-form-mid">子代理用户</div><?php break;?>
		    <?php default: endswitch;?>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">用户姓名</label>
	<div class="layui-input-block">
		<?php if(($operate) == "detail"): ?><div class="layui-form-mid"><?php echo ($data['truename']); ?></div>
		<?php else: ?>
			<input type="text" name="truename" value="<?php echo ($data['truename']); ?>" required="" lay-verify="required" placeholder="请填写用户真实姓名" autocomplete="off" class="layui-input"><?php endif; ?>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">公司名称</label>
	<div class="layui-input-block">
		<?php if(($operate) == "detail"): ?><div class="layui-form-mid"><?php echo ($data['epname']); ?></div>
		<?php else: ?>
		<input type="text" name="epname" value="<?php echo ($data['epname']); ?>" lay-verify="required" placeholder="请填写公司名称" autocomplete="off" class="layui-input"><?php endif; ?>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">联系人</label>
	<div class="layui-input-block">
		<?php if(($operate) == "detail"): ?><div class="layui-form-mid"><?php echo ($data['contact']); ?></div>
		<?php else: ?>
		<input type="text" name="contact" value="<?php echo ($data['contact']); ?>" lay-verify="required" placeholder="请填写联系人" autocomplete="off" class="layui-input"><?php endif; ?>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label required">联系电话</label>
	<div class="layui-input-block">
		<?php if(($operate) == "detail"): ?><div class="layui-form-mid"><?php echo ($data['mobileno']); ?></div>
		<?php else: ?>
			<input type="text" name="mobileno" value="<?php echo ($data['mobileno']); ?>" lay-verify="my_phone" placeholder="请填写电话" autocomplete="off" class="layui-input"><?php endif; ?>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">QQ号码</label>
	<div class="layui-input-block">
		<?php if(($operate) == "detail"): ?><div class="layui-form-mid"><?php echo ($data['QQnumber']); ?></div>
		<?php else: ?>
			<input type="text" name="QQnumber" value="<?php echo ($data['QQnumber']); ?>" lay-verify="verifyQQ" placeholder="请填写QQ" autocomplete="off" class="layui-input"><?php endif; ?>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">客服人员</label>
	<div class="layui-input-block">
		<?php if(($operate) == "detail"): ?><div class="layui-form-mid"><?php echo ($data['expand_arr']['customer']); ?></div>
		<?php else: ?>
			<select id="" name="customer_id" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >请选择</option><?php  foreach($customer_codeSet as $key=>$val) { if(!empty($data['customer_id']) && ($data['customer_id'] == $key || in_array($key,$data['customer_id']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select><?php endif; ?>
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">销售人员</label>
	<div class="layui-input-block">
		
		<select id="" name="seller_id" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >请选择</option><?php  foreach($sale_codeSet as $key=>$val) { if(!empty($data['seller_id']) && ($data['seller_id'] == $key || in_array($key,$data['seller_id']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
		
	</div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">运维人员</label>
	<div class="layui-input-block">
		<select id="" name="operation_id" onchange="" ondblclick="" class="" lay-verify="" lay-filter="" readonly="" ><option value="" >请选择</option><?php  foreach($operation_codeSet as $key=>$val) { if(!empty($data['operation_id']) && ($data['operation_id'] == $key || in_array($key,$data['operation_id']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
	</div>
</div>
<!--
<div class="layui-form-item">
	<label class="layui-form-label">开通产品</label>
	<div class="layui-input-block">
		<div class="layui-form-mid"><?php echo ($data['product_desc']); ?></div>
		<input type="hidden" class="form-control" name="product_desc" value="<?php echo ($data['product_desc']); ?>">
		<?php if(is_array($ProductTypeOptions)): $i = 0; $__LIST__ = $ProductTypeOptions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" name="product[]" value="<?php echo ($key); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>
-->
<div class="layui-form-item" pane="">
    <label class="layui-form-label">开通产品</label>
    <div class="layui-input-block">
	    <?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo['id']) == "1"): ?><input type="checkbox" name="product[]" lay-skin="primary" title="<?php echo ($vo['product_name']); ?>" lay-verify="required" checked="" disabled="">
	    	<input type="hidden" name="product[]" value="<?php echo ($vo['id']); ?>">
	    	<?php else: ?>
	    	<input type="checkbox" name="product[]" lay-skin="primary" title="<?php echo ($vo['product_name']); ?>" lay-verify="required"  value="<?php echo ($vo['id']); ?>" 
			<?php if(($vo['checked']) == "1"): ?>checked=""<?php endif; ?>
	    	><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>



<?php if(($operate) != "detail"): ?><input type="hidden" name="usertype" value="<?php echo ($_GET['usertype']); ?>">
<input type="hidden" name="usergroup" value="<?php echo (($_GET['usergroup'])?($_GET['usergroup']):$data['usergroup']); ?>">
<input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
<input type="hidden" name="returnUrl" value="<?php echo ($_GET['returnUrl']); ?>"> 
<div class="layui-form-item layui-form-text">
	<div class="layui-input-block">
		<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确定</button>
	</div>
</div><?php endif; ?>