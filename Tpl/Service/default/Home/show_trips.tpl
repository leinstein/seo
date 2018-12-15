<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
</head>
<body>
	<div class="layui-tab-content" style="text-align: center;margin: 40px auto;font-weight: bold;font-size: 15px;">
		<div><!-- <a style="margin:0 5px; color:#EC382D" href="javascript:;" onclick= "go_url()"> -->{$_GET['hint_str']}</div>
	</div>


	<script>
	function go_url(){
		
		var url = "{:U('Service/Workorder/index')}";
		parent.location.href = url;
	}
</script>

</body>
</html>