<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "财务管理 - 子用户充值";</php>
<head>
<include file="../Public/header" />
<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>

<script>
		$(function() {
			layui.use('form', function() {
				var form = layui.form();
	 			var availablefunds = "{$default_product['balancefunds']}";
				//自定义验证规则
				form.verify({
					amount: function(value){
				  	
						// 是否输入了金额
						// 金额输入的示是否正确
						if( !$.trim( value) ){
							return "请输入金额！";
						}
						
						// 金额输入的示是否正确
						if( !verifyMoney(value)){
							return "您输入的金额格式不正确！";
						}
						// 金额是否大于可用余额
						if( accSub(value , availablefunds ) > 0 ){
							return "您输入的金额不能大于资金池余额！";
						}
						
					}
				});
	
				form.on('submit(go)', function(data) {
				});

				form.on('select', function(data){
					  //console.log(data.elem); //得到select原始DOM对象
					 var select_value = data.value; //得到被选中的值
					 //得到json数据中的值
					 var funds_str = {$funds_str};
					 var funds_info = null;	
					// console.log(funds_str);
					 for (var i = 0; i < funds_str.length; i++) {
					 	// console.log(funds_str[i]);
					 	 if( select_value == funds_str[i]['productid']){
					 	 	funds_info = funds_str[i];
					 	 	break;
					 	 }
					 }

					 if( funds_info ){
					 	availablefunds = funds_info['availablefunds'];
					 	
					 }else{
					 	availablefunds = 0;
					 }
					 $("#product_funds").show();
					 $("#availablefunds").text( availablefunds );
				  //console.log(data.othis); //得到美化后的DOM对象
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
	
</head>
<tagLib name="html" />
<body>
	<div class="layui-tab-content">
		<form name="form1" action="{:U('recharge')}" method="post" class="layui-form">
		
			<div class="layui-form-item">
				<label class="layui-form-label">用户名</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">{$data['username']}</div>
				</div>
			</div>
		
			<div class="layui-form-item">
				<label class="layui-form-label">角色类型</label>
				<div class="layui-input-block">
				
				<eq name="Think.get.type" value="sub_agent">
					<div class="layui-form-mid">子代理</div>
					<input type="hidden" name="usertype" value="agent2">
				<else/>
					<div class="layui-form-mid">子用户</div>
					<input type="hidden" name="usertype" value="sub">
				</eq> 
				
					
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">公司名称</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">{$data['epname']}</div>
				</div>
			</div>
			
			<!-- <div class="layui-form-item">
				<label class="layui-form-label">资金余额</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><span id="availablefunds">{$data['balancefunds']|format_money}</span> 元</div>
				</div>
			</div> -->

			<div class="layui-form-item">
				<label class="layui-form-label required">充值产品</label>
				<div class="layui-input-block">
					<html:select options="ProductOptions" first="选择产品" name="productid" lay_verify="required" selected="default_productid"/>
				</div>
			</div>
			
			<div class="layui-form-item" id="product_funds">
				<label class="layui-form-label">产品余额</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><span id="availablefunds">{$default_product['balancefunds']|format_money}</span> 元</div>
				</div>
			</div>	
		
			
			<div class="layui-form-item">
				<label class="layui-form-label required">充值金额</label>
				<div class="layui-input-block">
					<input type="text" name="amount" required="" lay-verify="amount" placeholder="请填写充值金额" autocomplete="off" class="layui-input">
				</div>
			</div>	
			
			<input type="hidden" name="id"  value="{$data['id']}">
			
			
			<div class="layui-form-item">
				<div class="layui-input-block">
					<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}"> 
					<button class="layui-btn" lay-submit="" lay-filter="go">立即提交</button>
				</div>
			</div>

		</form>
	</div>

	<script>
	function validate(){
		var amount = $("#amount").val();
		// 是否输入了金额
		// 金额输入的示是否正确
		if( !amount){
			layer_alert("请输入金额！");
			return false;
		}
		
		// 金额输入的示是否正确
		if( !verifyMoney(amount)){
			layer_alert("您输入的金额格式不正确！");
			return false;
		}
		
		// 金额是否大于可用余额
		if( accSub(amount ,"{$data['balancefunds']}" ) > 0 ){
			layer_alert("您输入的金额不能大于资金池余额！");
			return false;
		}
		
	}
</script>

</body>
</html>