<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />
<!-- 自定义正则验证js  -->
<script src="__PUBLIC__/js/regular.js"></script>
<script>
</script>
</head>
<body>
 	<div class="layui-tab-content">
      		<form class="layui-form mt10" name="update_form" action="__URL__/update" enctype="multipart/form-data" method="post" onkeydown="if(event.keyCode==13){return false;}">			
			<!-- <input type="hidden" name="newstype" value="{$_GET['newstype']}"> -->
			<include file="tpl/page"/>
		</form>
	</div>

</body>
</html>
