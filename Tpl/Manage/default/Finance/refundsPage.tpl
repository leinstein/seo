<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<script src="__PUBLIC__/js/regular.js"></script>
<script type="text/javascript">
   $(function() {
	   layui.use(['form'], function() {
		   var form = layui.form;
		   var availablefunds = 0 ;
			//自定义验证规则
			form.verify({
				amount: function(value){
					
			  		if($.trim(value)== ""){
			    		return '请输入金额';
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
	
			form.on('select', function(data){
				 //console.log(data.elem); //得到select原始DOM对象
				 var select_value = data.value; //得到被选中的值
				 //console.log(select_value); //得到select原始DOM对象
				 if( select_value ){
					 //得到json数据中的值
					 var funds_str = {$funds_str};
					 var funds_info = null;	
					//console.log(funds_str);
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
					 
				 }
				
			  //console.log(data.othis); //得到美化后的DOM对象
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
      		<form name="form1"  class="layui-form"  action="{:U('refunds')}" method="post">
			<div class="layui-form-item">
				<label class="layui-form-label">用户名</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">{$data['username']}</div>
				</div>
			</div>		
			<div class="layui-form-item">
				<label class="layui-form-label">角色</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">子用户</div>
				</div>
			</div>	
			
			<div class="layui-form-item">
				<label class="layui-form-label">公司名称</label>
				<div class="layui-input-block">
					<div class="layui-form-mid">{$data['epname']}</div>
				</div>
			</div>	
			
			<div class="layui-form-item">
				<label class="layui-form-label required">退款产品</label>
				<div class="layui-input-block">
					<html:select options="ProductOptions" first="选择产品" lay_verify="required" name="productid" />
				</div>
			</div>
		
			<div id="product_funds" class="layui-form-item hide">
				<label class="layui-form-label">产品余额</label>
				<div class="layui-input-block">
					<div class="layui-form-mid"><span id="availablefunds"></span> 元</div>
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label required">退款金额</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" name="amount" required="" lay-verify="amount"  placeholder="请填写退款金额" >
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label required">退款说明</label>
				<div class="layui-input-block">
					<textarea name="remarks" placeholder="请填写退款说明" class="layui-textarea" lay-verify="required"></textarea>
				</div>
			</div>
		
			<div class="layui-form-item">
				<div class="layui-input-block">
					<input type="hidden" name="usertype"  value="sub">
					<input type="hidden" name="userid"  value="{$data['id']}">
					<input type="hidden" name="puserid"  value="{$data['pid']}">
					<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确 定</button>
				</div>
			</div>

		</form>
    </div>
</body>
</html>
