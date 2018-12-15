<!DOCTYPE html>
<html lang="zh-CN">
<php>$page_title = "修改用户";</php>
<head>
<include file="../Public/header" />
</head>
<body>
	<div class="layui-tab-content">
		<form class="layui-form" action="{:U('update')}" method="post">
			<!-- 用户详情详情 挂件 begin -->
			{:W('UserDetail', array( 'data'=>$data,'operate' => 'update','skin' => 'agent' , 'me' => $LoginUserInfo))}
			<!-- 用户详情详情 挂件 end -->
		</form>
	</div>


	<script>
	function validate(){
		
		
	}
</script>

</body>
</html>