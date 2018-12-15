<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "添加用户";</php>
<head>
<include file="../Public/header" />
<tagLib name="html" />
</head>
<body>
	<div class="layui-tab-content">
		<form class="layui-form" action="{:U('insert')}" method="post">
		
			<!-- 用户详情 挂件 begin -->
			{:W('UserDetail', array( 'data'=>$data,'operate' => 'insert','skin' => 'agent', 'me' => $LoginUserInfo  ))}
			<!-- 用户详情 挂件 end -->
			
		</form>
	</div>
	<!-- PAGE -->


</body>
</html>