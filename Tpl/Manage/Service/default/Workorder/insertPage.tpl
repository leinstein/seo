<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "添加站点";</php>
<head>
<include file="../Public/header" />
<!--响应式css-->
<link rel="stylesheet" type="text/css" href="../Public/css/responsive.css">
<script>
$(function() {
 
});
</script>
</head>
<body>

	<div class="layui-tab-content">
		<form class="layui-form" action="{:U('insert')}" method="post">
			<!-- 工单详情 挂件 begin -->
			{:W('WorkorderDetail', array( 'data'=>$data ))}
			<!-- 工单详情 挂件 end -->	
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit="" lay-filter="formDemo">立即提交</button>
					<!-- <button type="reset" class="layui-btn layui-btn-primary">重置</button> -->
				</div>
			</div>
		</form>
	</div>
	
</body>
</html>