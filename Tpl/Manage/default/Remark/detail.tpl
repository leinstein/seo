<!DOCTYPE html>
<html lang="zh-CN">
<php>//$page_title = "修改站点";</php>
<head>
<include file="../Public/header" />
</head>
<body>
	
			
	<div class="layui-tab-content">
		<form class="layui-form"  name="form1" action="{:U('update')}" method="post" >
			<input type="hidden" name="id" value="{$data['id']}">
			<!-- 工单详情 挂件 begin -->
			{:W('RemarkDetail', array( 'data'=>$data ))}
			<!-- 工单详情 挂件 end -->	
		</form>
	</div>


</body>
</html>