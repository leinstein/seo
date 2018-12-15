<!DOCTYPE html>
<html lang="zh-CN">
<head>
<include file="../Public/header" />

<script type="text/javascript">
	$(function() {
		
	});
</script>
</head>
<tagLib name="html" />
<body>

	<div class="layui-tab-content">
		<form class="layui-form"  name="form1" method="post" >
			<neq name="can_not_add" value="1">
			<h3 class="rwgl mb20">
		 		<a class="layui-btn" href="javascript:;" onclick="open_layer('添加工单','{:U('insertPage')}/productid/{$Think.get.productid}/objecttype/{$Think.get.objecttype}/objectid/{$Think.get.objectid}/touserid/{$Think.get.touserid}/tousername/{$Think.get.tousername|urlencode}/level/2&returnUrl={$Think.get.returnUrl|urlencode}','50%')"><i class="iconfont">&#xe68b;</i> 发起工单</a>
		 	</h3>	
		 	</neq>
        	<!-- 站点列表挂件 begin -->
			{:W('WorkorderList', array( 'list' => $list, 'query_params'=>$query_params, 'returnUrl' => $CURRENT_URL , 'me' => $LoginUserInfo))}
			<!-- 站点列表挂件 end -->	
		</form>
	</div>

</body>
</html>
