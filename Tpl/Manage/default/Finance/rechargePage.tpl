<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<script src="__PUBLIC__/js/regular.js"></script>
<script type="text/javascript">
   $(function() {
	   layui.use(['form'], function() {
		   var form = layui.form;
			//自定义验证规则
			form.verify({
				amount: function(value){
					
			  		if($.trim(value)== ""){
			    		return '请输入金额';
			  		}
			  		
			  		// 金额输入的示是否正确
					//if( !verifyMoney(value)){
					//	return "您输入的金额格式不正确！";
					//}
				}
			});
	
			
			form.on('submit(go)', function(data) {
			});
	   });
	});
</script>
   
   
</head>
<tagLib name="html" />
<body>
    <div class="layui-tab-content">
      		<form name="form1"  class="layui-form"  action="{:U('recharge')}" method="post">
			<div class="layui-form-item">
				<label class="layui-form-label">用户名</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">{$data['username']}</div>
				</div>
			</div>		
			<div class="layui-form-item">
				<label class="layui-form-label">角色</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">一级代理商</div>
				</div>
			</div>	
			
			<div class="layui-form-item">
				<label class="layui-form-label">公司名称</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">{$data['epname']}</div>
				</div>
			</div>	
			<!-- <div class="layui-form-item">
				<label class="layui-form-label">充值产品</label>
				<div class="layui-input-block">
					<html:select options="ProductOptions" first="选择产品" name="productid" />
				</div>
			</div>	 -->
		

			<div class="layui-form-item">
				<label class="layui-form-label">充值金额</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" name="amount" required="" lay-verify="amount"  placeholder="请填写充值金额,写负数为退款" >
				</div>
			</div>
		
			<div class="layui-form-item">
				<div class="layui-input-block">
					<input type="hidden" name="usertype"  value="agent">
					<input type="hidden" name="id"  value="{$data['id']}">
					<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确 定</button>
				</div>
			</div>

		</form>
    </div>
</body>
</html>
