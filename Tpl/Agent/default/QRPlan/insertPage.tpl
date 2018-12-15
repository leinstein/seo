<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<script>
$(function() {
	layui.use(['form'], function(){
		var form = layui.form;
		var ks ="";
		//自定义验证规则
		form.verify({

		});

		form.on('submit(go)', function(data) {
		});
	});
});
</script>
</head>
<body>

	<div class="layui-tab-content">
		<form class="layui-form" action="{:U('insert')}" method="post">
		
			<div class="layui-form-item">
				<label class="layui-form-label required">计划名称</label>
				<div class="layui-input-block">
					<input type="text" name="planname" value="{$data['planname']}" required="" lay-verify="required" placeholder="请输入计划名称" autocomplete="off" class="layui-input">
				</div>
			</div>
			
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit="" lay-filter="go">立即提交</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</div>
		</form>
	</div>
	
</body>
</html>