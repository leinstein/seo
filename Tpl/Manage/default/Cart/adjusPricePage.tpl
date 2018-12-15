<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "关键词价格调整";</php>
<head>
<include file="../Public/header" />

<!-- 正则验证 begin -->
<script type="text/javascript" src="__PUBLIC__/js/regular.js"></script>
<!-- 正则验证 end -->
<script>
	$(function() {
		layui.use(['form'], function() {
			var form = layui.form;
			//自定义验证规则
			form.verify({
				money: function(value){
					
			  		if($.trim(value)== ""){
			    		return '请输入调整后的价格';
			  		}
			  		
			  		 if( !verifyMoney($.trim(value)) ){
			  			return '请输入正确价格';
			         }
				}
			});

			form.on('submit(go)', function(data) {
			});
		});
	});
</script>
</head>
<body>

<div class="layui-tab-content">
	<form name="form" action="{:U('adjustPrice')}" method="post" class="layui-form">
			<input type="hidden" name="ids" value="{$Think.get.ids}">
			<input type="hidden" name="returnUrl" value="{$Think.get.returnUrl}"> 
			
			<div class="layui-form-item">
				<label class="layui-form-label">价格</label>
				<div class="layui-input-block">
				<input type="text" name="price"  required="" lay-verify="money" placeholder="请输入价格" autocomplete="off" class="layui-input">
				</div>
			</div>
			
			<div class="layui-form-item layui-form-text">
				<div class="layui-input-block">
					<button type="submit" class="layui-btn" lay-submit="" lay-filter="go">确 定</button>
				</div>
			</div>

		
	</form>
</div>	

</body>
</html>