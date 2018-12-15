<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />

</head>
<tagLib name="html" />
<body>
	<div class="layui-tab-content">
		<form class="layui-form" name="update_form" method="post" action="__URL__/insertStaff" onkeydown="if(event.keyCode==13){return false;}">
			
			<!-- 员工详情挂件 begin -->
			{:W('StaffDetail', array( 'data' => $data, 'returnUrl' => $CURRENT_URL))}
			<!-- 员工详情挂件 end -->	
			
		</form>
	</div>
</body>
</html>
