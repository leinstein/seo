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
			<!-- 站点详情 挂件 begin -->
			{:W('WorkorderDetail', array( 'data'=>$data ))}
			<!-- 站点详情 挂件 end -->	
				
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